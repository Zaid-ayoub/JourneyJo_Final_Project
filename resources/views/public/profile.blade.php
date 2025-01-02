@extends('public.public_source.public_template')

@section('content')
<style>
    .profile-container {
        padding: 4rem 1rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: minmax(250px, 1fr) 3fr;
        gap: 1rem;
    }

    .profile-card {
        background: #fff;
        border-radius: 8px;
        padding: 1.25rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        height: fit-content;
    }

    .profile-image-container {
        margin-bottom: 1.25rem;
        text-align: center;
    }

    .profile-image {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
    }

    .profile-info {
        text-align: center;
        margin-bottom: 1.25rem;
    }

    .profile-info h4 {
        margin: 0 0 0.625rem 0;
    }

    .profile-info span {
        color: #666;
    }

    .profile-nav {
        border-top: 1px solid #eee;
        padding-top: 1.25rem;
    }

    .tab-button {
        width: 100%;
        padding: 0.75rem;
        margin: 0.3rem 0;
        border: none;
        background: #f8f9fa;
        cursor: pointer;
        text-align: left;
        border-radius: 4px;
        transition: background 0.3s;
    }

    .tab-button:hover {
        background: #e2e6ea;
    }

    .tab-button.active {
        background: #e9ecef;
    }

    .content-card {
        background: #fff;
        border-radius: 8px;
        padding: 1.875rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .profile-table {
        width: 100%;
        border-collapse: collapse;
    }

    .profile-table th {
        background: #f8f9fa;
        padding: 0.75rem;
        text-align: left;
        border-bottom: 2px solid #dee2e6;
    }

    .profile-table td {
        padding: 0.75rem;
        border-bottom: 1px solid #dee2e6;
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.3125rem;
    }

    .form-control {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn {
        padding: 0.625rem 1.25rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: opacity 0.3s;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .error-alert {
        padding: 1rem;
        margin-top: 1.25rem;
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
        color: #721c24;
    }

    .error-text {
        color: #dc3545;
        font-size: 0.875rem;
    }

    .pagination {
        margin-top: 1.25rem;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }

        .profile-card {
            margin-bottom: 1rem;
        }

        .content-card {
            padding: 1rem;
        }

        .profile-table {
            min-width: unset;
        }

        .profile-table thead {
            display: none;
        }

        .profile-table, 
        .profile-table tbody, 
        .profile-table tr, 
        .profile-table td {
            display: block;
            width: 100%;
        }

        .profile-table tr {
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 0.5rem;
            background: #fff;
        }

        .profile-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
            padding: 0.5rem;
        }

        .profile-table td::before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 1rem;
        }

        .table-responsive {
            margin: 0;
            padding: 0;
        }
    }
</style>

<section class="profile-container">
    <div class="profile-grid">
        <div class="profile-card">
            <div class="profile-image-container">
                <img class="profile-image" src="{{ asset('assets/img/profile_images/' . $user->user_image) }}" alt="Profile Image">
            </div>
            <div class="profile-info">
                <h4>{{ $user->name }}</h4>
                <span>{{ $user->email }}</span>
            </div>
            <div class="profile-nav">
                <button onclick="showTab('bookings')" class="tab-button" id="bookings-btn">
                    📚 Bookings
                </button>
                <button onclick="showTab('custom-bookings')" class="tab-button" id="custom-bookings-btn">
                    🛠️ Custom Bookings
                </button>
                <button onclick="showTab('edit-profile')" class="tab-button" id="edit-profile-btn">
                    ✏️ Edit Profile
                </button>
                <button onclick="showTab('change-password')" class="tab-button" id="change-password-btn">
                    🔒 Change Password
                </button>
            </div>
        </div>

        <div class="content-card">
            <div id="bookings" class="tab-content">
                <h3>Bookings</h3>
                @if ($bookings->isEmpty())
                    <p>You have no past bookings.</p>
                @else
                    <div class="table-responsive">
                        <table class="profile-table">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Tour Name</th>
                                    <th>Booking Date</th>
                                    <th>Number of People</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td data-label="Booking ID">#{{ $booking->booking_id }}</td>
                                        <td data-label="Tour Name">{{ $booking->tour->name }}</td>
                                        <td data-label="Booking Date">{{ $booking->created_at->format('M d, Y') }}</td>
                                        <td data-label="Number of People">{{ $booking->number_of_people }}</td>
                                        <td data-label="Status">{{ ucfirst($booking->status) }}</td>
                                        <td data-label="Total Price">${{ number_format($booking->total_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        {{ $bookings->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>

            <div id="custom-bookings" class="tab-content" style="display: none;">
                <h3>Custom Bookings</h3>
                @if ($customTours->isEmpty())
                    <p>You have no custom bookings.</p>
                @else
                    <div class="table-responsive">
                        <table class="profile-table">
                            <thead>
                                <tr>
                                    <th>Tour ID</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Number of People</th>
                                    <th>Budget</th>
                                    <th>Status</th>
                                    <th>Company</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customTours as $customTour)
                                    <tr>
                                        <td data-label="Tour ID">#{{ $customTour->id }}</td>
                                        <td data-label="Start Date">{{ \Carbon\Carbon::parse($customTour->start_date)->format('M d, Y') }}</td>
                                        <td data-label="End Date">{{ \Carbon\Carbon::parse($customTour->end_date)->format('M d, Y') }}</td>
                                        <td data-label="Number of People">{{ $customTour->number_of_people }}</td>
                                        <td data-label="Budget">{{ number_format($customTour->budget, 2) }}JOD</td>
                                        <td data-label="Status">{{ ucfirst($customTour->status) }}</td>
                                        <td data-label="Company Name">
                                            {{ $customTour->company->name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        {{ $customTours->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
            

            <div id="edit-profile" class="tab-content" style="display: none;">
                <h3>Edit Profile</h3>
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">City</label>
                        <input type="text" name="city" value="{{ old('city', $user->city) }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Profile Image</label>
                        <input type="file" name="user_image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>

            <div id="change-password" class="tab-content" style="display: none;">
                <h3>Change Password</h3>
                <form method="POST" action="{{ route('user.password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                        @error('current_password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                        @error('new_password')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" class="form-control" required>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>

                @if ($errors->any())
                    <div class="error-alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const currentTab = window.location.hash.substring(1) || 'bookings';
        showTab(currentTab);
    });

    function showTab(tabId) {
        const tabContents = document.getElementsByClassName('tab-content');
        for (let content of tabContents) {
            content.style.display = 'none';
        }

        const tabButtons = document.getElementsByClassName('tab-button');
        for (let button of tabButtons) {
            button.classList.remove('active');
        }

        document.getElementById(tabId).style.display = 'block';
        document.getElementById(tabId + '-btn').classList.add('active');
        window.location.hash = tabId;
    }

    const buttons = document.getElementsByClassName('tab-button');
    for (let button of buttons) {
        button.addEventListener('mouseover', function() {
            if (!this.classList.contains('active')) {
                this.style.background = '#e2e6ea';
            }
        });
        button.addEventListener('mouseout', function() {
            if (!this.classList.contains('active')) {
                this.style.background = '#f8f9fa';
            }
        });
    }
</script>
@endsection