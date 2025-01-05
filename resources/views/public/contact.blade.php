@extends('public.public_source.public_template')

@section('contact_active', 'active')

@section('content')

<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Contact</h6>
            <h1>Contact For Any Query</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form bg-white" style="padding: 30px;">
                    <div id="success"></div>
                    <form 
                        action="{{ route('contact.store') }}" 
                        method="POST" 
                        name="sentMessage" 
                        id="contactForm" 
                        novalidate="novalidate" 
                        onsubmit="return checkAuth(event)"
                    >
                        @csrf

                        @if(auth('public_user')->check())
                        <!-- User is authenticated -->
                        <input type="hidden" name="user_id" value="{{ auth('public_user')->id() }}">
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <input type="text" class="form-control p-4" name="user_name" required="required" value="{{ auth('public_user')->user()->name }}" disabled/>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-sm-6">
                                <input type="text" class="form-control p-4" name="user_email" required="required" value="{{ auth('public_user')->user()->email }}" disabled/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        @else
                        <!-- User is not authenticated -->
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <input type="text" class="form-control p-4" name="user_name" placeholder="Your Name" required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="control-group col-sm-6">
                                <input type="email" class="form-control p-4" name="user_email" placeholder="Your Email" required="required"/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="control-group">
                            <textarea class="form-control py-3 px-4" rows="5" id="message" name="message" placeholder="Message" required="required" data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary py-3 px-4 rounded-pill" type="submit" id="sendMessageButton">Send Message</button>
                        </div>
                    </form>
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
                text: 'Please log in to send a message.',
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif
    });
</script>

@endsection
