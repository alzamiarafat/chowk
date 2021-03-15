@extends('layouts.front', ['title' => ''])
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card shadow border-0 mt-8">
                <div class="card-body text-center">
                    <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                        <span class="swal2-success-line-tip"></span>
                        <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                    </div>
                    <h2 class="display-2">{{ __("Order Confirmed!") }}</h2>

                    <div class="d-flex justify-content-center">
                        <div class="col-8">
                            <h5 class="mt-0 mb-5 heading-small text-muted">
                                {{ __("Your order has created. You will be notified for further information.") }}
                            </h5>
                            <div class="font-weight-300 mb-5">
                                {{ __("Thanks for your purchase") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
<script>
    var timer = setTimeout(function() {
        window.location='http://ecom.fairsoft.tech'
    }, 4000);
</script>

