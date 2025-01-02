@extends('public.public_source.public_template')

@section('custom_tour_active', 'active')

@section('content')
    <!-- Create Custom Tour Start -->
    <div class="container-fluid bg-light py-5">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h6 class="text-primary text-uppercase fw-bold" style="letter-spacing: 5px;">Custom Tour</h6>
                <h1 class="display-4 mb-0" style="font-size: 37.44px">Plan Your Dream Tour</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form 
                                action="{{ route('custom-tour.store') }}" 
                                method="POST" 
                                class="row gy-4"
                                onsubmit="return checkAuth(event)">
                                @csrf

                                <!-- Number of People -->
                                <div class="col-md-6 mb-3">
                                    <label for="number_of_people" class="form-label">Number of People</label>
                                    <input type="number" class="form-control" id="number_of_people" name="number_of_people"
                                        min="1" placeholder="Enter number of people" required>
                                </div>

                                <!-- Location -->
                                <div class="col-md-6 mb-3">
                                    <label for="location_input" class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location_input" name="location_input"
                                        placeholder="Enter location" required>
                                </div>

                                <!-- Start Date -->
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>

                                <!-- End Date -->
                                <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>

                                <!-- Budget -->
                                <div class="col-md-6 mb-3">
                                    <label for="budget" class="form-label">Budget per Person ($)</label>
                                    <input type="number" class="form-control" id="budget" name="budget" min="0"
                                        placeholder="Enter budget" required>
                                </div>

                                <!-- Transportation Preference -->
                                <div class="col-md-6 mb-3">
                                    <label for="transportation_preference" class="form-label">Transportation Preference</label>
                                    <select class="form-select" id="transportation_preference"
                                        name="transportation_preference" required>
                                        <option value="" selected>Select transportation</option>
                                        <option value="public">Public Transportation</option>
                                        <option value="private">Private Transportation</option>
                                    </select>
                                </div>

                                <!-- Special Requirements -->
                                <div class="col-12 mb-3">
                                    <label for="special_requirements" class="form-label">Special Requirements</label>
                                    <textarea class="form-control" id="special_requirements" name="special_requirements" rows="4"
                                        placeholder="Enter any special requirements or preferences..."></textarea>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="col-12 text-center mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                        <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill">
                                            <i class="fas fa-paper-plane me-2 "></i>Submit Request
                                        </button>
                                        <button type="reset" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                            <i class="fas fa-redo me-2 " ></i>Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function checkAuth(event) {
            // Check if the user is logged in
            const isAuthenticated = {{ auth('public_user')->check() ? 'true' : 'false' }};

            if (!isAuthenticated) {
                event.preventDefault(); // Prevent form submission
                Swal.fire({
                    title: 'You need to log in!',
                    text: 'Please log in to plan your dream tour.',
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
                        window.location.href = "{{ route('user.login') }}"; // Redirect to login page
                    }
                });
                return false;
            }

            return true; // Allow form submission if authenticated
        }
    </script>
    <style>
        .form-label {
            color: #666;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control,
        .form-select {
            height: 48px;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(199, 121, 67, 0.25);
        }

        textarea.form-control {
            height: auto;
            min-height: 120px;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .form-select {
            background-position: right 0.75rem center;
            cursor: pointer;
        }

        .form-check-label {
            color: #666;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #C77943;
            border-color: #C77943;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }

        .card {
            background-color: #ffffff;
            border-radius: 8px;
        }

        .alert {
            border-radius: 4px;
        }

        /* Updated button styles */
        .btn-outline-secondary {
            color: #6c757d;
            border: 2px solid #6c757d;
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
            transform: translateY(-1px);
        }

        /* Custom shadows and hover effects */
        .form-control:hover,
        .form-select:hover {
            border-color: #86b7fe;
        }

        .btn-primary {
            background-color: #C77943;
            border-color: #C77943;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #9A572E;
            border-color: #9A572E;
            transform: translateY(-1px);
        }

        .shadow-lg {
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }
    </style>
@endsection
