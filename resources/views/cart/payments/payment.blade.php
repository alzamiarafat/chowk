<div class="card card-profile shadow mt--300">
    <div class="px-4">
        <div class="mt-5">
            <h3>{{ __('Checkout') }}<span class="font-weight-light"></span></h3>
        </div>
        <div  class="border-top">
            <!-- Price overview -->
            <div id="totalPrices" v-cloak>
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span v-if="totalPrice==0">{{ __('Cart is empty') }}!</span>

                                <span v-if="totalPrice"><strong>{{ __('Subtotal') }}:</strong></span>
                                <span v-if="totalPrice" class="ammount float-right"><strong>@{{ totalPriceFormat }}</strong></span><br>
                                <span v-if="totalPrice"><strong>Promo Appiled:</strong></span>
                                <input v-if="totalPrice" name="couponPrice" style="display: none;outline: none; font-weight: bold;text-align: end" class="float-right"  id="couponPrice" :value="withCouponFormat" readonly />
                                <input v-if="totalPrice" name="couponPrice" id="couponPriceShow" class="float-right" style="outline: none; font-weight: bold;text-align: end" :value="withCouponFormat" readonly />
                            @if(config('app.isft'))
                                    <span v-if="totalPrice&&delivery"><br /><strong>{{ __('Delivery') }}:</strong></span>
                                    <span v-if="totalPrice&&delivery" class="ammount float-right"><strong>@{{ deliveryPriceFormated }}</strong></span><br />
                                @endif
                                <br />
                                <span v-if="totalPrice"><strong>{{ __('TOTAL') }}:</strong></span>

                                    <span v-if="totalPrice" id="couponWithDelivery" class="ammount float-right"><strong>@{{ withDeliveryFormat   }}</strong></span>

                                    <input v-if="totalPrice" name="total_price" style="outline: none; display: none;font-weight: bold; text-align: end" class="float-right"  id="coup" :value="withDeliveryFormat" readonly />


                                <input v-if="totalPrice" name="total_price" style="display: none"  id="tootalPricewithDeliveryRaw" :value="withDelivery" />

                                <input id="afterCouponStore" name="total_price" :value="withDelivery">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End price overview -->

            <!-- Payment  Methods -->
            <div class="cards">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <!-- Errors on Stripe -->
                            @if (session('error'))
                                <div role="alert" class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if(!config('settings.is_whatsapp_ordering_mode'))
                            <!-- COD -->
                                @if (!config('settings.hide_cod'))
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="paymentType" class="custom-control-input" id="cashOnDelivery" type="radio" value="cod" {{ config('settings.default_payment')=="cod"?"checked":""}}>
                                        <label class="custom-control-label" for="cashOnDelivery"><span class="delTime">{{ config('app.isqrsaas')?__('Cash / Card Terminal'): __('Cash on delivery') }}</span> <span class="picTime">{{ __('Cash on pickup') }}</span></label>
                                    </div>
                                @endif

                                @if($enablePayments)

                                <!-- STIPE CART -->
                                    @if (config('settings.stripe_key')&&config('settings.enable_stripe'))
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="paymentType" class="custom-control-input" id="paymentStripe" type="radio" value="stripe" {{ config('settings.default_payment')=="stripe"?"checked":""}}>
                                            <label class="custom-control-label" for="paymentStripe">{{ __('Pay with card') }}</label>
                                        </div>
                                    @endif

                                <!-- PayPal -->
                                    @if (config('settings.paypal_secret')&&config('settings.enable_paypal'))
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="paymentType" class="custom-control-input" id="paymentPayPal" type="radio" value="paypal" {{ config('settings.default_payment')=="paypal"?"checked":""}}>
                                            <label class="custom-control-label" for="paymentPayPal">{{ __('Pay with PayPal') }}</label>
                                        </div>
                                    @endif

                                <!-- PAYFAST -->
                                    @if(config('settings.enable_paystack'))
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="paymentType" class="custom-control-input" id="paymentPaystack" type="radio" value="paystack" {{ config('settings.default_payment')=="paystack"?"checked":""}}>
                                            <label class="custom-control-label" for="paymentPaystack">{{ __('Pay with Paystack') }}</label>
                                        </div>
                                    @endif

                                <!-- Mollie -->
                                    @if(config('settings.enable_mollie'))
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="paymentType" class="custom-control-input" id="paymentMollie" type="radio" value="mollie" {{ config('settings.default_payment')=="mollie"?"checked":""}}>
                                            <label class="custom-control-label" for="paymentMollie">{{ __('Pay with Mollie') }}</label>
                                        </div>
                                    @endif

                                @endif

                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- END Payment -->

            <!-- Payment Actions -->
        @if(!config('settings.social_mode'))

            <!-- COD -->
            @include('cart.payments.cod')

            <!-- PayPal -->
            @if(config('settings.enable_paypal'))
                @include('cart.payments.paypal')
            @endif

            <!-- Paystack -->
            @if(config('settings.enable_paystack'))
                @include('cart.payments.paystack')
            @endif

            <!-- Mollie -->
                @if(config('settings.enable_mollie'))
                @include('cart.payments.mollie')
                @endif

                </form>

                <!-- Stripe -->
            @include('cart.payments.stripe')
            
        @elseif(config('settings.is_whatsapp_ordering_mode'))
            @include('cart.payments.whatsapp')
        @elseif(config('settings.is_facebook_ordering_mode'))
            @include('cart.payments.facebook')
        @endif
        <!-- END Payment Actions -->
            <br/><br/>
            <div class="text-center">
                <div class="custom-control custom-checkbox mb-3">
                    <input class="custom-control-input" id="privacypolicy" type="checkbox">
                    <label class="custom-control-label" for="privacypolicy">{{ __('I agree to the Terms and Conditions and Privacy Policy') }}</label>
                </div>
            </div>

        </div>
        <br />
        <br />
    </div>
</div>
