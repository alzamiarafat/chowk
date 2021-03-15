<?php
    $dnl="\n\n";
    $nl="\n\n";
    $tabSpace="      ";
?>
{{ __("Hi, I'd like to place an order")." 👇"}}

@if ($order->delivery_method==1)
🛵🔜🏡
{{"*".__('Delivery Order No').": ".$order->id."*"}}
@else
✅🏫
{{"*".__('Pickup Order No').": ".$order->id."*"}}
@endif

---------
<?php
foreach ($order->items()->get() as $key => $item) {
    $lineprice = $item->pivot->qty.' X '.$item->name." - ".money($item->pivot->qty * $item->pivot->variant_price, config('settings.cashier_currency'), true);
    if(strlen($item->pivot->variant_name)>3){
        $lineprice .=$nl.$tabSpace.__('Variant:')." ".$item->pivot->variant_name;
    }
   
    if(strlen($item->pivot->extras)>3){
        foreach (json_decode($item->pivot->extras) as $key => $extra) {
            $lineprice .=$nl.$tabSpace.$extra;
        }
    }
?>
🔘{{ $lineprice }}

<?php
}
?>
---------
🧾 {{__('Total: ').money($order->order_price, config('settings.cashier_currency'), config('settings.do_convertion')) }}
---------

@if (strlen($order->comment)>0)   
🗒 {{ __('Comment') }}
{{ $order->comment }}  
@endif

<?php  //Deliver / Pickup details ?>
@if($order->delivery_method==1)
<?php  //Deliver?>
📍 {{ __('Delivery Details') }}
{{ __('Client').": ".$order->client_name }}
{{ __('Address').": ".$order->whatsapp_address }}
{{ __('Delivery time').": ".$order->getTimeFormatedAttribute() }}
@else
<?php   //Pickup details ?>
✅ {{ __('Pickup Details') }};
{{ __('Client').": ".$order->client_name }}
{{ __('Pickup time').": ".$order->getTimeFormatedAttribute() }}
@endif

<?php   //Custom fields ?>
<?php $custom_data=$order->getAllConfigs(); ?>
@if(count($custom_data)>0)
{{ __(config('settings.label_on_custom_fields')) }}
@foreach ($custom_data as $keyCutom => $itemValue)
{{ __( "custom.".$keyCutom) }}: {{ $itemValue }}
@endforeach
@endif


{{ $order->restorant->name." ".__('will confirm your order upon receiving the message.') }}


<?php //Add payment only in whatsapp ordering mode ?>
@if(config('settings.is_whatsapp_ordering_mode'))   
<?php //Payment ?>
💳 {{ __('Payment Options') }}
{{ $order->restorant->payment_info }}

<?php //Payment Link ?>

@if(strlen($order->payment_link)>5)
<?php //Add the payment link ?>
💳 {{ __('Pay now') }}
{{ $order->restorant->getLinkAttribute()."/?pay=".$order->id }}
@endif
@endif
