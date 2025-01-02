@section('tours_active', 'active')

@extends('public.public_source.public_template')

@section('content')

    <section class="py-5">
        <div class="container">
            <!-- Search Bar -->
            <div class="mb-4">
                <br>
                <form id="searchForm" method="GET" action="{{ route('public.tours') }}">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search tours or companies"
                            value="{{ request()->get('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <!-- Categories Filter -->
            <div class="mb-4">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="mb-0">Filter by Category:</h5>

                    <!-- Dropdown for mobile -->
                    <div class="d-block d-sm-none ml-1">
                        <div class="dropdown">
                            @php
                                $selectedCategory = $categories->firstWhere('category_id', request('category_id'));
                            @endphp
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="categoryDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $selectedCategory ? $selectedCategory->category_name : 'Select Category' }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <a class="dropdown-item {{ request('category_id') == '' ? 'active' : '' }}"
                                    href="{{ route('public.tours') }}">All</a>
                                @foreach ($categories as $category)
                                    <a class="dropdown-item {{ request('category_id') == $category->category_id ? 'active' : '' }}"
                                        href="{{ route('public.tours', ['category_id' => $category->category_id, 'search' => request('search')]) }}"
                                        title="{{ $category->category_name }}">
                                        {{ Str::limit($category->category_name, 15, '..') }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Buttons for desktop/tablet -->
                    <ul class="list-inline mb-0 d-none d-sm-flex ml-3">
                        <li class="list-inline-item ">
                            <a href="{{ route('public.tours') }}"
                                class="btn btn-outline-primary {{ request('category_id') == '' ? 'active' : '' }}">
                                All
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li class="list-inline-item">
                                <a href="{{ route('public.tours', ['category_id' => $category->category_id, 'search' => request('search')]) }}"
                                    class="btn btn-outline-primary {{ request('category_id') == $category->category_id ? 'active' : '' }}">
                                    {{ $category->category_name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Tours Grid -->
            <div id="toursContainer" class="row">
                @foreach ($tours as $tour)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2">
                            <!-- Tour Image and Details -->
                            @if ($tour->images->isNotEmpty())
                                <img class="img-fluid" src="{{ asset('assets/img/tours/' . $tour->cover_image) }}"
                                    alt="{{ $tour->name }}" style="height: 250px; width: 100%; object-fit: cover;">
                            @else
                                <img class="img-fluid" src="{{ asset('assets/img/default_image.jpg') }}"
                                    alt="Default Image">
                            @endif
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small><i
                                            class="fa fa-map-marker-alt text-primary mr-2"></i>{{ $tour->category->category_name }}</small>
                                    <small><i class="fa fa-calendar-alt text-primary mr-2"></i>{{ $tour->duration }}
                                        days</small>
                                        <small class="m-0">
                                            @if($tour->available_seats == 0)
                                            <span class="bg-danger text-white font-weight-bold px-2 py-1 rounded">Full Booking</span>
                                            @else
                                            <i class="fa fa-user text-primary mr-2"></i>
                                                {{ $tour->available_seats }} Person
                                            @endif
                                        </small>
                                </div>
                                <a class="h5 text-decoration-none"
                                    href="{{ route('public.single_tour', $tour->tour_id) }}">
                                    {{ $tour->name }}
                                </a>
                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0"><img src="{{ asset('assets/img/profile_images/' . $tour->company->user_image) }}" 
                                            alt="Profile" class="rounded-circle" width="36" height="36">{{ $tour->company->name }}
                                        </h6>
                                        <h5 class="m-0">{{ $tour->price }} JOD</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $tours->appends(['search' => request('search'), 'category_id' => request('category_id')])->links() }}
            </div>

        </div>
    </section>

@endsection
