<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


         <!-- page-title -->
         <div class="page-title" style="background-image: url(images/bg/page-title.webp);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">Login</h3>
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Login
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->


        <!-- login -->
        <section class="flat-spacing">
            <div class="container">
                <div class="login-wrap">
                    <div class="left">
                        <div class="heading">
                            <h4>Login</h4>
                        </div>
                        <form action="{{ route('login.store') }}" method="POST" class="form-login form-has-password" onsubmit="return validateLoginForm()">
                            @csrf
                            <div class="wrap">
                                <fieldset class="">
                                    <input class="" type="email" placeholder="Username or email address*" name="email" tabindex="2" value="" aria-required="true" required="">
                                    <div class="text-danger mt-1" id="emailError"></div>
                                </fieldset>
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="Password*" name="password" tabindex="2" value="" aria-required="true" required="">
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide-line"></i>
                                    </span>
                                    <div class="text-danger mt-1" id="passwordError"></div>
                                </fieldset>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="tf-cart-checkbox">
                                        <div class="tf-checkbox-wrapp">
                                            <input class="" type="checkbox" id="login-form_agree" name="remember_me">
                                            <div>
                                                <i class="icon-check"></i>
                                            </div>
                                        </div>
                                        <label for="login-form_agree">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="{{ route('user.forgotpassword') }}" class="font-2 text-button forget-password link">Forgot Your Password?</a>
                                </div>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text text-button">Login</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="right">
                        <h4 class="mb_8">New Customer</h4>
                        <p class="text-secondary">Be part of our growing family of new customers! Join us today and unlock a world of exclusive benefits, offers, and personalized experiences.</p>
                        <a href="#" class="tf-btn btn-fill"><span class="text text-button">Register</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /login -->



        @include('components.frontend.footer')

        @include('components.frontend.main-js')

    <script>
        function validateLoginForm() {
            let isValid = true;

            // Get input values
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();

            // Error message elements
            let emailError = document.getElementById("emailError");
            let passwordError = document.getElementById("passwordError");

            // Reset errors
            emailError.innerText = "";
            passwordError.innerText = "";

            // Email Validation (Basic email pattern)
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                emailError.innerText = "The email field is required.";
                isValid = false;
            } else if (!emailRegex.test(email)) {
                emailError.innerText = "Please enter a valid email address.";
                isValid = false;
            }

            // Password Validation (Cannot be empty)
            if (password === "") {
                passwordError.innerText = "The password field is required.";
                isValid = false;
            }

            return isValid;
        }
    </script>


</body>

</html>