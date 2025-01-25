<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\EnqueryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeItemController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Front\TermPolicyController;
use App\Http\Controllers\Admin\ContactItemController;
use App\Http\Controllers\Admin\CounterItemController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TourBookingController;
use App\Http\Controllers\Admin\WelcomeItemController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\Package\PackageController;
use App\Http\Controllers\Admin\TermPrivacyItemController;
use App\Http\Controllers\Admin\Package\PackageFaqController;
use App\Http\Controllers\Admin\Package\PackagePhotoController;
use App\Http\Controllers\Admin\Package\PackageVideoController;
use App\Http\Controllers\Admin\Package\PackageAmenityController;
use App\Http\Controllers\Admin\Destination\DestinationController;
use App\Http\Controllers\Admin\Package\PackageItineraryController;
use App\Http\Controllers\Front\FaqController as FrontFaqController;
use App\Http\Controllers\Front\AuthController as FrontAuthController;
use App\Http\Controllers\Admin\Destination\DestinationPhotoController;
use App\Http\Controllers\Admin\Destination\DestinationVideoController;
use App\Http\Controllers\User\ReviewController as UserReviewController;
use App\Http\Controllers\Front\ReviewController as FrontReviewController;
use App\Http\Controllers\Front\PackageController as FrontPackageController;
use App\Http\Controllers\User\WishlistController as UserWishlistController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Front\SubscriberController as FrontSubscriberController;
use App\Http\Controllers\Front\TeamMemberController as FrontTeamMemberController;
use App\Http\Controllers\Front\DestinationController as FrontDestinationController;
use App\Http\Controllers\Front\PaymentController;

//at the end try to make the use statments look clean and short


// Pages
Route::get('/', HomeController::class)->name('home');
Route::get('/about', AboutController::class)->name('about');
Route::resource('/contact', ContactController::class)->only(['index', 'store']);
Route::get('/team-members', [FrontTeamMemberController::class, 'index'])->name('team-members');
Route::get('/team-members/{slug}', [FrontTeamMemberController::class, 'show'])->name('team-member.show');
Route::get('/faq', FrontFaqController::class)->name('faq');
Route::get('/posts', [BlogController::class, 'index'])->name('posts');
Route::get('/post/{slug}', [BlogController::class, 'show'])->name('post.show');
Route::get('/category/{slug}', FrontCategoryController::class)->name('category');
Route::get('/destinations', [FrontDestinationController::class, 'index'])->name('destinations');
Route::get('/destination/{slug}', [FrontDestinationController::class, 'show'])->name('destination.show');
Route::get('/packages', [FrontPackageController::class, 'index'])->name('packages');
Route::get('/package/{slug}', [FrontPackageController::class, 'show'])->name('package.show');
Route::post('/enquery//{package}', EnqueryController::class)->name('enquery.store');
Route::post('/review/{package}', FrontReviewController::class)->name('review.store');
Route::get('/wishlist/{package}', WishlistController::class)->name('wishlist');
Route::post('/subscriber', [FrontSubscriberController::class, 'store'])->name('subscriber.store');
Route::get('/subscriber-verify/{email}/{token}', [FrontSubscriberController::class, 'subscriberVerify'])->name('subscriber.verify');
Route::get('/terms-of-use', [TermPolicyController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [TermPolicyController::class, 'privacy'])->name('privacy');

// Payment
Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');

Route::get('/paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
Route::get('/paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

Route::get('/stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('/stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');




// Registration and Login
Route::get('/registration', [FrontAuthController::class, 'registration'])->name('registration');
Route::post('/registration', [FrontAuthController::class, 'registration_submit'])->name('registration_submit');
Route::get('/registration-verify/{email}/{token}', [FrontAuthController::class, 'registration_verify'])->name('registration_verify');
Route::get('/login', [FrontAuthController::class, 'login'])->name('login');
Route::post('/login', [FrontAuthController::class, 'login_submit'])->name('login_submit');
Route::get('/forget-password', [FrontAuthController::class, 'forget_password'])->name('forget_password');
Route::post('/forget-password', [FrontAuthController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/reset-password/{token}/{email}', [FrontAuthController::class, 'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}', [FrontAuthController::class, 'reset_password_submit'])->name('reset_password_submit');
Route::get('/logout', [FrontAuthController::class, 'logout'])->name('logout');


// User
Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/dashboard', UserDashboardController::class)->name('user.dashboard');
    Route::get('/bookings', BookingController::class)->name('bookings');
    Route::get('/invoices/{invoice}', InvoiceController::class)->name('invoices'); 
    Route::get('/reviews', UserReviewController::class)->name('reviews');

    Route::get('/wishlist', [UserWishlistController::class, 'index'])->name('wishlist');
    Route::get('/wishlist/delete/{id}', [UserWishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('user.profile.update');
});


// Admin
Route::middleware('admin')->prefix('admin')->group(function () {
    // Dashboard Section
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin_dashboard');

    // Profile Section
    Route::get('/profile', [AdminAuthController::class, 'profile'])->name('admin_profile');
    Route::post('/profile', [AdminAuthController::class, 'profile_submit'])->name('admin_profile_submit');

    // Slider Section

    Route::resource('sliders', SliderController::class);

    // Welcome Section
    Route::get('welcome-item/edit', [WelcomeItemController::class, 'edit'])->name('welcome-item.edit');
    Route::put('welcome-item/update', [WelcomeItemController::class, 'update'])->name('welcome-item.update');

    // Features Section
    Route::resource('features', FeatureController::class);

    // Counter Section
    Route::get('/counter-items/edit', [CounterItemController::class, 'edit'])->name('counter-items.edit');
    Route::put('/counter-items/update', [CounterItemController::class, 'update'])->name('counters-item.update');

    // Testimonial Section
    Route::resource('testimonials', TestimonialController::class);

    // Team Member Section
    Route::resource('team-members', TeamMemberController::class);

    // FAQ Section
    Route::resource('faqs', FaqController::class)->except(['show']);

    // Blog Category Section
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Post Section
    Route::resource('posts', PostController::class)->except(['show']);

    // Destination Section
    Route::resource('destinations', DestinationController::class)->except(['show']);

    Route::prefix('destinations/{destination}')->as('destinations.')->group(function () {
        // Photos
        Route::resource('photos', DestinationPhotoController::class)->except(['show']);

        // Videos  
        Route::resource('videos', DestinationVideoController::class)->except(['show']);
    });

    // Package Section
    Route::resource('packages', PackageController::class)->except(['show']);

    // Package Amenity Section
    Route::prefix('packages/{package}')->as('packages.')->group(function () {
        // Amenities
        Route::resource('amenities', PackageAmenityController::class)->except(['show']);

        // Itineraries
        Route::resource('itineraries', PackageItineraryController::class)->except(['show']);

        // Photos
        Route::resource('photos', PackagePhotoController::class)->except(['show']);

        // Videos
        Route::resource('videos', PackageVideoController::class)->except(['show']);

        // FAQs
        Route::resource('faqs', PackageFaqController::class)->except(['show']);
    });

    // Amenity Section
    Route::resource('amenities', AmenityController::class)->except(['show']);

    // Tour Section
    Route::resource('tours', TourController::class)->except(['show']);


    Route::prefix('tours/{tour}')->as('tours.')->group(function () {
        Route::resource('bookings', TourBookingController::class)->only(['index', 'destroy', 'update', 'show']);
    });

    // Review Section
    Route::resource('reviews', ReviewController::class)->only(['index', 'destroy']);

    // Subscriber Section
    Route::get('/subscribers', [SubscriberController::class, 'subscribers'])->name('subscribers.index');
    Route::get('/subscribers-send-email', [SubscriberController::class, 'send_email'])->name('subscribers.send-email');
    Route::post('/subscribers-send-email/store', [SubscriberController::class, 'send_email_submit'])->name('subscribers.send-email.store');
    Route::get('/subscribers/delete/{id}', [SubscriberController::class, 'subscriber_delete'])->name('subscribers.delete');

    // Home Item Section
    Route::resource('home-items', HomeItemController::class)->only(['edit', 'update']);

    // About Item Section
    Route::resource('about-items', ItemController::class)->only(['edit', 'update']);

    // Contact Item Section
    Route::resource('contact-items', ContactItemController::class)->only(['edit', 'update']);

    // Term and Privacy Item Section
    Route::resource('term-privacy-items', TermPrivacyItemController::class)->only(['edit', 'update']);

    // Setting Section
    Route::resource('settings', SettingController::class)->only(['edit', 'update']);
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin_login');
    Route::post('/login', [AdminAuthController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin_logout');
    Route::get('/forget-password', [AdminAuthController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password', [AdminAuthController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminAuthController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}', [AdminAuthController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
});
