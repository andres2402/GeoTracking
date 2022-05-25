@extends('layouts.app', [
'class' => 'login-page',
'backgroundImagePath' => 'img/bg/fabio-mangione.jpg'
])

@section('content')
<div class="content">
    <div class="container">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="card card-login">
                    <div class="card-header ">
                        <div class="card-header ">
                            <h3 class="header text-center">{{ __('Login') }}</h3>
                        </div>
                    </div>
                    <div class="card-body ">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="nc-icon nc-single-02"></i>
                                </span>
                            </div>
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>
                            
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="nc-icon nc-single-02"></i>
                                </span>
                            </div>
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} passwordInput" name="password" placeholder="{{ __('Password') }}" type="password" required>
                            <div class="input-group-append showPassword">
                                <span class="input-group-text pl-2"><i class="fa fa-eye-slash passIcon" aria-hidden="true"></i></span>
                            </div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" name="remember" type="checkbox" value="" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="form-check-sign"></span>
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning btn-round mb-3">{{ __('Sign in') }}</button>
                        </div>
                    </div>
                </div>
            </form>
            <a href="{{ route('password.request') }}" class="btn btn-link">
                {{ __('Forgot password') }}
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        demo.checkFullPageBackgroundImage();

        $('.showPassword').on('click', function(){
            $('.passIcon').toggleClass('fa-eye')
            $('.passIcon').toggleClass('fa-eye-slash')

            if($('.passIcon').hasClass('fa-eye')){
                $('.passwordInput').attr('type', 'text')
            }else{
                $('.passwordInput').attr('type', 'password')
            }
        })
    });
</script>
@endpush