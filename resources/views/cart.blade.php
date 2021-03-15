@extends('layouts.front', ['class' => ''])
@section('content')
    <section class="section-profile-cover section-shaped my--1 d-none d-md-none d-lg-block d-lx-block">
        <!-- Circles background -->
        <img class="bg-image " src="{{ config('global.restorant_details_cover_image') }}" style="width: 100%;">
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew">
        </div>
    </section>
    <section class="section bg-secondary">
        <div class="container">
            <x:notify-messages />
               <!-- Left part -->
                    <!-- List of items -->
                    <form id="order-form" role="form" method="post" action="{{route('order.store')}}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-7">
                        @include('cart.items')
                            {{--@include('cart.coupons')--}}
                            @if(!config('settings.social_mode'))
                            @if (config('app.isft')&&count($timeSlots)>0)

                                <!-- Delivery time slot -->
                                @include('cart.time')
                                <!-- Delivery address -->
                                    <div id='addressBox'>
                                        @include('cart.address')
                                    </div>
                                {{--@include('cart.coupons')--}}
                                    <!-- Comment -->
                                @include('cart.comment')
                            @else
                                <!-- Comment -->
                                    @include('cart.comment')
                                @endif
                            @else
                            @endif
                        </div>
                        <div class="col-md-5">
                        {{--@include('clients.modals')--}}
                        @if (count($timeSlots)>0)
                            <!-- Payment -->
                                @include('cart.payment')

                            @else
                            <!-- Closed restaurant -->
                                @include('cart.closed')
                            @endif
                        </div>
                        </div>


                    <!-- Restaurant -->
                    </form>




        </div>
        @include('clients.modals')
    </section>
@endsection
@section('js')
    <script>
        var obj = {};
        //obj.amount = $('#total_amount').val();
        //        obj.amount = $('#amount').val();
        //obj.amount = $('#coup').val();
        obj.amount = 1234;
        //        obj.amount =
        $('#sslczPayBtn').prop('postdata', obj);
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };
            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>
    <script async defer src= "https://maps.googleapis.com/maps/api/js?key=<?php echo config('settings.google_maps_api_key'); ?>&callback=initAddressMap"></script>
    <!-- Stripe -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        "use strict";
        var RESTORANT = <?php echo json_encode($restorant) ?>;
        var STRIPE_KEY="{{ config('settings.stripe_key') }}";
        var ENABLE_STRIPE="{{ config('settings.enable_stripe') }}";
        var initialOrderType = 'delivery';
        if(RESTORANT.can_deliver == 1 && RESTORANT.can_pickup == 0){
            initialOrderType = 'delivery';
        }else if(RESTORANT.can_deliver == 0 && RESTORANT.can_pickup == 1){
            initialOrderType = 'delivery';
        }
    </script>
    <script src="{{ asset('custom') }}/js/checkout.js"></script>
@endsection
