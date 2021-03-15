@extends('layouts.app', ['class' => 'bg'])

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                {{--<div class="d-flex justify-content-center align-items-center">--}}
                    <div class="align-item-center">
                        <a href="/"><img src="{{ config('global.site_logo') }}" width="200" class="thumbnail" alt="..."></a>


                    </div>
                {{--</div>--}}
            </div>
            <div class="col-md-8 d-flex justify-content-center align-items-center">
                    <div class="row justify-content-center">
                            @if (session('status'))
                                <div class="card bg-secondary shadow border-0">
                                    <div class="card-body">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="card bg-secondary shadow border-0">
                                <div class="card-body px-lg-5 py-lg-5">

                                    @if(config('app.isft')&&(strlen(config('settings.google_client_id'))>3||strlen(config('settings.facebook_client_id'))>3))
                                        <div class="card-header bg-transparent pb-5">
                                            <div class="text-muted text-center mt-2 mb-3"><small>{{ __('Sign in with') }}</small></div>
                                            <div class="btn-wrapper text-center">

                                                @if (strlen(config('settings.google_client_id'))>3)
                                                    <a href="{{ route('google.login') }}" class="btn btn-neutral btn-icon">
                                                        <span class="btn-inner--icon"><img src="{{ asset('argonfront/img/google.svg') }}"></span>
                                                        <span class="btn-inner--text">Google</span>
                                                    </a>
                                                @endif

                                                @if (strlen(config('settings.facebook_client_id'))>3)
                                                    <a href="{{ route('facebook.login') }}" class="btn btn-neutral btn-icon">
                                                        <span class="btn-inner--icon"><img src="{{ asset('custom/img/facebook.png') }}"></span>
                                                        <span class="btn-inner--text">Facebook</span>
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    @endif


                                    <form role="form" method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                                </div>
                                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                            </div>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                                </div>
                                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>
                                            </div>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customCheckLogin">
                                                <span class="text-muted">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-danger my-4">{{ __('Sign in') }}</button>
                                        </div>
                                    </form>
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}" class="text-dark">
                                                        <small>{{ __('Forgot password?') }}</small>
                                                    </a>
                                                @endif
                                            </div>
                                            @if(config('app.isft'))
                                                <div class="col-6 text-right">
                                                    <a href="{{ route('register') }}" class="text-dark">
                                                        <small>{{ __('Create new account') }}</small>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>

@endsection
{{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header">--}}
                {{--<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>--}}
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                    {{--<span aria-hidden="true">&times;</span>--}}
                {{--</button>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--...--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}