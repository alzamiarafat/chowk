<?php

namespace App\Traits\Payments;
use Mollie\Api\Exceptions\ApiException;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\Validator;

trait HasMollie
{
    public function paymentRules(){
        return [];
    }

    public function payOrder(){
        //If MOLLIE_KEY is unknown, check in owner setup
        if(config('mollie.key')=="test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"||config('mollie.key')==""){
            if(strlen($this->vendor->mollie_payment_key)>5){
                config(['mollie'=>['key'=>$this->vendor->mollie_payment_key]]);
                Mollie::api()->setApiKey($this->vendor->mollie_payment_key);
            }
        }
        try {
            $this->paymentRedirect= Mollie::api()->payments->create([
                'amount' => [
                    'currency' => strtoupper(config('settings.cashier_currency')),
                    'value' => number_format((float) $this->order->order_price+$this->order->delivery_price, 2, '.', ''),
                ],
                'description' => 'Order #'.$this->order->id,
                'redirectUrl' => auth()->user()?route('orders.index'):$this->order->restorant->getLinkAttribute(),
                'webhookUrl' => route('webhooks.mollie'),
                'metadata' => ['order_id' => $this->order->id],
            ])->getCheckoutUrl();

            //Set payment link in order
            $this->order->payment_link=$this->paymentRedirect;
            $this->order->update();
            
        } catch (ApiException $e) {
            if(config('app.debug') == true){
                dd($e);
            }
            $this->invalidateOrder();
            return Validator::make(['mollie_error_action'=>null], ['mollie_error_action'=>'required']);
        }
            

        //All ok
        return Validator::make([], []);
    }
}
