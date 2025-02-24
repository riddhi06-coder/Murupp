<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
        <body>
            <!-- login page start-->
            <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">    
                <div class="login-card login-dark">
                    <div>
                    <div><a class="logo" href="#"><img class="img-fluid for-dark" src="{{ asset('admin/assets/images/logo/logo-icon-1.webp') }}" alt="looginpage" style="max-width: 17% !important;"><img class="img-fluid for-light" src="{{ asset('admin/assets/images/logo/logo-icon-1.webp') }}" alt="looginpage" style="max-width: 17% !important;"></a></div>
                    <div class="login-main"> 
                    <form class="theme-form" action="{{ route('admin.authenticate') }}" method="POST">
                        @csrf
                        <h4>Sign in to account </h4>
                        <p>Enter your email & password to login</p>

                        <div class="form-group">
                            <label class="col-form-label">Email Address</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required="" placeholder="Enter Email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Password </label>
                            <div class="form-input position-relative">
                                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required="" placeholder="Enter Password">
                                <div class="show-hide"> <span class="show"></span></div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                        <div class="checkbox p-0">
                        <input id="checkbox1" type="checkbox">
                        </div><a class="link" href="{{ route('admin.changepassword') }}">Forgot password?</a>
                            <div class="text-end mt-3">
                                <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                            </div>
                        </div>

                        <p class="mt-4 mb-0 text-center">Don't have an account?<a class="ms-2" href="{{ route('admin.register') }}">Create Account</a></p>
                    </form>

                    </div>
                    </div>
                </div>
                </div>
            </div>
                
            @include('components.backend.main-js')


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.querySelector('input[name="password"]');
        const showHideSpan = document.querySelector('.show-hide .show');

        showHideSpan.addEventListener('click', function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    });
</script>

        </body>

</html>