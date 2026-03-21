
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Register & Signup | Wabe Digital Agency</title>
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
                                    <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less than a minute</p>
                                </div>

                                <form method="POST" action="{{ route('register') }}">
        @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input class="form-control" name="name" type="text" id="name" placeholder="Enter your name" :value="old('name')" required>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">User Name</label>
                                        <input class="form-control" type="text" name="username" :value="old('username')" id="username" placeholder="Enter your username" :value="old('username')" required>
                                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" name="email" type="email" id="email" required placeholder="Enter your email">
                                         <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

   <!-- Password -->
       
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password"  class="form-control" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>

    

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password_confirmation" name="password_confirmation"  class="form-control" placeholder="Confirm password" required autocomplete="new-password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                             <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>


                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                            <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-success" type="submit"> Sign Up </button>
                                    </div>

                                </form>

            

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-white-50">Already have account?  <a href="{{route('login')}}" class="text-white ms-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
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































































