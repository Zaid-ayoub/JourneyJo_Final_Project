@extends('source.template')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Bookings for Tour: {{ $tour->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tour') }}">Tours</a></li>
                <li class="breadcrumb-item active">Bookings for Tour</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bookings for "{{ $tour->name }}"</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Number of People</th>
                                    <th>Booking Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking->booking_id }}</td>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->user->email }}</td>
                                        <td>{{ $booking->number_of_people }}</td>
                                        <td>{{ $booking->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
