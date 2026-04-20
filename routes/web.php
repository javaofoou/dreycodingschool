<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Volt::route('/receipt/{reference}', 'pages.receipts.show')->name('receipts.show');
Volt::route('/courses', 'pages.courses.index')->name('courses.index');
Volt::route('/courses/{slug}', 'pages.courses.show')->name('courses.show');
Volt::route('/hire-us', 'pages.project-requests.create')->name('project-requests.create');
Volt::route('/faq', 'pages.faq.index')->name('faq.index');
Volt::route('/testimonials', 'pages.testimonials.index')->name('testimonials.index');

Route::middleware('auth')->group(function () {
    Volt::route('/checkout/{slug}', 'pages.checkout.show')->name('checkout.show');
    Volt::route('/receipt/{reference}', 'pages.receipts.show')->name('receipts.show');

    Route::post('/checkout/{slug}/pay', [PaymentController::class, 'initialize'])
        ->name('payment.initialize');

    Route::get('/payment/callback', [PaymentController::class, 'callback'])
        ->name('payment.callback');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});


Volt::route('/donate', 'pages.donations.create')->name('donations.create');

Route::post('/donate/pay', [\App\Http\Controllers\DonationController::class, 'initialize'])
    ->name('donations.initialize');

Route::get('/donation/callback', [\App\Http\Controllers\DonationController::class, 'callback'])
    ->name('donations.callback');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Volt::route('/', 'admin.dashboard')->name('dashboard');

    Volt::route('/courses', 'admin.courses.index')->name('courses.index');
    Volt::route('/courses/create', 'admin.courses.create')->name('courses.create');
    Volt::route('/courses/{course}/edit', 'admin.courses.edit')->name('courses.edit');

    Volt::route('/project-requests', 'admin.project-requests.index')->name('project-requests.index');

    Volt::route('/payments', 'admin.payments.index')->name('payments.index');
    Volt::route('/enrollments', 'admin.enrollments.index')->name('enrollments.index');

    Volt::route('/faqs', 'admin.faqs.index')->name('faqs.index');
    Volt::route('/faqs/create', 'admin.faqs.create')->name('faqs.create');

    Volt::route('/testimonials', 'admin.testimonials.index')->name('testimonials.index');
    Volt::route('/testimonials/create', 'admin.testimonials.create')->name('testimonials.create');

    Volt::route('/faqs/{faq}/edit', 'admin.faqs.edit')->name('faqs.edit');
Volt::route('/testimonials/{testimonial}/edit', 'admin.testimonials.edit')->name('testimonials.edit');

Volt::route('/students', 'admin.students.index')->name('students.index');
Volt::route('/donations', 'admin.donations.index')->name('donations.index');
});

require __DIR__.'/auth.php';
