
<div class="card card-profile shadow">
    <div class="px-4">
      <div class="mt-2">
        <h5>{{ __('Comment') }}<span class="font-weight-light"></span></h5>
      </div>
      <div class="card-content border-top">
        <div class="form-group{{ $errors->has('comment') ? ' has-danger' : '' }}">
            <textarea name="comment" id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" placeholder="{{ __( 'Your comment here' ) }} ..."></textarea>
            @if ($errors->has('comment'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('comment') }}</strong>
                </span>
            @endif
        </div>
      </div>
    </div>
</div>
<br />
