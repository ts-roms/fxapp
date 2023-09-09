@extends('layouts.auth')

@section('content')
<div class="container-fluid" style="height: 100vh;">
    <div class="row h-100">
        <div class="col-md-8">
            <div class="w-100">
            </div>
        </div>
        <div class="col-md-4 border-left border-2 mt-5">
            <div class="my-5">
                <div class="card-body w-75 m-auto">
                    <img class="logo" src="{{ get_logo() }}" alt='...'>

                    <h5 class="text-center py-4">{{ _lang('Login To Your Account') }}</h4>

                        @if (Session::has('error'))
                        <div class="alert alert-danger text-center">
                            <strong>{{ session('error') }}</strong>
                        </div>
                        @endif

                        @if (Session::has('registration_success'))
                        <div class="alert alert-success text-center">
                            <strong>{{ session('registration_success') }}</strong>
                        </div>
                        @endif

                        <form method="POST" class="form-signin" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="email" type="email"
                                        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" value="{{ old('email') }}" placeholder="{{ _lang('Email') }}"
                                        required autofocus>

                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">

                                    <input id="password" type="password" autocomplete="false"
                                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" placeholder="{{ _lang('Password') }}" required>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="hidden" name="g-recaptcha-response" id="recaptcha">
                                    @if ($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-center">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="remember" {{
                                        old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ _lang('Remember Me')
                                        }}</label>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ _lang('Login') }}
                                    </button>

                                    @if (get_option('member_signup') == 1)
                                    <a href="{{ route('register') }}" class="btn btn-link btn-register">{{ _lang('Create
                                        Account') }}</a>
                                    @endif
                                </div>
                            </div>

                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@if (get_option('enable_recaptcha', 0) == 1)
<script src="https://www.google.com/recaptcha/api.js?render={{ get_option('recaptcha_site_key') }}"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('{{ get_option('recaptcha_site_key') }}', {
            action: 'login'
        }).then(function (token) {
            if (token) {
                document.getElementById('recaptcha').value = token;
            }
        });
    });
</script>
@endif
@endsection