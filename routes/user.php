<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserTourController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PublicBookingController;
use App\Http\Controllers\CustomTourController;



/*
|--------------------------------------------------------------------------
| user Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Home Page Route
Route::get('/index', [IndexController::class, 'index'])->name('public.index');

Route::get('/tours', [UserTourController::class, 'index'])->name('public.tours');

Route::post('/tours/filter', [UserTourController::class, 'filter'])->name('tours.filter');

Route::get('/single_tour/{id}', [IndexController::class, 'showTourDetails'])->name('public.single_tour');

Route::get('/about', function () { return view('public.about'); })->name('public.about');

Route::get('/single_tour/{tour_id}/book', [PublicBookingController::class, 'showBookingForm'])->name('public.booking.form');

Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');

Route::get('/contact', function(){ return view('public.contact');})->name('contact.index');

Route::get('/custom-tour/create', [CustomTourController::class, 'create'])->name('public.custom_tour');


Route::middleware('isUser')->group(function () {
    Route::post('/custom-tour/store', [CustomTourController::class, 'store'])->name('custom-tour.store');
    
    Route::post('/booking/store', [PublicBookingController::class, 'store'])->name('public.booking.store');

    Route::get('/booking/success/{booking}', [PublicBookingController::class, 'success'])->name('public.booking.success');

    Route::get('/my-bookings', [PublicBookingController::class, 'myBookings'])->name('public.my.bookings');
    
    Route::post('/booking/{booking}/cancel', [PublicBookingController::class, 'cancel'])->name('public.booking.cancel');

    Route::get('/user/profile', [UserProfileController::class, 'showBookingHistory'])->name('user.profile');

    Route::post('/user/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
    
    Route::put('/user/password', [UserProfileController::class, 'updatePassword'])->name('user.password.update');

});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

require __DIR__ . '/user_auth.php';