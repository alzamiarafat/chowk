<?php

namespace App\Traits\Payments;

//PayPal
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

trait HasPayPal
{
    public function paymentRules(){
        return [];
    }

    public function payOrder(){

        //System setup 
        $client_id=config('services.paypal.client_id');
        $secret=config('services.paypal.secret');
        $mode=config('services.paypal.mode');

        //Setup based on vendor
        $PayPalClientId=$this->vendor->getConfig('paypal_client_id');
        if($PayPalClientId&&strlen($PayPalClientId)>5){
            $client_id=$PayPalClientId;
            $secret=$this->vendor->getConfig('paypal_secret','');
            $mode=$this->vendor->getConfig('paypal_mode','sandbox');
        }

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $client_id,
                $secret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => $mode,
                //'log.LogEnabled' => true,
                //'log.FileName' => '../PayPal.log',
                //'//log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                //'cache.enabled' => true,
                //'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $itemsArr = [];
        foreach ($this->order->items as $key => $item) {
            $itemObj = new Item();
            $itemObj->setName($item->name." ".$item->variant_name)
                ->setCurrency(strtoupper(config('settings.cashier_currency')))
                ->setQuantity(intval($item->pivot->qty))
                ->setSku(strval($item->id)) // Similar to `item_number` in Classic API
                ->setPrice($item->pivot->variant_price);

            array_push($itemsArr, $itemObj);
        }

        //Add delivery
        if($this->order->delivery_price>0){
            $itemObj = new Item();
            $itemObj->setName(__('Delivery'))
                ->setCurrency(strtoupper(config('settings.cashier_currency')))
                ->setQuantity(1)
                ->setSku(0) // Similar to `item_number` in Classic API
                ->setPrice($this->order->delivery_price);
            array_push($itemsArr, $itemObj);
        }


        $itemList = new ItemList();
        $itemList->setItems($itemsArr);

        $amount = new Amount();
        $amount->setCurrency(strtoupper(config('settings.cashier_currency')))->setTotal($this->order->order_price+$this->order->delivery_price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription(__('Payment for order on ').config('settings.app_name'))
            ->setInvoiceNumber($this->order->id);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(URL::to('/').'/execute-payment-pp?success=true')->setCancelUrl(URL::to('/').'/cancel');

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);
        
        try {
            $payment->create($apiContext);

            if (isset($redirectUrls)) {
                $this->paymentRedirect= $payment->getApprovalLink();

                //Set payment link in order
                $this->order->payment_link=$this->paymentRedirect;
                $this->order->update();

                //All ok
                return Validator::make([], []);

            }else{
                $this->invalidateOrder();
                return Validator::make(['paypal_payment_approval_missing'=>null], ['paypal_payment_approval_missing'=>'required']);
            }
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            //On Fail delete order
            $this->invalidateOrder();
            return Validator::make(['paypal_payment_error_action'=>null], ['paypal_payment_error_action'=>'required']);
        }
    }
}
