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
                        <h3 class="heading text-center">Create An Account</h3>
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Register
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
                            <h4>Register</h4>
                        </div>
                        <form action="{{ route('registration.store') }}" method="POST" class="form-login form-has-password" onsubmit="return validateForm()">
                            @csrf
                            <div class="wrap">

                                <!-- Name Field -->
                                <fieldset class="">
                                    <input class="" type="text" placeholder="Name*" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                <!-- Email Field -->
                                <fieldset class="">
                                    <input class="" type="email" placeholder="Username or email address*" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                <!-- Password Field -->
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="Password*" name="password" required>
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide-line"></i>
                                    </span>
                                    @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                <!-- Confirm Password Field -->
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="Confirm Password*" name="password_confirmation" required>
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide-line"></i>
                                    </span>
                                    @error('password_confirmation')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                <!-- Terms & Conditions Checkbox -->
                                <div class="d-flex align-items-center">
                                    <div class="tf-cart-checkbox">
                                        <div class="tf-checkbox-wrapp">
                                            <input type="checkbox" id="login-form_agree" name="agree_checkbox">
                                            <div><i class="icon-check"></i></div>
                                        </div>
                                        <label class="text-secondary-2" for="login-form_agree">
                                            I agree to the&nbsp;
                                        </label>
                                    </div>
                                    <a href="term-of-use.html" title="Terms of Service"> Terms of User</a>
                                </div>
                                @error('agree_checkbox')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="button-submit">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text text-button">Register</span>
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="right">
                        <h4 class="mb_8">Already have an account?</h4>
                        <p class="text-secondary">Welcome back. Sign in to access your personalized experience, saved preferences, and more. We're thrilled to have you with us again!</p>
                        <a href="{{ route('user.login') }}" class="tf-btn btn-fill"><span class="text text-button">Login</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /login -->



        @include('components.frontend.footer')


        @include('components.frontend.main-js')


    <script>
        function validateForm() {
            let isValid = true;

            // Get input values
            let name = document.getElementById("name").value.trim();
            let email = document.getElementById("email").value.trim();
            let password = document.getElementById("password").value.trim();
            let confirmPassword = document.getElementById("confirm_password").value.trim();
            let agreeCheckbox = document.getElementById("agree_checkbox").checked;

            // Error message elements
            let nameError = document.getElementById("nameError");
            let emailError = document.getElementById("emailError");
            let passwordError = document.getElementById("passwordError");
            let confirmPasswordError = document.getElementById("confirmPasswordError");
            let agreeError = document.getElementById("agreeError");

            // Reset errors
            nameError.innerText = "";
            emailError.innerText = "";
            passwordError.innerText = "";
            confirmPasswordError.innerText = "";
            agreeError.innerText = "";

            // Name Validation (Only alphabets and spaces)
            let nameRegex = /^[A-Za-z\s]+$/;
            if (name === "") {
                nameError.innerText = "The name field is required.";
                isValid = false;
            } else if (!nameRegex.test(name)) {
                nameError.innerText = "Name must contain only alphabets and spaces.";
                isValid = false;
            }

            // Email Validation (Basic email pattern)
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                emailError.innerText = "The email field is required.";
                isValid = false;
            } else if (!emailRegex.test(email)) {
                emailError.innerText = "Please enter a valid email address.";
                isValid = false;
            }

            // Password Validation (Min 8 characters)
            if (password === "") {
                passwordError.innerText = "The password field is required.";
                isValid = false;
            } else if (password.length < 8) {
                passwordError.innerText = "Password must be at least 8 characters.";
                isValid = false;
            }

            // Confirm Password Validation
            if (confirmPassword === "") {
                confirmPasswordError.innerText = "Please confirm your password.";
                isValid = false;
            } else if (password !== confirmPassword) {
                confirmPasswordError.innerText = "Passwords do not match.";
                isValid = false;
            }

            // Checkbox Validation
            if (!agreeCheckbox) {
                agreeError.innerText = "You must agree to the Terms & Conditions.";
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>

</html>