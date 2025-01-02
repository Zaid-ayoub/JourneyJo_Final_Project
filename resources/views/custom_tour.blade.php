@extends('source.template')

@section('custom_tours_active', 'active')
<!-- Set the active class for Custom Tours -->

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Custom Tours</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Custom Tours</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <!-- Pending Custom Tours -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Pending Custom Tour Requests</h5>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Number of People</th>
                                    <th>Budget</th>
                                    <th>Transportation</th>
                                    @if(auth()->user()->role_id == 3)
                                        <th>Company Name</th>
                                    @else
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingCustomTours as $tour)
                                <tr>
                                    <td>{{ $tour->user->name ?? 'Guest' }}</td>
                                    <td>{{ $tour->start_date }}</td>
                                    <td>{{ $tour->end_date }}</td>
                                    <td>{{ $tour->number_of_people }}</td>
                                    <td>{{ number_format($tour->budget, 2) }} JOD</td>
                                    <td>{{ ucfirst($tour->transportation_preference) }}</td>
                                    @if(auth()->user()->role_id == 3)
                                        <td>{{ $tour->company->name ?? 'N/A' }}</td>
                                    @else
                                        <td>
                                            <form action="{{ route('custom-tours.approve', $tour->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- End Pending Custom Tours -->

                <!-- Approved Custom Tours -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Approved Custom Tour Requests</h5>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Number of People</th>
                                    <th>Budget</th>
                                    <th>Transportation</th>
                                    @if(auth()->user()->role_id == 3)
                                        <th>Company Name</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($approvedCustomTours as $tour)
                                <tr>
                                    <td>{{ $tour->user->name ?? 'Guest' }}</td>
                                    <td>{{ $tour->start_date }}</td>
                                    <td>{{ $tour->end_date }}</td>
                                    <td>{{ $tour->number_of_people }}</td>
                                    <td>{{ number_format($tour->budget, 2) }}JOD</td>
                                    <td>{{ ucfirst($tour->transportation_preference) }}</td>
                                    @if(auth()->user()->role_id == 3)
                                        <td>{{ $tour->company->name ?? 'N/A' }}</td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- End Approved Custom Tours -->

            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection
