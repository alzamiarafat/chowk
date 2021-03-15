<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">



    @yield('title')
    <title>{{ config('app.name', 'FoodTiger') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('custom') }}/css/custom.css" rel="stylesheet">
    <!-- Select2 -->
    <link type="text/css" href="{{ asset('custom') }}/css/select2.min.css" rel="stylesheet">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/jasny/css/jasny-bootstrap.min.css">
    <!-- Flatpickr datepicker -->
    <link rel="stylesheet" href="{{ asset('vendor') }}/flatpickr/flatpickr.min.css">

    <!-- Font Awesome Icons -->
    <link href="{{ asset('argonfront') }}/css/font-awesome.css" rel="stylesheet" />

    <!-- Range datepicker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    @yield('head')
    @laravelPWA

    <!-- Custom CSS defined by admin -->
    <link type="text/css" href="{{ asset('byadmin') }}/back.css" rel="stylesheet">

    {{--for print--}}
    <link href="/css/print.css" rel="stylesheet" media="print" type="text/css">


    <!--   Core JS Files   -->
    <script src="{{ asset('argonfront') }}/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>    <script src="{{ asset('argonfront') }}/js/core/jquery-ui-theme.css" type="text/javascript"></script>
    <script src="{{ asset('argonfront') }}/js/core/popper.min.js" type="text/javascript"></script>
    {{--<script src="{{ asset('argonfront') }}/js/core/bootstrap.min.js" type="text/javascript"></script>--}}
    <script src="{{ asset('argonfront') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <style>
    #barcode {
    font-family: 'Libre Barcode 39';
    font-size: 50px;
        color: black;
    }
    .row p {
    color: black;
    font-size: 10px;
    margin-bottom: 0px !important;
    }
    .container{
    border: 1px solid black;
    }
    .table{
    font-size: 8px;
        color: #000;
    }
    .customer_copy{
        color: black;
    }

    @media print {
        #print-window {
            display: none;
        }
    }
    .table td, .table th{
        padding: 0px;
        border-top: 0px;
    }
    </style>
</head>
<body >

<div class="container p-5 w-50">
    <div class="row d-flex justify-content-between border-dark">
        <div class=""><img src="/uploads/Chowk_QR_code.jpeg" class="thumbnail" width="80" alt="..."></div>
        <div class="">
                {{--<div class="d-flex justify-content-center align-items-center">--}}
                    <a href="/"><img src="{{ config('global.site_logo') }}" width="100" class="thumbnail" alt="..."></a>
                {{--</div>--}}
        </div>
        <div class="customer_copy">customer copy</div>
    </div>
    <div class="row d-flex justify-content-between">
        <div class="">
            <b>Order No: {{ $order->id }}</b>
            <p><b>Customer Name: </b>{{ $order->client->name }}</p>
            <p><b>Phone: </b> {{ $order->client->phone }}</p>
            <p><b>Address: </b>{{ $order->address?$order->address->address:"" }}</p>
        </div>
        <div class="" id="barcode">{{'*'.$order->id.'*' }}</div>
    </div>
    {{--<div class="table">--}}
        <table class="table">
            <thead>
            <tr class="">
                <th scope="col">SL#</th>
                <th scope="col">Item Name</th>
                <th scope="col">Qty</th>
                <th scope="col">Rate</th>
                <th  scope="col"><span class="float-right">Amount</span></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $currency=config('settings.cashier_currency');
            $convert=config('settings.do_convertion');
            $i=1;

            ?>
            @foreach($order->items as $item)
                <?php
                $theItemPrice= ($item->pivot->variant_price?$item->pivot->variant_price:$item->price);
                ?>
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$item->name}}</td>
                <td class="">{{$item->pivot->qty}}</td>
                <td class="">{{$theItemPrice}}</td>
                <td class="float-right">{{sprintf('%0.2f',$item->pivot->qty * $theItemPrice)}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    {{--</div>--}}
    <div class="row d-flex justify-content-between border-top">

        <div class="pt-3 pl-3">
            <p style="font-size: 12px "><b>Payment Methode: {{ strtoupper($order->payment_method) }} </b></p>
        @if($order->payment_status=="unpaid")
            <p style="font-size: 12px "><b>Payment Status: DUE </b></p>
            @else
                <p style="font-size: 12px;"><b>Payment Status: {{ strtoupper($order->payment_status) }} </b></p>
            @endif
        </div>
        <div >
            <table style="width: 150px;" class="mr-3">
                <tr>
                    <td style="font-size: 11px "><p style="font-size: 11px ">Sub Total:</p></td>
                    <td class="float-right"><p style="font-size: 14px ">{{ $order->order_price }}</p></td>
                </tr>
                @if($order->discount>0)
                <tr>
                    <td><p style="font-size: 11px ">Discount:</p></td>
                    <td class="float-right"><p style="font-size: 14px ">{{sprintf('%0.2f',$order->discount)}}</p ></td></tr>
                @endif
                @if($order->coupon_price>0)
                <tr>
                    <td><p style="font-size: 11px ">Promo:</p></td>
                    <td class="float-right"><p style="font-size: 14px ">{{sprintf('%0.2f',$order->coupon_price)}}</p></td></tr>
                @endif
                <tr style="border-top: 1px solid #000;">
                    <td><p style="font-size: 11px ">Grand Total: </p></td>
                    <td class="float-right"><p style="font-size: 14px ">{{ sprintf('%0.2f',$order->order_price-$order->discount-$order->coupon_price)}}</p></td></tr>
                <tr>
                    <td><p style="font-size: 11px "><b>Delivery Charge:</b></p></td>
                    <td class="float-right"><p style="font-size: 14px ">{{ $order->delivery_price }}</p></td></tr>
                <tr style="border-top: 1px solid #000;">
                    <td ><p style="font-size: 11px "> <b>Net Payable:</b></p></td>
                    <td class="float-right"><p style="font-size: 14px "><b>{{sprintf('%0.2f', $order->total_price-$order->discount)}}</b></p></td></tr>
            </table>

        </div>
    </div>
    <div class="row d-flex justify-content-center p-4">
        <p style="font-size: 12px; color: #000">Thank you for Shopping with CHOWK</p>
    </div>
    <div class="row d-flex justify-content-end">
        <p><b>Powered By: </b>fairsoft.tech</p>
    </div>

</div>
<a href=""  id="print-window" target="_blank" class="btn btn-danger float-right print-window"><i class="fa fa-print"></i> Print</a>




<script>

    $('.print-window').click(function() {
        window.print();
    });

</script>

<!-- Commented because navtabs includes same script -->
<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ mix('js/app.js') }}"></script>

<script src="{{ asset('argonfront') }}/js/core/popper.min.js" type="text/javascript"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

@yield('topjs')

<!-- Navtabs -->
<script src="{{ asset('argonfront') }}/js/core/jquery.min.js" type="text/javascript"></script>


<script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Nouslider -->
<script src="{{ asset('argon') }}/vendor/nouislider/distribute/nouislider.min.js" type="text/javascript"></script>

<!-- Argon JS -->
<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="{{ asset('vendor') }}/jasny/js/jasny-bootstrap.min.js"></script>
<!-- Custom js -->
<script src="{{ asset('custom') }}/js/orders.js"></script>
<!-- Custom js -->
<script src="{{ asset('custom') }}/js/mresto.js"></script>
<!-- AJAX -->

<!-- SELECT2 -->
<script src="{{ asset('custom') }}/js/select2.js"></script>
<script src="{{ asset('vendor') }}/select2/select2.min.js"></script>

<!-- DATE RANGE PICKER -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- All in one -->
<script src="{{ asset('custom') }}/js/js.js?id={{ config('config.version')}}"></script>




<!-- Import Vue -->
<script src="{{ asset('vendor') }}/vue/vue.js"></script>

<!-- Import AXIOS --->
<script src="{{ asset('vendor') }}/axios/axios.min.js"></script>

<!-- Flatpickr datepicker -->
<script src="{{ asset('vendor') }}/flatpickr/flatpickr.js"></script>

<!-- Notify JS -->
<script src="{{ asset('custom') }}/js/notify.min.js"></script>


<script>
    var ONESIGNAL_APP_ID = "{{ config('settings.onesignal_app_id') }}";
    var USER_ID = '{{  auth()->user()&&auth()->user()?auth()->user()->id:"" }}';
    var PUSHER_APP_KEY = "{{ config('broadcasting.connections.pusher.key') }}";
    var PUSHER_APP_CLUSTER = "{{ config('broadcasting.connections.pusher.options.cluster') }}";
</script>

<!-- OneSignal -->
@if(strlen( config('settings.onesignal_app_id'))>4)
    <script src="{{ asset('vendor') }}/OneSignalSDK/OneSignalSDK.js" async=""></script>
    <script src="{{ asset('custom') }}/js/onesignal.js"></script>
@endif

@stack('js')
@yield('js')

<script src="{{ asset('custom') }}/js/rmap.js"></script>

<!-- Pusher -->
@if(strlen( config('broadcasting.connections.pusher.app_id'))>2)
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{ asset('custom') }}/js/pusher.js"></script>


@endif

<!-- Custom JS defined by admin -->
<?php echo file_get_contents(base_path('public/byadmin/back.js')) ?>
</body>
</html>
