@extends('public.public_source.public_template')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 48px;"></i>
                    </div>
                    <h2 class="card-title">Booking Confirmed!</h2>
                    <p class="card-text">Thank you for booking with us. Your booking details are below:</p>
                    
                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-6 text-md-end">
                                <p><strong>Booking Reference:</strong></p>
                                <p><strong>Tour:</strong></p>
                                <p><strong>Number of People:</strong></p>
                                <p><strong>Total Amount:</strong></p>
                                <p><strong>Status:</strong></p>
                            </div>
                            <div class="col-md-6 text-md-start">
                                <p>#{{ $booking->booking_id }}</p>
                                <p>{{ $booking->tour->name }}</p>
                                <p>{{ $booking->number_of_people }}</p>
                                <p>{{ number_format($booking->total_price, 2) }} JOD</p>
                                <p><span class="badge bg-warning">{{ ucfirst($booking->status) }}</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5>What's Next?</h5>
                        <p>Please complete your payment to secure your booking.</p>
                        <!-- Add payment button/link here -->
                        
                        <div class="mt-4">
                            <a href="{{ route('user.profile') }}" class="btn btn-primary">View My Bookings</a>
                            <a href="{{ route('public.index') }}" class="btn btn-secondary">Return Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
