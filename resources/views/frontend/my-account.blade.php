
<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')
</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


        <!-- page-title -->
          <div class="page-title" style="background-image: url(images/section/page-title.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="heading text-center">My Account</h3>
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                My Account
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->


        <!-- my-account -->
          <section class="flat-spacing">
            <div class="container">
                <div class="my-account-wrap">
                    <div class="wrap-sidebar-account">
                        <div class="sidebar-account">
                            <div class="account-avatar">
                            <div class="image">
                                <img src="{{ $user->image ? asset('uploads/profile_pictures/' . $user->image) : asset('frontend/assets/images/user-account.png') }}" 
                                    alt="Profile Picture">
                            </div>

                                @if(Auth::check())
                                    <h6 class="mb_4">{{ $user->name }} {{ $user->last_name }}</h6>
                                    <div class="body-text-1">{{ $user->email }}</div>
                                @endif
                            </div>
                            <ul href="{{ route('my.account') }}" class="my-account-nav">
                                <li>
                                    <span class="my-account-nav-item active">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Account Details
                                    </span>
                                </li>
                                <li>
                                    <a href="{{ route('my.account.orders') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.5078 10.8734V6.36686C16.5078 5.17166 16.033 4.02541 15.1879 3.18028C14.3428 2.33514 13.1965 1.86035 12.0013 1.86035C10.8061 1.86035 9.65985 2.33514 8.81472 3.18028C7.96958 4.02541 7.49479 5.17166 7.49479 6.36686V10.8734M4.11491 8.62012H19.8877L21.0143 22.1396H2.98828L4.11491 8.62012Z" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Your Orders
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.logout') }}" class="my-account-nav-item">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16 17L21 12L16 7" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M21 12H9" stroke="#181818" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="my-account-content">
                        <div class="account-details">
                        <form action="{{ route('user.account.update') }}" method="POST" class="form-account-details form-has-password" enctype="multipart/form-data">
                            @csrf

                            <div class="account-info">
                                <h5 class="title">Information</h5>
                                <div class="cols mb_20">
                                    <fieldset>
                                        <input type="text" placeholder="First Name*" name="first_name" value="{{ old('first_name', $user->name ?? '') }}" required>
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" placeholder="Last Name*" name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}">
                                    </fieldset>
                                </div>
                                <div class="cols mb_20">
                                    <fieldset>
                                        <input type="email" placeholder="Username or email address*" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                                    </fieldset>
                                    <fieldset>
                                        <input type="text" placeholder="Phone*" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                                    </fieldset>
                                </div>
                                <div class="tf-select">
                                    <input type="text" class="text-title" name="country" value="India" readonly>
                                </div><br>

                                <div class="cols mb_20">
                                    <fieldset style="border: 1px solid #ccc; padding: 10px; border-radius: 5px; position: relative;">
                                        <label for="profile_picture" class="profile-label" style="font-weight: 600;">Upload Profile Picture</label>
                                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="previewProfileImage()" 
                                            style="display: block; width: 100%; padding: 5px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
                                        
                                        <!-- Error Message -->
                                        <div class="invalid-feedback" id="profile_error" style="color: red; font-size: 12px; margin-top: 5px;"></div>
                                        
                                        <!-- Info Text Below Input -->
                                        <small class="text-secondary" style="display: block; margin-top: 5px;">
                                            <b>Note: The file size should be less than 2MB.</b>
                                        </small>
                                        <small class="text-secondary" style="display: block;">
                                            <b>Note: Only images (.jpg, .jpeg, .png, .webp) are allowed.</b>
                                        </small>

                                        <!-- Profile Picture Preview -->
                                        <div class="preview-container" style="margin-top: 10px; text-align: center;">
                                            <img id="profilePreview" src="#" alt="Profile Preview" 
                                                style="display: none; max-width: 100px; border-radius: 50%; border: 2px solid #ccc; padding: 5px;">
                                        </div>
                                    </fieldset>
                                </div>

                            </div>


                            <div class="account-password">
                                <h5 class="title">Change Password</h5>
                                <fieldset class="position-relative password-item mb_20">
                                    <input class="input-password" type="password" placeholder="Current Password*" name="current_password">
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide-line"></i>
                                    </span>
                                </fieldset>
                                <fieldset class="position-relative password-item mb_20">
                                    <input class="input-password" type="password" placeholder="New Password*" name="new_password">
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide-line"></i>
                                    </span>
                                </fieldset>
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="Confirm Password*" name="new_password_confirmation">
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide-line"></i>
                                    </span>
                                </fieldset>
                            </div>


                            <div class="button-submit">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text text-button">Update Account</span>
                                </button>
                            </div>
                        </form>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /my-account -->


        
        @include('components.frontend.footer')

        @include('components.frontend.main-js')

        <!---- for the profile form validations--->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const form = document.querySelector(".form-account-details");

                form.addEventListener("submit", function (event) {
                    let isValid = true;

                    // Get form fields
                    const firstName = document.querySelector('input[name="first_name"]');
                    const lastName = document.querySelector('input[name="last_name"]');
                    const email = document.querySelector('input[name="email"]');
                    const phone = document.querySelector('input[name="phone"]');
                    const currentPassword = document.querySelector('input[name="current_password"]');
                    const newPassword = document.querySelector('input[name="new_password"]');
                    const confirmPassword = document.querySelector('input[name="new_password_confirmation"]');

                    // Remove previous error messages
                    document.querySelectorAll(".error-message").forEach(el => el.remove());

                    // Name Validation (No numbers or special characters)
                    const nameRegex = /^[A-Za-z\s]+$/;
                    if (!nameRegex.test(firstName.value.trim())) {
                        showError(firstName, "First name should contain only letters");
                        isValid = false;
                    }
                    if (lastName.value.trim() && !nameRegex.test(lastName.value.trim())) {
                        showError(lastName, "Last name should contain only letters");
                        isValid = false;
                    }

                    // Email Validation
                    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                    if (!emailRegex.test(email.value.trim())) {
                        showError(email, "Enter a valid email address");
                        isValid = false;
                    }

                    // Phone Number Validation (Only 10 digits)
                    if (phone.value.trim() && !/^\d{10}$/.test(phone.value.trim())) {
                        showError(phone, "Phone number must be exactly 10 digits");
                        isValid = false;
                    }

                    // New Password Validation (At least 8 characters, including one special character)
                    const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                    if (newPassword.value.trim() && !passwordRegex.test(newPassword.value.trim())) {
                        showError(newPassword, "Password must be at least 8 characters long, including one letter, one number, and one special character.");
                        isValid = false;
                    }

                    // Confirm Password Validation (Must match new password)
                    if (newPassword.value.trim() !== confirmPassword.value.trim()) {
                        showError(confirmPassword, "Passwords do not match.");
                        isValid = false;
                    }

                    // Prevent form submission if validation fails
                    if (!isValid) {
                        event.preventDefault();
                    }
                });

                // Function to show error messages below respective fields
                function showError(input, message) {
                    const errorDiv = document.createElement("div");
                    errorDiv.className = "error-message";
                    errorDiv.style.color = "red";
                    errorDiv.style.fontSize = "12px";
                    errorDiv.textContent = message;
                    input.parentNode.appendChild(errorDiv);
                }
            });
        </script>

        <!---- Image PReiview and validation--->
        <script>
            function previewProfileImage() {
                const input = document.getElementById("profile_picture");
                const preview = document.getElementById("profilePreview");
                const errorDiv = document.getElementById("profile_error");

                // Reset error message
                errorDiv.textContent = "";

                // Check if a file is selected
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const fileSize = file.size / 1024 / 1024; // Convert bytes to MB

                    // Validate file size (2MB max)
                    if (fileSize > 2) {
                        errorDiv.textContent = "File size should be less than 2MB.";
                        input.value = "";
                        preview.style.display = "none";
                        return;
                    }

                    // Validate file type
                    const allowedExtensions = ["image/jpeg", "image/png", "image/webp"];
                    if (!allowedExtensions.includes(file.type)) {
                        errorDiv.textContent = "Only JPG, JPEG, PNG, and WEBP files are allowed.";
                        input.value = "";
                        preview.style.display = "none";
                        return;
                    }

                    // Preview image
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.style.display = "block";
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>


</body>

</html>