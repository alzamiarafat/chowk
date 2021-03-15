<!-- STRIPE -->
{{--@if (config('settings.stripe_key')&&config('settings.enable_stripe'))--}}
    {{--<form action="/charge" method="post" id="stripe-payment-form" style="display: {{ config('settings.default_payment')=="stripe"?"block":"none"}};"   >--}}
        {{--<div style="width: 100%;" class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
            {{--<input name="name" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __( 'Name on card' ) }}" value="{{auth()->user()?auth()->user()->name:""}}" required>--}}
            {{--@if ($errors->has('name'))--}}
                {{--<span class="invalid-feedback" role="alert">--}}
                {{--<strong>{{ $errors->first('name') }}</strong>--}}
            {{--</span>--}}
            {{--@endif--}}
        {{--</div>--}}
        {{--<div class="form">--}}
            {{--<div style="width: 100%;" #stripecardelement  id="card-element" class="form-control">--}}
                {{--<!-- A Stripe Element will be inserted here. -->--}}
            {{--</div>--}}
            {{--<!-- Used to display form errors. -->--}}
            {{--<br />--}}
            {{--<div class="" id="card-errors" role="alert">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="text-center" id="totalSubmitStripe">--}}
            {{--<button--}}
                    {{--v-if="totalPrice"--}}
                    {{--type="submit"--}}
                    {{--class="btn btn-success mt-4 mb-2 paymentbutton"--}}
            {{-->{{ __('Place an order') }}</button>--}}
        {{--</div>--}}
    {{--</form>--}}
    <div class="text-center" id="totalSubmitStripe"  style="display: {{ config('settings.default_payment')=="stripe"?"block":"none"}};" >
        {{--<button--}}
                {{--v-if="totalPrice"--}}
                {{--type="submit"--}}
                {{--class="btn btn-success mt-4 mb-3 paymentbutton"--}}
                {{--onclick="this.disabled=true;this.form.submit();">{{ __('Pay Online') }}</button>--}}
        {{--<button class="btn btn-success mt-4 mb-3 paymentbutton" id="sslczPayBtn"--}}
                {{--token="if you have any token validation"--}}
                {{--postdata="your javascript arrays or objects which requires in backend"--}}
                {{--order="If you already have the transaction generated for current order"--}}
                {{--endpoint="{{ url('/pay-via-ajax') }}"> Pay Now By SSL--}}
        {{--</button>--}}
            {{--<button--}}
                    {{--v-if="totalPrice"--}}
                    {{--type="submit"--}}
                    {{--class="btn btn-success mt-4 mb-3 paymentbutton"--}}
                    {{--onclick="this.disabled=true;this.form.submit();"--}}
            {{-->{{ __('Place order by online') }}</button>--}}
        {{--<button type="button" class="btn btn-success mt-4 mb-3 paymentbutton" id="sslczPayBtn"> Pay Now By SSL</button>--}}



    </div>
{{--@endif--}}