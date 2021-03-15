<nav id="navbar-main" class="navbar navbar-light navbar-expand-lg fixed-top " style="height: 83px;">


  <div class="container-fluid">
      <a class="navbar-brand mr-lg-5" href="/">
        <img src="{{ config('global.site_logo') }}" style="height: 98px;">
      </a>
      @if( request()->get('location') )
      <span style="z-index: 10" class="">{{ __('DELIVERING TO')}} :  <b>{{request()->get('location')}}</b></span> <a   data-toggle="modal"  href="#locationset"><span class="ml-sm-2 search description">({{ __('change')}})</span></a>

      @endif
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar_global">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="#">
                <img src="{{ config('global.site_logo') }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
            {{--<li>
                <form style="width:450px">

                    <div class="input-group">
                        <input name="q" class="form-control" value="{{ request()->get('q') }}" placeholder="{{ __ ('Search Products') }}" type="text">
                        <div class="input-group-append">
                            <button type="submit" class="btn" style="background: #e52923;color: #FFFFFf"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </li>--}}
            {{--<form class="example" action="/action_page.php" style="margin:auto;max-width:300px">--}}
                {{--<input type="text" placeholder="Search.." name="search2">--}}
                {{--<button type="submit"><i class="fa fa-search"></i></button>--}}
            {{--</form>--}}
          @if (!config('settings.single_mode')&&config('settings.restaurant_link_register_position')=="navbar")
            <li class="nav-item">
              <a data-mode="popup" target="_blank" class="button nav-link nav-link-icon" href="{{ route('newrestaurant.register') }}">{{ __(config('settings.restaurant_link_register_title')) }}</a>
            </li>
          @endif
          @if (config('app.isft')&&config('settings.driver_link_register_position')=="navbar")
          <li class="nav-item">
              <a data-mode="popup" target="_blank" class="button nav-link nav-link-icon" href="{{ route('driver.register') }}">{{ __(config('settings.driver_link_register_title')) }}</a>
            </li>
            @endif
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="{{ config('global.facebook') }}" target="_blank" data-toggle="tooltip" title="{{ __('Like us on Facebook') }}">
              <i class="fa fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">{{ __('Facebook') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="{{ config('global.instagram') }}" target="_blank" data-toggle="tooltip" title="{{ __('Follow us on Instagram') }}">
              <i class="fa fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">{{ __('Instagram') }}</span>
            </a>
          </li>

          @yield('addiitional_button_1')
          @yield('addiitional_button_2')
          <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
            <li class="nav-item dropdown">
                @auth()
                    @include('layouts.menu.partials.auth')
                @endauth
                @guest()
                    @include('layouts.menu.partials.guest')
                @endguest
            </li>
            <li class="web-menu">
              @if(\Request::route()->getName() != "cart.checkout")
                <a  id="desCartLink" onclick="openNav()" class="btn btn-neutral btn-icon btn-cart" style="cursor:pointer;">
                  <span class="btn-inner--icon">
                    <i class="fa fa-shopping-cart"></i>
                  </span>
                  <span class="nav-link-inner--text">{{ __('Cart') }}</span>
              </a>
              @endif
            </li>
            <li class="mobile-menu">
              @yield('addiitional_button_1_mobile')
              @yield('addiitional_button_2_mobile')
              @if(\Request::route()->getName() != "cart.checkout")
                <a  id="mobileCartLink" onclick="openNav()" class="nav-link" style="cursor:pointer;">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="nav-link-inner--text">{{ __('Cart') }}</span>
                </a>
              @endif
            </li>
          </ul>
        </ul>

      </div>
    </div>

  </nav>

<!-- Modal -->
{{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}


            {{--<div class="modal-body">--}}
                {{--<!-- Nav tabs -->--}}
                {{--<ul class="nav nav-tabs " data-bs-toggle="tab" id="myTab" role="tablist">--}}
                    {{--<li class="nav-item" role="presentation">--}}
                        {{--<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item" role="presentation">--}}
                        {{--<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#registration" type="button" role="tab" aria-controls="registration" aria-selected="false">Registration</button>--}}
                    {{--</li>--}}
                    {{--<li class="nav-item" role="presentation">--}}
                        {{--<button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#reset" type="button" role="tab" aria-controls="reset" aria-selected="false">Password Reset</button>--}}
                    {{--</li>--}}
                {{--</ul>--}}
                {{--<!-- Tab panes -->--}}
                {{--<div class="tab-content">--}}
                    {{--Login Section--}}
                    {{--<div class="tab-pane active" id="login" role="tabpanel" aria-labelledby="login-tab">--}}
                        {{--<div class="container mt-3">--}}
                                {{--<form role="form" method="POST" action="{{ route('login') }}">--}}
                                    {{--@csrf--}}
                                    {{--<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">--}}
                                        {{--<div class="input-group input-group-alternative">--}}
                                            {{--<div class="input-group-prepend">--}}
                                                {{--<span class="input-group-text"><i class="ni ni-email-83"></i></span>--}}
                                            {{--</div>--}}
                                            {{--<input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>--}}
                                        {{--</div>--}}
                                        {{--@if ($errors->has('email'))--}}
                                            {{--<span class="invalid-feedback" style="display: block;" role="alert">--}}
                                            {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                            {{--</span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">--}}
                                        {{--<div class="input-group input-group-alternative">--}}
                                            {{--<div class="input-group-prepend">--}}
                                                {{--<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>--}}
                                            {{--</div>--}}
                                            {{--<input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>--}}
                                        {{--</div>--}}
                                        {{--@if ($errors->has('password'))--}}
                                            {{--<span class="invalid-feedback" style="display: block;" role="alert">--}}
                                            {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                            {{--</span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                    {{--<div class="custom-control custom-control-alternative custom-checkbox">--}}
                                        {{--<input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>--}}
                                        {{--<label class="custom-control-label" for="customCheckLogin">--}}
                                            {{--<span class="text-dark">{{ __('Remember me') }}</span>--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="text-right">--}}
                                        {{--<button type="submit" class="btn btn-danger my-2">{{ __('Sign in') }}</button>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--@if(config('app.isft')&&(strlen(config('settings.google_client_id'))>3||strlen(config('settings.facebook_client_id'))>3))--}}
                                {{--<div class="text-left">--}}
                                    {{--@if (strlen(config('settings.google_client_id'))>3)--}}
                                        {{--<a href="{{ route('google.login') }}" class="btn btn-neutral btn-icon">--}}
                                            {{--<span class="btn-inner--icon"><img class="d-inline" src="{{ asset('argonfront/img/google.svg') }}"> Google</span>--}}
                                        {{--</a>--}}
                                    {{--@endif--}}
                                    {{--@if (strlen(config('settings.facebook_client_id'))>3)--}}
                                        {{--<a href="{{ route('facebook.login') }}" class="btn btn-neutral btn-icon">--}}
                                            {{--<span class="btn-inner--icon"><img class="d-inline"  src="{{ asset('custom/img/facebook.png') }}"> Facebook</span>--}}
                                        {{--</a>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--Registration Section--}}
                    {{--<div class="tab-pane" id="registration" role="tabpanel" aria-labelledby="registration-tab">--}}
                        {{--<div class="container mt-3">--}}
                            {{--<!-- Table -->--}}
                            {{--<div class="row">--}}
                                            {{--<form role="form" method="POST" action="{{ route('register') }}">--}}
                                                {{--@csrf--}}

                                                {{--<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
                                                    {{--<div class="input-group input-group-alternative mb-3">--}}
                                                        {{--<div class="input-group-prepend">--}}
                                                            {{--<span class="input-group-text"><i class="ni ni-hat-3"></i></span>--}}
                                                        {{--</div>--}}
                                                        {{--<input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>--}}
                                                    {{--</div>--}}
                                                    {{--@if ($errors->has('name'))--}}
                                                        {{--<span class="invalid-feedback" style="display: block;" role="alert">--}}
                                        {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                    {{--</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">--}}
                                                    {{--<div class="input-group input-group-alternative mb-3">--}}
                                                        {{--<div class="input-group-prepend">--}}
                                                            {{--<span class="input-group-text"><i class="ni ni-email-83"></i></span>--}}
                                                        {{--</div>--}}
                                                        {{--<input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>--}}
                                                    {{--</div>--}}
                                                    {{--@if ($errors->has('email'))--}}
                                                        {{--<span class="invalid-feedback" style="display: block;" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">--}}
                                                    {{--<div class="input-group input-group-alternative mb-3">--}}
                                                        {{--<div class="input-group-prepend">--}}
                                                            {{--<span class="input-group-text"><i class="ni ni-mobile-button"></i></span>--}}
                                                        {{--</div>--}}
                                                        {{--<input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('Phone') }}" type="phone" name="phone" value="{{ old('phone') }}" required>--}}
                                                    {{--</div>--}}
                                                    {{--@if ($errors->has('phone'))--}}
                                                        {{--<span class="invalid-feedback" style="display: block;" role="alert">--}}
                                        {{--<strong>{{ $errors->first('phone') }}</strong>--}}
                                    {{--</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">--}}
                                                    {{--<div class="input-group input-group-alternative">--}}
                                                        {{--<div class="input-group-prepend">--}}
                                                            {{--<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>--}}
                                                        {{--</div>--}}
                                                        {{--<input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>--}}
                                                    {{--</div>--}}
                                                    {{--@if ($errors->has('password'))--}}
                                                        {{--<span class="invalid-feedback" style="display: block;" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                                {{--<div class="form-group">--}}
                                                    {{--<div class="input-group input-group-alternative">--}}
                                                        {{--<div class="input-group-prepend">--}}
                                                            {{--<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>--}}
                                                        {{--</div>--}}
                                                        {{--<input class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}

                                                {{--@if(config('settings.enable_birth_date_on_register'))--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<div class="input-group input-group-alternative">--}}
                                                            {{--<div class="input-group-prepend">--}}
                                                                {{--<span class="input-group-text"><i class="ni ni-badge"></i></span>--}}
                                                            {{--</div>--}}
                                                            {{--<input class="form-control" placeholder="{{ __('Date of Birth') }}" id="birth_date" type="date" name="birth_date" required>--}}
                                                        {{--</div>--}}
                                                        {{--@if ($errors->has('birth_date'))--}}
                                                            {{--<span class="invalid-feedback" style="display: block;" role="alert">--}}
                                    {{--<strong>{{ $errors->first('birth_date') }}</strong>--}}
                                {{--</span>--}}
                                                        {{--@endif--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}


                                                {{--<div class="text-center">--}}
                                                    {{--<button type="submit" class="btn btn-primary mt-4">{{ __('Create account') }}</button>--}}
                                                {{--</div>--}}
                                            {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--Password reset Section--}}
                    {{--<div class="tab-pane" id="reset" role="tabpanel" aria-labelledby="reset-tab">--}}
                        {{--<div class="container mt-3">--}}
                            {{--<div class="row justify-content-center">--}}
                                {{--@if (session('status'))--}}
                                    {{--<div class="alert alert-success" role="alert">--}}
                                        {{--{{ session('status') }}--}}
                                    {{--</div>--}}
                                {{--@endif--}}

                                {{--<form role="form" method="POST" action="{{ route('password.email') }}">--}}
                                    {{--@csrf--}}
                                    {{--<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">--}}
                                        {{--<div class="input-group input-group-alternative">--}}
                                            {{--<div class="input-group-prepend">--}}
                                                {{--<span class="input-group-text"><i class="ni ni-email-83"></i></span>--}}
                                            {{--</div>--}}
                                            {{--<input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>--}}
                                        {{--</div>--}}
                                        {{--@if ($errors->has('email'))--}}
                                            {{--<span class="invalid-feedback" role="alert">--}}
                                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                                    {{--</span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                    {{--<div class="text-center">--}}
                                        {{--<button type="submit" class="btn btn-primary my-4">{{ __('Send Password Reset Link') }}</button>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}

                {{--<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}