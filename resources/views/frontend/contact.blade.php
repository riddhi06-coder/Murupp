<!doctype html>
<html lang="en">
    
<head>
    @include('components.frontend.head')

</head>
	   

<body class="preload-wrapper">

        @include('components.frontend.header')


         <!-- page-title -->
         <div class="page-title">
            <div class="container">
                <h3 class="heading text-center">Contact Us</h3>
                <ul class="breadcrumbs d-flex align-items-center">
                    <li><a class="link" href="index.html">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <!-- /page-title -->

        <!-- contact-us -->
        <section class="flat-spacing">
            <div class="container">
                <div class="contact-us-content">
                    <div class="left">
                        <h4 class="mb-3">Get In Touch</h4>
                        <form id="contactform1" action="{{ route('form.contact') }}" method="POST" class="form-leave-comment">
                            @csrf
                            <div class="wrap">
                                <div class="cols">
                                    <!-- Name Field -->
                                    <fieldset>
                                        <input type="text" placeholder="Your Name*" name="name" id="name" required>
                                        <span class="text-danger" id="nameError"></span>
                                    </fieldset>

                                    <!-- Email Field -->
                                    <fieldset>
                                        <input type="email" placeholder="Your Email*" name="email" id="email" required>
                                        <span class="text-danger" id="emailError"></span>
                                    </fieldset>
                                </div>

                                <!-- Message Field -->
                                <fieldset>
                                    <textarea name="message" id="message" rows="4" placeholder="Your Message*" required></textarea>
                                    <span class="text-danger" id="messageError"></span>
                                </fieldset>
                            </div>

                            <!-- Submit Button -->
                            <div class="button-submit send-wrap">
                                <button class="tf-btn btn-fill" type="submit">
                                    <span class="text text-button">Send message</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    @php
                        $footer = \App\Models\Footer::first();
                    @endphp
                    <div class="right">
                        <h4>Information</h4>
                        <div class="mb_20">
                            <div class="text-title mb_8">Phone:</div>
                            <p class="text-secondary">+91 {{ $footer->contact_number ?? '' }}</p>
                        </div>
                        <div class="mb_20">
                            <div class="text-title mb_8">Email:</div>
                            <p class="text-secondary">{{ $footer->email ?? '' }}</p>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </section>
         <section class="flat-spacing pt-0 pb-0">
            <div class="heading-section text-center wow fadeInUp">
                <h3 class="heading">INSTAGRAM - @murupp</h3>
                <p class="subheading text-secondary">Elevate your wardrobe with fresh finds today!</p>
            </div>
            <script src="https://static.elfsight.com/platform/platform.js" async></script>
            <div class="elfsight-app-8f24f565-abc8-4144-95c9-4922f192f0cf" data-elfsight-app-lazy></div>
        </section>
        <!-- /contact-us -->

        @include('components.frontend.footer')

        @include('components.frontend.main-js')



        <!--- for form validation--->
        <script>
            document.getElementById('contactform1').addEventListener('submit', function(event) {
                let isValid = true;

                // Name Validation
                let name = document.getElementById('name').value.trim();
                let nameError = document.getElementById('nameError');
                let nameRegex = /^[a-zA-Z\s]+$/;

                if (!nameRegex.test(name)) {
                    nameError.innerText = "Name must contain only letters & spaces.";
                    isValid = false;
                } else {
                    nameError.innerText = "";
                }

                // Email Validation
                let email = document.getElementById('email').value.trim();
                let emailError = document.getElementById('emailError');
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailRegex.test(email)) {
                    emailError.innerText = "Enter a valid email address.";
                    isValid = false;
                } else {
                    emailError.innerText = "";
                }

                // Message Validation
                let message = document.getElementById('message').value.trim();
                let messageError = document.getElementById('messageError');

                if (message.length === 0) {
                    messageError.innerText = "Message cannot be empty.";
                    isValid = false;
                } else {
                    messageError.innerText = "";
                }

                // Prevent Form Submission if Validation Fails
                if (!isValid) {
                    event.preventDefault();
                }
            });
        </script>

</body>

</html>