
@extends('auth.layout.app')
@section('content')

 <div id="content" class="no-top no-bottom">
    <div class="container-fluid">
        <div class="row d-flex vh-100">

            <div class="col-md-6 col-lg-4 d-flex overlay-box">
                <div class="overlay-background"></div>
                <div class="overlay-content mx-auto">
                    <div class="row no-gutters my-auto">
                        <div class="col logo py-4 mx-auto">
                            <a class="logo-link" href="#">
                                <img class="logo-image" alt="Logo" src="{{asset('images-webstudio/logo.png')}}" />
                            </a>
                        </div>
                    </div>
                    <div class="row no-gutters my-auto">
                        <div class="col message-box px-2 mx-auto">
                            <h2 class="text-white mb-4">Hello, Friend!</h2>
                            <p class="mb-4">Create an account to start journey with us.</p>
                            <a class="btn btn-line" href="{{route('register-user')}}">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6 col-lg-8 form-box">
                <div class="d-flex flex-column sign-in-container h-100">
                    <div class="align-items-center sign-in px-3 mx-auto my-auto">


                       <form class="sign-in-form h-100" method="POST" action="{{ route('login.custom') }}">
                        @csrf
                        <h2 class="text-neutral font-weight-bold pb-2">Welcome back!</h2>
                        <p class="text-main">Login with your email address and password to keep connected with us.</p>

                        <!-- <div id="social-container" class="text-center py-3">
                            <button class="btn btn-sm btn-facebook mr-2 box-rounded" type="button"><i class="fab fa-facebook-square"></i></button>
                            <button class="btn btn-sm btn-pinterest mr-2 box-rounded" type="button"><i class="fab fa-pinterest"></i></button>
                            <button class="btn btn-sm btn-twitter box-rounded" type="button"><i class="fab fa-twitter"></i></button>
                        </div> -->

                       <!--  <span class="text-main mb-2">or use your account</span> -->

                        <div class="form-group">
                            <label class="d-flex" for="email">{{ __('Email Address') }}</label>

                            <input class="form-control @error('email') is-invalid @enderror form-control-lg box-rounded" type="email" id="" value="{{ old('email') }}" name="email" required autocomplete="email" autofocus />

                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="form-group mb-4">
                            <label class="d-flex" for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror form-control-lg box-rounded" type="password" id="" name="password" required="" />




                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                        <div class="form-row text-nowrap d-flex my-4">
                            <div class="col d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <label class="form-check-label justify-content-lg-center align-items-lg-center" for="formCheck">Remember me</label>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end align-items-center">
                                <a class="text-neutral forgot-password-text" href="forgot-password.html">Forgot your password?</a>
                            </div>
                        </div>

                        <button class="btn btn-line" type="submit">Sign in</button>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
</div>


@endsection
