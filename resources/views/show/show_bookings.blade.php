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
                        <table class="table" id="bookingsTable">
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

<!-- Add necessary DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

<!-- Add necessary DataTables JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#bookingsTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy',
                {
                    extend: 'excel',
                    title: '{{ $tour->name }} - Bookings Report',
                    filename: '{{ $tour->name }}_bookings'
                },
                {
                    extend: 'pdf',
                    title: '{{ $tour->name }} - Bookings Report',
                    filename: '{{ $tour->name }}_bookings'
                },
                {
                    extend: 'print',
                    title: '{{ $tour->name }} - Bookings Report'
                }
            ],
            pageLength: 10,
            order: [[0, 'desc']]
        });
    });
</script>
@endsection