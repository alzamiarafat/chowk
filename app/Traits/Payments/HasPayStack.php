<?php

namespace App\Traits\Payments;
use Illuminate\Support\Facades\Validator;
use Unicodeveloper\Paystack\Paystack;

trait HasPayStack
{
    public function paymentRules(){
        return [];
    }

    public function payOrder(){
        try {
            $paystack = new Paystack();
            $user = auth()->user()?auth()->user():$this->vendor->user;
            $this->request->email =$user->email;
            $this->request->orderID = $this->order->id;
            $this->request->metadata = json_encode($array = [
                'order_id' => $this->order->id,
                'restorant_id' => $this->vendor->id,
            ]);
            $this->request->amount = $this->order->order_price+$this->order->delivery_price;
            $this->request->quantity = 1;
            $this->request->reference = $paystack->genTranxRef();
            $this->request->key = config('paystack.secretKey');

            $this->paymentRedirect = $paystack->getAuthorizationUrl();

            //Set payment link in order
            $this->order->payment_link=$this->paymentRedirect;
            $this->order->update();
        } catch (\Exception $e) {
            if(config('app.debug') == true){
                dd($e);
            }
            $this->invalidateOrder();
            return Validator::make(['paystack_error_action'=>null], ['paystack_error_action'=>'required']);
        }
        
        //All ok
        return Validator::make([], []);
    }
}
