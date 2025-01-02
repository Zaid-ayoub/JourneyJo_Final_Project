<!doctype html>
<html lang="en">
	

        <!-- Start Header -->
        @include('public.public_source.public_partials.header')
    	<!-- End Header -->

	<body>

		<!-- Start Header/Navigation -->
		@include('public.public_source.public_partials.nav')
		<!-- End Header/Navigation -->

        {{-- Start Content Section --}}
		@yield('content')
        {{-- End Content Section --}}

		<!-- Start Footer Section -->
		@include('public.public_source.public_partials.footer')
		<!-- End Footer Section -->	


		
	</body>

</html>
