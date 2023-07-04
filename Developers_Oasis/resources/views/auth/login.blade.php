@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center p-5">
        <div class="col-lg-5 p-3 shadow-lg" >
            <div class="card border-none bg-white">
                <div class="card-header bg-white border-none fs-1 font-monospace font-weight-bold text-blue text-center">Welcome Back</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-5 justify-content-center mt-5">
                            <div class="w-75">
                                <label class="form-label">EMAIL</label>
                                <input id="email" placeholder="Email" type="email" class="form-control rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-5 justify-content-center">
                            <div class="w-75">
                                <label class="form-label">PASSWORD</label>

                                <input id="password" placeholder="Password" type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row my-5 justify-content-center">
                            <div class="w-75">
                                <div class="form-check d-block d-sm-flex justify-content-between align-items-baseline">
                                   <div>
                                       <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                       <label class="form-check-label" for="remember">
                                           {{ __('Remember Me') }}
                                       </label>
                                   </div>
                                    <div>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary font-weight-bold fs-5 text-white rounded-5 w-75">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        <div class="text-center mt-5">
                            Don't have an account? <a class=" text-decoration-none" href="/register">Sign Up</a>
                        </div>
                    </form>
                    <hr>
                    <div class="d-flex justify-content-center align-items-center mt-4 mx-auto">
                        <a href="{{ url('auth/google') }}" class="btn">
                            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                        </a>
                    </div>
                    <div class="text-center mt-5">
                        <a href="/" class="btn">Go home page</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="d-none d-md-block col-md-7">
            <img src="{{ asset('images/login2.png') }}" class="img-fluid" alt="Illustration">
        </div>
    </div>
</div>
@endsection
