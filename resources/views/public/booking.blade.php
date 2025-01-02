@extends('public.public_source.public_template')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Progress bar -->
                <div class="progress mb-4">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" id="bookingProgress">Step 1 of 2
                    </div>
                </div>

                <!-- Step 1: Tour Details -->
                <div id="step1" class="booking-step active">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Tour Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('assets/img/tours/' . $tour->cover_image) }}"
                                        class="img-fluid rounded" alt="{{ $tour->name }}">
                                </div>
                                <div class="col-md-8">
                                    <h5>{{ $tour->name }}</h5>
                                    <p class="text-muted">{{ $tour->category->category_name }}</p>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span><i class="fa fa-calendar"></i> Duration: {{ $tour->duration }} Days</span>
                                        <span><i class="fa fa-users"></i> Available Seats:
                                            {{ $tour->available_seats }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span><i class="fa fa-calendar-alt"></i> Start:
                                            {{ \Carbon\Carbon::parse($tour->start_date)->format('d M, Y') }}</span>
                                        <span><i class="fa fa-calendar-alt"></i> End:
                                            {{ \Carbon\Carbon::parse($tour->end_date)->format('d M, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Number of People -->
                            <div class="mt-4">
                                <label class="form-label">Number of People</label>
                                <input type="number" class="form-control" name="number_of_people" id="number_of_people"
                                    min="1" max="{{ $tour->available_seats }}" value="1" required>
                            </div>

                            <!-- Total Price -->
                            <div class="alert alert-info mt-3">
                                <strong>Price per Person:</strong> ${{ $tour->price }}<br>
                                <strong>Total Price:</strong> <span id="totalPrice">${{ $tour->price }}</span>
                            </div>

                            <div class="text-end mt-4">
                                <button class="btn btn-success" onclick="nextStep()">Next <i
                                        class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Personal Details and Bill -->
                <div id="step2" class="booking-step d-none">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Booking Information</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('public.booking.store') }}" method="POST" id="bookingForm">
                                @csrf
                                <input type="hidden" name="tour_id" value="{{ $tour->tour_id }}">
                                <input type="hidden" name="user_id" value="{{ Auth::guard('public_user')->id() }}">
                                <input type="hidden" name="status" value="pending">
                                <input type="hidden" name="payment_status" value="unpaid">
                                <input type="hidden" name="total_price" id="total_price_input">
                                <input type="hidden" name="number_of_people" id="hiddenNumberOfPeople">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="full_name"
                                        value="{{ Auth::guard('public_user')->user()->name }}" required disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ Auth::guard('public_user')->user()->email }}" required disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ Auth::guard('public_user')->user()->phone }}" required disabled>
                                </div>

                                <!-- Styled Bill Details -->
                                <div class="card mt-4">
                                    <div class="card-header bg-white">
                                        <h5>Bill Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Tour Name</span>
                                            <span>{{ $tour->name }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Number of People</span>
                                            <span id="summaryNumPeople">1</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <strong>Total Price</strong>
                                            <strong id="summaryTotalPrice">${{ $tour->price }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" onclick="previousStep()">
                                        <i class="fas fa-arrow-left"></i> Previous
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        Confirm Booking <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function nextStep() {
            document.getElementById('step1').classList.add('d-none');
            document.getElementById('step2').classList.remove('d-none');
            document.getElementById('bookingProgress').style.width = '100%';
            document.getElementById('bookingProgress').textContent = 'Step 2 of 2';

            // Update Bill Summary
            const numPeople = document.getElementById('number_of_people').value;
            const pricePerPerson = {{ $tour->price }};
            const totalPrice = numPeople * pricePerPerson;

            document.getElementById('summaryNumPeople').textContent = numPeople;
            document.getElementById('summaryTotalPrice').textContent = '$' + totalPrice;

            // Set hidden input value
            document.getElementById('hiddenNumberOfPeople').value = numPeople;
            document.getElementById('total_price_input').value = totalPrice;
        }


        function previousStep() {
            document.getElementById('step2').classList.add('d-none');
            document.getElementById('step1').classList.remove('d-none');
            document.getElementById('bookingProgress').style.width = '50%';
            document.getElementById('bookingProgress').textContent = 'Step 1 of 2';
        }

        // Update total price in Step 1
        document.getElementById('number_of_people').addEventListener('change', function(e) {
            const numPeople = parseInt(e.target.value);
            const pricePerPerson = {{ $tour->price }};
            const totalPrice = numPeople * pricePerPerson;

            document.getElementById('totalPrice').textContent = '$' + totalPrice;
            document.getElementById('total_price_input').value = totalPrice;
        });
        // Set initial total price
        document.getElementById('total_price_input').value = {{ $tour->price }};
    </script>
@endsection
