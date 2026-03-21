
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Register & Signup | Wabe Digital Agency </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin CMS by Wabe Digital Agency" name="description" />
        <meta content="WABE CMS" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        


         <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">
        <!-- Bootstrap css -->
        <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
        <!-- icons -->
        <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Head js -->
        <script src="{{asset('backend/assets/js/head.js')}}"></script>


    </head>

    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="/" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('logo/logo-img.png')}}" alt="" height="50">
                                            </span>
                                        </a>
                    
                                     
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
        @csrf

                                
<!-- Email Address -->

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input class="form-control" name="email" type="email" name="email" id="email" required placeholder="Enter your email">
                                         <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

   <!-- Password -->
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password"  class="form-control" placeholder="Enter your password" required autocomplete="current-password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                
                                    <div class="text-center d-grid">
                                         @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
                                        <button class="btn btn-success" type="submit"> Log In </button>
                                    </div>

                                </form>

            

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> &copy; WabeStudio by <a href="https://wabestudio.co.ke/" class="text-white-50">Wabe Digital Agency</a> 
        </footer>

        <!-- Vendor js -->
       <script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>

        <!-- App js -->
       <script src="{{asset('backend/assets/js/app.min.js')}}"></script>
        
    </body>
</html>

