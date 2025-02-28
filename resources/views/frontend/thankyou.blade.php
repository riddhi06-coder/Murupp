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
                        <h3 class="heading text-center">Thank You</h3>
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="#">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                                Thank You
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
                <div class="thank-wrap">
                    <div class="col-md-12">
                        <h4 class="mb">Thank You !</h4>
                        <p class="text-secondary mb_16">Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being you.</p>
                        <a href="{{ route('frontend.index') }}" class="tf-btn btn-fill"><span class="text text-button">Go To Home</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- /login -->

        @include('components.frontend.footer')

        @include('components.frontend.main-js')
</body>

</html>