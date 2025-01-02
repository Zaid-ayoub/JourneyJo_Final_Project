@extends('public.public_source.public_template')

@section('about_active', 'active')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative bg-gradient py-5" 
    style="background: url('{{ asset('assets/img/about-us.jpg') }}') no-repeat center center / cover; margin-top: -85px; height: 100vh">
    <div class="container d-flex align-items-center justify-content-center text-center" style="height: 100vh; margin-top: 50px;">
        <div class="col-lg-8 bg-white bg-opacity-50 rounded-3 p-5 shadow-lg" style="backdrop-filter: blur(10px); margin-bottom: 40px">
            <h1 class="display-4 fw-bold text-dark mb-4">Discover. Explore. Experience.</h1>
            <p class="lead text-dark mb-4">
                At JourneyJo, we turn your travel dreams into unforgettable adventures. From breathtaking destinations to curated journeys, we ensure every step of your trip is extraordinary.
            </p>
            <a href="{{ route('public.tours') }}" class="btn btn-primary btn-lg rounded-pill">Plan Your Trip</a>
        </div>
    </div>
    <!-- Decorative shapes -->
    <div class="position-absolute bottom-0 start-0 w-100 overflow-hidden">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="min-width: 1440px;">
            <path fill="#ffffff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,224C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>



    <!-- Core Values Section -->
    <section class="py-5" id="values">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 text-center">
                    <h2 class="display-5 fw-bold mb-3">About Zaid Ayoub</h2>
                    <p class="lead text-muted">Owner and Creator of JourneyJo</p>
                    <p class="text-muted">Connecting people to extraordinary travel experiences with a passion for exploration and discovery.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-phone-alt fa-3x text-success"></i>
                            </div>
                            <h4 class="mb-3">Contact Info</h4>
                            <p class="text-muted">You can reach me via email at <a href="mailto:zaidayoub@example.com">zaidayoub@example.com</a> or call me at +123 456 7890.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-map-marker-alt fa-3x text-success"></i>
                            </div>
                            <h4 class="mb-3">Location</h4>
                            <p class="text-muted">Based in Amman, Jordan. Serving clients worldwide with personalized travel solutions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-globe fa-3x text-success"></i>
                            </div>
                            <h4 class="mb-3">Website</h4>
                            <p class="text-muted">Visit our main website at <a href="https://www.journeyjo.com" target="_blank">www.journeyjo.com</a> for more details and bookings.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-4">
                                <i class="fas fa-envelope fa-3x text-success"></i>
                            </div>
                            <h4 class="mb-3">Email</h4>
                            <p class="text-muted">Send us your inquiries or requests at <a href="mailto:support@journeyjo.com">support@journeyjo.com</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <!-- Additional sections -->
    <!-- You can continue personalizing sections like Testimonials, Team, Contact, etc., similarly to reflect JourneyJo's unique identity -->
@endsection
