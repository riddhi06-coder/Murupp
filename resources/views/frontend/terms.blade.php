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
                        <h3 class="heading text-center">{{ $terms->first()->heading }}<</h3>
                        <ul class="breadcrumbs d-flex align-items-center">
                            <li>
                                <a class="link" href="{{ route('frontend.index') }}">Home</a>
                            </li>
                            <li>
                                <i class="icon-arrRight"></i>
                            </li>
                            <li>
                            {{ $terms->first()->heading }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><br>

        <!-- /page-title -->

        <!-- Centered Heading and Introduction -->
        <div style="text-align: center;">
            <h4 class="heading">{{ $terms->first()->heading }}</h4>
        </div>
        <div style="text-align: center; padding: 35px; margin: 20px 0; border: 1px solid #ddd; border-radius: 5px;">
            {!! $terms->first()->introduction !!}
        </div>

    
        
        <!-- Terms of use -->
        <section class="flat-spacing">
            <div class="container">
                <div class="terms-of-use-wrap">
                    <div class="left sticky-top">
                        @foreach($terms as $key => $term)
                            <h6 class="btn-scroll-target {{ $loop->first ? 'active' : '' }}" data-scroll="section-{{ $key + 1 }}">
                                {{ $key + 1 }}. {{ $term->title }}
                            </h6>
                        @endforeach
                    </div>
                    
                    <div class="right">
                        <!-- <div style="text-align: center;">
                            <h4 class="heading">{{ $terms->first()->heading }}</h4>
                            <p>{!! $terms->first()->introduction !!}</p>
                        </div> -->

                        @foreach($terms as $key => $term)
                            <div class="terms-of-use-item item-scroll-target" data-scroll="section-{{ $key + 1 }}">
                                <h5 class="terms-of-use-title">{{ $key + 1 }}. {{ $term->title }}</h5>
                                {!! $term->description !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- /Terms of use -->


        @include('components.frontend.footer')

        @include('components.frontend.main-js')
</body>

</html>