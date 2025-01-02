@extends('public.public_source.public_template')

@section('home_active', 'active')

@section('content')


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100 img-fluid" src="{{ asset('public_assets/img/petra2.jpg') }}" alt="Image"
                        style="object-fit: cover; height: 100vh;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                            <h1 class="display-3 text-white mb-md-4">Let's Discover Jordan Together</h1>
                            <a href="{{ route('public.tours') }}"
                                class="btn btn-primary rounded-pill py-md-3 px-md-5 mt-2">lets Have Fun!</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100 img-fluid" src="{{ asset('public_assets/img/ajloun_teleferik.jpeg') }}" alt="Image"
                        style="object-fit: cover; height: 100vh;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                            <h1 class="display-3 text-white mb-md-4">Design Your Personalized Tour</h1>
                            <a href="{{ route('public.custom_tour') }}"
                                class="btn btn-primary rounded-pill py-md-3 px-md-5 mt-2">Build Your Tour!</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Booking Start -->
    <div class="container-fluid booking" style="margin-top: -85px !important;">
        <div class="container">
            <form action="{{ route('public.tours') }}" method="get">
                @csrf
                <div class="bg-light shadow"
                    style="padding: 20px; border-radius: 30px 30px 0px 0px !important; height:85px;">
                    <div class="row align-items-center" style="min-height: 60px;">
                        <div class="col-md-10">
                            <div class="row">
                                <!-- Destination (Category) Selection -->
                                <div class="col-md-4">
                                    <div class="mb-3 mb-md-0">
                                        <select class="custom-select rounded-pill px-4" style="height: 47px;"
                                            name="category_id">
                                            <option selected disabled>Select Category</option>
                                            <!-- Loop through categories to display options -->
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Depart Date Selection -->
                                <div class="col-md-4">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date1" data-target-input="nearest">
                                            <input type="text" class="form-control p-4 rounded-pill datetimepicker-input"
                                                placeholder="Depart Date" data-target="#date1" data-toggle="datetimepicker"
                                                name="depart_date" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Return Date Selection -->
                                <div class="col-md-4">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date2" data-target-input="nearest">
                                            <input type="text" class="form-control p-4 rounded-pill datetimepicker-input"
                                                placeholder="Return Date" data-target="#date2" data-toggle="datetimepicker"
                                                name="return_date" />
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-2">
                            <button class="btn btn-primary rounded-pill btn-block" type="submit"
                                style="height: 47px; margin-top: -2px;">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Booking End -->


    <!-- Feature Start -->
    <div class="container-fluid pb-5 mt-5">
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3"
                            style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-money-check-alt text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Competitive Pricing</h5>
                            <p class="m-0">Affordable travel options that maximize your experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3"
                            style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-award text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Best Services</h5>
                            <p class="m-0">Exceptional service for a hassle-free journey.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3"
                            style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-globe text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Jordan Coverage</h5>
                            <p class="m-0">Explore all of Jordan with our extensive coverage.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('public_assets/img/jordan.webp') }}"
                            style="object-fit: cover; border-radius: 30px 0px 30px 0px !important;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5"
                        style="border-radius: 0px 30px 0px 30px !important;">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h6>
                        <h1 class="mb-3">We Provide Best Tour Packages In Your Budget</h1>
                        <p>At JourneyJo, we turn your travel dreams into unforgettable adventures. From breathtaking
                            destinations to curated journeys, we ensure every step of your trip is extraordinary.</p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid rounded" src="{{ asset('public_assets/img/ajloun.webp') }}"
                                    alt="">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid rounded" src="{{ asset('assets/img/about-us.jpg') }}"
                                    alt="">
                            </div>
                        </div>
                        <a href="{{ route('public.about') }}" class="btn rounded-pill btn-primary mt-1">Know more!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    {{-- Category Start --}}
    <div class="categories-section">
        <style>
            .categories-section {
                position: relative;
                background-color: #f5f5f5;
                /* Light gray background */
                overflow: hidden;
            }

            /* Updated background elements */
            .bg-pattern {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, #ffffff 25%, transparent 25%) -50px 0,
                    linear-gradient(225deg, #ffffff 25%, transparent 25%) -50px 0,
                    linear-gradient(315deg, #ffffff 25%, transparent 25%),
                    linear-gradient(45deg, #ffffff 25%, transparent 25%);
                background-size: 100px 100px;
                background-color: #f5f5f5;
                opacity: 0.3;
            }

            /* Subtle gradient overlay */
            .gradient-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(45deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.6) 100%);
            }

            /* Keep all other existing styles the same */
            .floating-shape {
                position: absolute;
                background: linear-gradient(45deg, #C77943, #E5B695);
                opacity: 0.1;
                border-radius: 50%;
                animation: float 6s ease-in-out infinite;
            }

            .shape1 {
                width: 300px;
                height: 300px;
                top: -150px;
                left: -150px;
            }

            .shape2 {
                width: 200px;
                height: 200px;
                bottom: -100px;
                right: -100px;
                animation-delay: -2s;
            }

            .shape3 {
                width: 150px;
                height: 150px;
                top: 50%;
                left: 30%;
                animation-delay: -4s;
            }

            .desert-wave {
                position: absolute;
                width: 100%;
                height: 100%;
                background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23C77943' fill-opacity='0.1' d='M0,128L48,144C96,160,192,192,288,197.3C384,203,480,181,576,181.3C672,181,768,203,864,197.3C960,192,1056,160,1152,144C1248,128,1344,128,1392,128L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
                background-size: 200% 100%;
                animation: waveMove 20s linear infinite;
                opacity: 0.2;
            }

            .arabic-pattern {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23C77943' fill-opacity='0.1'%3E%3Cpath d='M30 30L45 15M30 30L15 45M30 30L15 15M30 30L45 45'/%3E%3C/g%3E%3C/svg%3E");
                opacity: 0.1;
                animation: patternRotate 40s linear infinite;
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0) rotate(0deg);
                }

                50% {
                    transform: translateY(-20px) rotate(5deg);
                }
            }

            @keyframes patternMove {
                0% {
                    background-position: 0 0;
                }

                100% {
                    background-position: 60px 60px;
                }
            }

            @keyframes waveMove {
                0% {
                    background-position-x: 0%;
                }

                100% {
                    background-position-x: 200%;
                }
            }

            @keyframes patternRotate {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            /* Keep all content styling the same */
            .content-wrapper {
                position: relative;
                z-index: 1;
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 15px;
                padding: 2rem;
                box-shadow: 0 4px 20px rgba(199, 121, 67, 0.1);
                backdrop-filter: blur(5px);
            }

            /* Keep all other styles exactly as they were */
            .section-title {
                color: #C77943;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 5px;
                position: relative;
                display: inline-block;
            }

            .section-title::after {
                content: '';
                position: absolute;
                bottom: -10px;
                left: 0;
                width: 100%;
                height: 2px;
                background: linear-gradient(90deg, transparent, #C77943, transparent);
            }

            .destination-item {
                transition: all 0.3s ease;
                border-radius: 15px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .destination-item:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(199, 121, 67, 0.2);
            }

            .destination-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background: linear-gradient(to bottom, rgba(199, 121, 67, 0.2), rgba(199, 121, 67, 0.8));
                opacity: 0;
                transition: all 0.3s ease;
            }

            .destination-item:hover .destination-overlay {
                opacity: 1;
            }

            .destination-overlay h5,
            .destination-overlay span {
                transform: translateY(20px);
                transition: all 0.3s ease;
                opacity: 0;
            }

            .destination-item:hover .destination-overlay h5,
            .destination-item:hover .destination-overlay span {
                transform: translateY(0);
                opacity: 1;
            }

            .destination-overlay h5 {
                transition-delay: 0.1s;
            }

            .destination-overlay span {
                transition-delay: 0.2s;
            }
        </style>

        <!-- Background Elements -->
        <div class="bg-pattern"></div>
        <div class="gradient-overlay"></div>
        <div class="desert-wave"></div>
        <div class="arabic-pattern"></div>
        <div class="floating-shape shape1"></div>
        <div class="floating-shape shape2"></div>
        <div class="floating-shape shape3"></div>

        <!-- Content -->
        <div class="container-fluid py-5">
            <div class="container pt-5 pb-3">
                <div class="content-wrapper">
                    <div class="text-center mb-3 pb-3">
                        <h6 class="section-title">Categories</h6>
                        <h1>Explore Our Categories</h1>
                    </div>
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="destination-item position-relative overflow-hidden mb-2">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/img/' . ($category->category_image ?? 'default.jpg')) }}"
                                        alt="{{ $category->category_name }}"
                                        style="width: 400px; height: 200px; object-fit: cover;">
                                    <a class="destination-overlay text-white text-decoration-none"
                                        href="{{ route('public.tours', ['category_id' => $category->category_id]) }}">
                                        <h5 class="text-white">{{ $category->category_name }}</h5>
                                        <span>{{ $category->category_description ?? 'Explore Now' }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category End -->


    <!-- Tours Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tours</h6>
                <h1>Perfect Tour Packages</h1>
            </div>
            <div class="row">
                @foreach ($latestTours as $tour)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2">
                            <img class="img-fluid " src="{{ asset('assets/img/tours/' . $tour->cover_image) }}"
                                alt="Tour Image" style="height: 250px; width: 100%; object-fit: cover;">
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="m-0"><i
                                            class="fa fa-map-marker-alt text-primary mr-2"></i>{{ $tour->category->category_name }}</small>
                                    <small class="m-0"><i
                                            class="fa fa-calendar-alt text-primary mr-2"></i>{{ $tour->duration }}
                                        Days</small>
                                    <small class="m-0">

                                        @if ($tour->available_seats == 0)
                                            <span class="bg-danger text-white font-weight-bold px-2 py-1 rounded">Full
                                                Booking</span>
                                        @else
                                            <i class="fa fa-user text-primary mr-2"></i>
                                            {{ $tour->available_seats }} Person
                                        @endif
                                    </small>
                                </div>


                                <a class="h5 text-decoration-none"
                                    href="{{ route('public.single_tour', ['id' => $tour->tour_id]) }}">{{ $tour->name }}</a>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0"><img
                                                src="{{ asset('assets/img/profile_images/' . $tour->company->user_image) }}"
                                                alt="Profile" class="rounded-circle" width="36" height="36">
                                            {{ $tour->company->name }}</h6>
                                        <h5 class="m-0">{{ $tour->price }} JOD</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!-- Tour End -->


    <!-- Registration Start -->
    {{-- <div class="container-fluid bg-registration py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Mega Offer</h6>
                        <h1 class="text-white"><span class="text-primary">30% OFF</span> For Honeymoon</h1>
                    </div>
                    <p class="text-white">Invidunt lorem justo sanctus clita. Erat lorem labore ea, justo dolor lorem ipsum ut sed eos,
                        ipsum et dolor kasd sit ea justo. Erat justo sed sed diam. Ea et erat ut sed diam sea ipsum est
                        dolor</p>
                    <ul class="list-inline text-white m-0">
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Labore eos amet dolor amet diam</li>
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Etsea et sit dolor amet ipsum</li>
                        <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Diam dolor diam elitripsum vero.</li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <div class="card border-0">
                        <div class="card-header bg-primary text-center p-4">
                            <h1 class="text-white m-0">Sign Up Now</h1>
                        </div>
                        <div class="card-body rounded-bottom bg-white p-5">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control p-4" placeholder="Your name" required="required" />
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control p-4" placeholder="Your email" required="required" />
                                </div>
                                <div class="form-group">
                                    <select class="custom-select px-4" style="height: 47px;">
                                        <option selected>Select a destination</option>
                                        <option value="1">destination 1</option>
                                        <option value="2">destination 1</option>
                                        <option value="3">destination 1</option>
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-primary btn-block py-3" type="submit">Sign Up Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Registration End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimonial</h6>
                <h1>What Say Our Clients</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                @foreach ($testimonials as $testimonial)
                    <div class="text-center pb-4">
                        <!-- Placeholder for client image, if available -->
                        <img class="img-fluid mx-auto rounded"
                            src="{{ asset('assets/img/profile_images/' . $testimonial->user->user_image) }}"
                            style="width: 100px; height: 100px;">

                        <div class="testimonial-text bg-white p-4 mt-n5">
                            <!-- Display the testimonial message -->
                            <p class="mt-5">{{ $testimonial->message }}</p>

                            <!-- Display the client's name (or 'Guest' if not available) -->
                            <h5 class="text-truncate">{{ $testimonial->user->name ?? 'Guest' }}</h5>

                            <!-- Display the profession (if available) -->
                            <span>{{ $testimonial->user->email }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    <style>
        /* General Mobile Responsiveness */
        @media (max-width: 768px) {
            .booking{
                display: none;
            }
        }

        /* Extra Small Devices */
        @media (max-width: 576px) {
            .booking{
                display: none;
            }
        }
    </style>
@endsection
