
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
                <h3 class="heading text-center">About Us</h3>
                <ul class="breadcrumbs d-flex align-items-center">
                    <li><a class="link" href="{{ route('frontend.index') }}">Home</a></li>
                    <li><i class="icon-arrRight"></i></li>
                    <li><a class="link" href="#">About Us</a></li>
                </ul>
            </div>
        </div>
        <!-- /page-title -->
            <!-- Section checkout -->

            <section class="flat-spacing about-us-main">
                <div class="container">
                    @foreach ($terms as $term)
                        <div class="row flat-img-with-text-v2 align-items-center">
                            <!-- Image Section -->
                            <div class="col-lg-4 col-md-6">
                                <div class="about-us-features wow fadeInLeft">
                                    <img class="lazyload" data-src="{{ asset('murupp/about/' . $term->banner_image) }}" alt="About Image">
                                </div>
                            </div>
                            <!-- Text Section -->
                            <div class="col-lg-8 col-md-6">
                                <article class="banner-left">
                                    <div class="box-title wow fadeInUp">
                                        <blockquote>
                                            <p>{!! $term->description !!}</p>
                                        </blockquote>
                                    </div>
                                </article>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>


        @include('components.frontend.footer')

        @include('components.frontend.main-js')

</body>

</html>