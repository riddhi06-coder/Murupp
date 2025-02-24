<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>


<body> 
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader"> 
        <div class="loader4"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col-12">     
            <div class="login-card login-dark">
              <div>
              <div><a class="logo" href="#"><img class="img-fluid for-dark" src="{{ asset('admin/assets/images/logo/logo-icon-1.webp') }}" alt="looginpage" style="max-width: 17% !important;"><img class="img-fluid for-light" src="{{ asset('admin/assets/images/logo/logo-icon-1.webp') }}" alt="looginpage" style="max-width: 17% !important;"></a></div>
                <div class="login-main"> 
                <form class="theme-form" action="{{ route('admin.updatepassword') }}" method="POST">
                    @csrf
                    <h6 class="mt-4">Create Your Password</h6>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label class="col-form-label">Email Address</label>
                        <input class="form-control @error('email') is-invalid @enderror" 
                            type="email" name="email" required 
                            placeholder="Enter Email" value="{{ old('email') }}">

                        <!-- Displaying Error Message for Email -->
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- New Password Field -->
                    <div class="form-group">
                        <label class="col-form-label">New Password</label>
                        <div class="form-input position-relative">
                            <input class="form-control @error('password') is-invalid @enderror" 
                                type="password" name="password" required 
                                placeholder="Enter Password" value="{{ old('password') }}">
                            <div class="show-hide"><span class="show"></span></div>
                        </div>

                        <!-- Displaying Error Message for Password -->
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Retype Password Field -->
                    <div class="form-group">
                        <label class="col-form-label">Retype Password</label>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" 
                            type="password" name="password_confirmation" required 
                            placeholder="Enter Password" value="{{ old('password_confirmation') }}">

                        <!-- Displaying Error Message for Password Confirmation -->
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mb-0">
                        <button class="btn btn-primary btn-block w-100" type="submit">Done</button>
                    </div>

                    <!-- Sign In Link -->
                    <p class="mt-4 mb-0 text-center">Already have a password?<a class="ms-2" href="{{ route('admin.login') }}">Sign in</a></p>
                </form>

                </div>
              </div>
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