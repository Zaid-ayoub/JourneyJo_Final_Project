@extends('source.template')

@section('booking_active', 'active') <!-- Set the active class for bookings -->

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add New User</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users') }}">Users</a></li>
                    <li class="breadcrumb-item active">Add User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add User Form</h5>

                        <!-- User Form -->
                        <form action="{{ route('users.store') }}" enctype="multipart/form-data" method="POST" class="row g-3" id="userForm">
                            @csrf
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone">
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" class="form-control" id="city">
                            </div>
                            <div class="col-md-6">
                                <label for="role_id" class="form-label">Role</label>
                                <select name="role_id" id="role_id" class="form-select" required>
                                    <option value="" selected disabled>Choose a role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ ucfirst($role->role_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="user_image" class="form-label">Profile Image</label>
                                <input type="file" name="user_image" class="form-control" id="user_image"
                                    accept="image/*">
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <a href="{{ route('users') }}" class="btn btn-danger">Cancel</a>
                            </div>

                    </div>
                    </form><!-- End User Form -->

                </div>
            </div>
            </div>
        </section>

    </main><!-- End #main -->

@endsection
