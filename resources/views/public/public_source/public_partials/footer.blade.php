    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50  px-sm-3 px-lg-5" style="margin-top: 20px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-primary"><span class="text-white">Journey</span>JO</h1>
                </a>
                <p>At JourneyJo, we turn your travel dreams into unforgettable adventures. From breathtaking destinations to curated journeys.

                </p>
                
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Our Pages</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="{{ route('public.index')}}"><i class="fa fa-angle-right mr-2"></i>Home</a>
                    <a class="text-white-50 mb-2" href="{{ route('public.tours')}}"><i class="fa fa-angle-right mr-2"></i>Tours</a>
                    <a class="text-white-50 mb-2" href="{{ route('public.custom_tour')}}"><i class="fa fa-angle-right mr-2"></i>Custom Tours</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Know Us</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="{{ route('public.about')}}"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="{{ route('contact.index')}}"><i class="fa fa-angle-right mr-2"></i>Contact</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contact Us</h5>
                <p><i class="fa fa-map-marker-alt mr-2"></i>Amman, Jordan</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+962 79 5567 803</p>
                <p><i class="fa fa-envelope mr-2"></i>zaidayoub117@gmail.com</p>
            </div>
        </div>
    </div>
    
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('public_assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('public_assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public_assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('public_assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('public_assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('public_assets/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('public_assets/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('public_assets/js/main.js') }}"></script>

    <script src="{{ asset('public_assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public_assets/js/templatemo.js') }}"></script>
    <script src="{{ asset('public_assets/js/custom.js') }}"></script>
    <!-- End Script -->

    <!-- Start Slider Script -->
    <script src="{{ asset('public_assets/js/slick.min.js') }}"></script>


   


    <script>
        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>
    <!-- End Slider Script -->
