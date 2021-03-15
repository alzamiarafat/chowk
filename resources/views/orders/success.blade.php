
@extends('layouts.app', ['title' => ''])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card shadow border-0 w-50">
            <div class="card-body text-center">
                <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                    <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                    <span class="swal2-success-line-tip"></span>
                    <span class="swal2-success-line-long"></span>
                    <div class="swal2-success-ring"></div>
                    <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                    <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                </div>
                <h2 class="display-2">{{ __("You're all set!") }}</h2>
                {{--<h1 class="mb-4">--}}
                    {{--<span class="badge badge-primary">{{ __('Order')." #".$order->id }}</span>--}}
                    {{--<span class="badge badge-primary">{{ __('Order')." #".$order->order_price }}</span>--}}
                    {{--<span class="badge badge-primary">{{ __('Order')." #".$order->delivery_price }}</span>--}}
                {{--</h1>--}}
                <div class="d-flex justify-content-center">
                        <h5 class="mt-0 mb-5 heading-small text-muted">
                            {{ __("We've Placed Your Orders. Please Select a Payment Option to Confirm") }}
                        </h5>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="row">
                        <a href="confirm" class="btn btn-success" type="button">Pay Later</a>
                        <button class="your-button-class" id="sslczPayBtn"
                                token="if you have any token validation"
                                postdata="your javascript arrays or objects which requires in backend"
                                order="If you already have the transaction generated for current order"
                                endpoint="/pay-via-ajax"> Pay Now
                        </button>
                    </div>
                </div>
                    {{--<h4>Our Payment Options:</h4>--}}

            </div>
            {{--<img class="card-img-bottom bg-secondery " src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-05.png" />--}}

        </div>
    </div>

</div>
<input type="hidden" id="totalPrice" name="amount" value={{ $order->total_price}}>
<input type="hidden" id="orderId" name="id" value={{ $order->id}}>
<input type="hidden" id="deliveryPrice" name="deliveryPrice" value={{ $order->delivery_price}}>
<script>
    var obj = {};
    //    obj.amount = $('#total_amount').val();
        obj.amount = $('#totalPrice').val();
        obj.delivery = $('#deliveryPrice').val();
        obj.id = $('#orderId').val();
    $('#sslczPayBtn').prop('postdata', obj);
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>
@endsection


