{{--@if(!config('settings.hide_cod'))--}}

    {{--<div class="text-center" id="totalSubmitCOD"  style="display: {{ config('settings.default_payment')=="cod"&&!config('settings.hide_cod')?"block":"none"}};" >--}}
        {{--<button--}}
            {{--v-if="totalPrice"--}}
            {{--type="submit"--}}
            {{--class="btn btn mt-4 mb-3 paymentbutton"--}}
            {{--onclick="this.disabled=true;this.form.submit();" style="background: #e52923;color: #FFFFFF"--}}
        {{-->{{ __('Place Order') }}</button>--}}
    {{--</div>--}}
    {{--<button class="your-button-class" id="sslczPayBtn"--}}
            {{--token="if you have any token validation"--}}
            {{--postdata=""--}}
            {{--order="If you already have the transaction generated for current order"--}}
            {{--endpoint="/pay-via-ajax"> {{__('Pay Via Online')}}--}}
    {{--</button>--}}

    {{--<button class="your-button-class" id="sslczPayBtn"--}}
            {{--token="if you have any token validation"--}}
            {{--postdata="your javascript arrays or objects which requires in backend"--}}
            {{--order="If you already have the transaction generated for current order"--}}
            {{--endpoint="/pay-via-ajax"> Pay Now via ssl--}}
    {{--</button>--}}

    {{--<a class="button" type="button" href="{{url('/pay')}}" id="sslczPayBtn"--}}
       {{--token="if you have any token validation"--}}
       {{--postdata="your javascript arrays or objects which requires in backend"--}}
       {{--order="If you already have the transaction generated for current order"--}}
       {{--endpoint="/pay-via-ajax"> Pay Now via Mehraab--}}
    {{--</a>--}}
{{--@endif--}}
@if(!config('settings.hide_cod'))
    <div class="text-center" id="totalSubmitCOD"  style="display: {{ config('settings.default_payment')=="cod"&&!config('settings.hide_cod')?"block":"none"}};" >
        <button
                v-if="totalPrice"
                type="submit"
                class="btn btn-success mt-4 paymentbutton"
                onclick="this.disabled=true;this.form.submit();"
        >{{ __('Place order') }}</button>
    </div>
@endif