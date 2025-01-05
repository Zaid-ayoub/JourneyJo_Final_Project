@extends('public.public_source.public_template')

@section('content')

    <!-- Open Content -->
    <section>
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card mb-3">
                        <!-- Main Image of the Tour -->
                        <img class="card-img img-fluid" src="{{ asset('assets/img/tours/' . $tour->cover_image) }}"
                            alt="Tour Image" id="product-detail">
                    </div>
                    <div class="row">
                        <!-- Start Controls -->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="prev">
                                <i class="text-dark fas fa-chevron-left"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                        </div>
                        <!-- End Controls -->
                        <!-- Start Carousel Wrapper -->
                        <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item"
                            data-bs-ride="carousel">
                            <!-- Start Slides -->
                            <div class="carousel-inner product-links-wap" role="listbox">
                                @foreach ($tour->images as $image)
                                    <!-- First slide -->
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="#">
                                                    <img class="card-img img-fluid"
                                                        src="{{ asset('assets/img/tour_images/' . $image->image_path) }}"
                                                        alt="Product Image 1"
                                                        style="height: 250px; width: 100%; object-fit: cover;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End First slide -->
                                @endforeach
                            </div>

                            <!-- End Slides -->
                        </div>
                        <!-- End Carousel Wrapper -->
                        <!-- Start Controls -->
                        <div class="col-1 align-self-center">
                            <a href="#multi-item-example" role="button" data-bs-slide="next">
                                <i class="text-dark fas fa-chevron-right"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <!-- End Controls -->
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{ $tour->name }}</h1>
                            <p class="h3 py-2">{{ $tour->price }} JOD</p>

                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Category:</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{ $tour->category->category_name }}</strong></p>
                                </li>
                            </ul>
                            <ul class="list-inline d-flex align-items-center mb-0">
                                <!-- Company Label -->
                                <li class="list-inline-item me-2">
                                    <h6 class="mb-0">Company:</h6>
                                </li>

                                <!-- Profile Image -->
                                <li class="list-inline-item me-2">
                                    <img src="{{ asset('assets/img/profile_images/' . $tour->company->user_image) }}"
                                        alt="Profile" class="rounded-circle" width="36" height="36">
                                </li>

                                <!-- Company Name -->
                                <li class="list-inline-item">
                                    <p class="text-muted mb-0"><strong>{{ $tour->company->name }}</strong></p>
                                </li>
                            </ul>

                            <br>
                            <h6>Description:</h6>
                            <p>{{ $tour->description }}</p>
                            <h6>Locations:</h6>
                            @if ($tour->locations->isNotEmpty())
                                <ul>
                                    @foreach ($tour->locations as $location)
                                        <li>
                                            <strong>{{ $location->location_name }}</strong><br>

                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No locations available for this tour.</p>
                            @endif
                            <h6>Duration:</h6>
                            <p>{{ $tour->duration }} Days</p>

                            <h6>Available Seats:</h6>
                            <p>{{ $tour->available_seats }} Seats</p>

                            <h6>Start Date:</h6>
                            <p>{{ \Carbon\Carbon::parse($tour->start_date)->format('d M, Y') }}</p>

                            <h6>End Date:</h6>
                            <p>{{ \Carbon\Carbon::parse($tour->end_date)->format('d M, Y') }}</p>


                            <form action="" method="GET">
                                <input type="hidden" name="tour-title" value="{{ $tour->name }}">
                                <div class="row">
                                    <div class="col-auto">

                                    </div>

                                </div>
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        @if (auth('public_user')->check())
                                            <a href="{{ route('public.booking.form', $tour->tour_id) }}"
                                                class="btn btn-success btn-lg rounded-pill">Book Now</a>
                                        @else
                                            <button type="button" class="btn btn-success btn-lg rounded-pill"
                                                onclick="promptLogin()">Book Now</button>
                                        @endif
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Start Article -->
    <section class="py-5">
        <div class="container">
            <div class="row text-left p-2 pb-3">
                <h4>Related Tours</h4>
            </div>

            <div class="container-fluid py-5">
                <div class="container pt-5 pb-3">
                    <div class="row">
                        @foreach ($relatedTours as $relatedTour)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="package-item bg-white mb-2">
                                    <!-- Check if the tour has any images -->
                                    @if ($relatedTour->images->isNotEmpty())
                                        <img class="img-fluid" src="{{ $relatedTour->cover_image }}"
                                            alt="{{ $relatedTour->name }}"
                                            style="height: 250px; width: 100%; object-fit: cover;">
                                    @else
                                        <img class="img-fluid" src="{{ asset('assets/img/default_image.jpg') }}"
                                            alt="Default Image">
                                    @endif
                                    <div class="p-4">
                                        <div class="d-flex justify-content-between mb-3">
                                            <small class="m-0"><i
                                                    class="fa fa-map-marker-alt text-primary mr-2"></i>{{ $relatedTour->category->category_name }}</small>
                                            <small class="m-0"><i
                                                    class="fa fa-calendar-alt text-primary mr-2"></i>{{ $relatedTour->duration }}
                                                days</small>
                                            <small class="m-0">
                                                @if ($relatedTour->available_seats == 0)
                                                    <span
                                                        class="bg-danger text-white font-weight-bold px-2 py-1 rounded">Full
                                                        Booking</span>
                                                @else
                                                    <i class="fa fa-user text-primary mr-2"></i>
                                                    {{ $relatedTour->available_seats }} Person
                                                @endif
                                            </small>
                                        </div>
                                        <a class="h5 text-decoration-none"
                                            href="{{ route('public.single_tour', $relatedTour->tour_id) }}">
                                            {{ $relatedTour->name }}
                                        </a>
                                        <div class="border-top mt-4 pt-4">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="m-0">
                                                    <img src="{{ asset('assets/img/profile_images/' . $tour->company->user_image) }}"
                                                        alt="Profile" class="rounded-circle" width="36"
                                                        height="36">{{ $relatedTour->company->name }}
                                                </h6>
                                                <h5 class="m-0">{{ $relatedTour->price }} JOD</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function promptLogin() {
            Swal.fire({
                title: 'You need to log in!',
                text: 'Please log in to book a tour.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Log In',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('user.login') }}";
                }
            });
        }
    </script>


    <!-- End Article -->

@endsection
