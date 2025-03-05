<script src="{{ asset('frontend/assets/js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/swiper-bundle.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/carousel.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/lazysize.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/count-down.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/multiple-modal.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/nouislider.min.js') }}" defer></script>
    <!-- <script src="{{ asset('frontend/assets/js/shop.js') }}" defer></script> -->
    <script src="{{ asset('frontend/assets/js/main.js') }}" defer></script>


<!-- Include Notyf CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.css" type="text/css" media="all">
<script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.10.0/notyf.min.js"></script>

<script>
    // Initialize Notyf
    var notyf = new Notyf({
        duration: 5000, // Notification duration
        ripple: true, // Adds a ripple effect
        position: {
            x: 'right',
            y: 'top',
        },
        dismissible: true,
        types: [
            {
                type: 'custom-success',
                background: 'black',  // Black background
                icon: {
                    className: 'fa fa-check-circle', // FontAwesome success icon
                    tagName: 'i',
                    color: 'white'  // White icon color
                }
            }
        ]
    });

    // Display notifications based on session messages
    @if(Session::has('message'))
        notyf.open({
            type: 'custom-success',
            message: " {{ session('message') }}",
        });
    @endif

    @if(Session::has('error'))
        notyf.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
        notyf.open({
            type: 'info',
            message: "<strong>ℹ Info:</strong> {{ session('info') }}"
        });
    @endif

    @if(Session::has('warning'))
        notyf.open({
            type: 'warning',
            message: " {{ session('warning') }}"
        });
    @endif
</script>
