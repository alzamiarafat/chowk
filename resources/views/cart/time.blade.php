<div class="card card-profile shadow d-none">
    <div class="px-4">
      <div class="mt-2">
        <h6><span class="delTime delTimeTS">{{ __('Delivery time') }}</span><span class="picTime picTimeTS">{{ __('Pickup time') }}</span><span class="font-weight-light"></span></h6>
      </div>
      <div class="card-content">
        <select name="timeslot" id="timeslot" class="form-control{{ $errors->has('timeslot') ? ' is-invalid' : '' }}" required>
          @foreach ($timeSlots as $value => $text)
              <option value={{ $value }}>{{$text}}</option>
          @endforeach
      </select>
      </div>
      <br />
    </div>
  </div>
  <br />