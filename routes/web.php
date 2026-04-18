<?php

use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanyClaimController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\CompanyClaimRequestController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InsightsController;
use App\Http\Controllers\Dashboard\PackageController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use App\Http\Middleware\CompanyOwner;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Show verification notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::view('/privacy-policy', 'legal.privacy')->name('privacy');
Route::view('/terms-conditions', 'legal.terms')->name('terms');
Route::view('/cookie-policy', 'legal.cookies')->name('cookies');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/companies/{serviceSlug}', [ServiceController::class, 'index'])->name('services.companies');
Route::get('/companies', [ServiceController::class, 'search']);
Route::get('/profile/{companySlug}', [ProfileController::class, 'index'])->name('profile.index')->middleware('TrackVisit');
Route::get('/profile/{companySlug}/packages', [ProfileController::class, 'packages'])->name('profile.packages');
Route::get('/review/{companySlug}', [ReviewController::class, 'showForm'])->name('review.form');
Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.showForm');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::get('blogs', [InsightsController::class, 'showInsights'])->name('insights.list');
Route::get('blogs/{insightSlug}', [InsightsController::class, 'showInsight'])->name('insights.showInsight');
Route::get('/services/{slug}/packages', [PackageController::class, 'packagePage']);

Route::get('/company/{company}/service/{service}/packages', [ProfileController::class, 'getServicePackages']);
Route::get('/claim-profile/{company}', [CompanyClaimController::class, 'create'])->middleware('auth')
    ->name('companies.claim.form');
// Claim
Route::get('/claim-profile/{company}', [CompanyClaimController::class, 'create'])->middleware('auth')
    ->name('companies.claim.form');
Route::post('/claim-profile/{company}', [CompanyClaimController::class, 'store'])->middleware('auth')
    ->name('companies.claim.store');


//? Ajax Route
Route::get('/profile/{company}/project-sizes', [ProfileController::class, 'projectSizes']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register.show');

//! Admin Authentication
Route::get('/admin-login', [AdminAuthController::class, 'index'])->name('admin.login.index');
Route::post('/admin-login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin-logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// !Others Authentication
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->middleware("throttle:5,1");
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
    ->middleware('throttle:1,2')
    ->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');


// Info: Dashboard Routes
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get("/", [DashboardController::class, 'index'])->name('dashboard.index');

    // ? Contact Routes
    Route::get('/messages', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/message/{contact}', [ContactController::class, 'show'])->name('contact.show');
    Route::delete('/message/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::patch('contact/{contact}/mark-read', [ContactController::class, 'markRead'])->name('contact.markRead');
    Route::patch('/contact/{contact}/resolve', [ContactController::class, 'resolve'])->name('contact.resolve');

    Route::middleware(['can:admin'])->group(function () {
        Route::get('/claims', [CompanyClaimRequestController::class, 'index'])
            ->name('admin.claims.index');

        Route::post('/claims/{id}/approve', [CompanyClaimRequestController::class, 'approve'])
            ->name('admin.claims.approve');

        Route::post('/claims/{id}/reject', [CompanyClaimRequestController::class, 'reject'])
            ->name('admin.claims.reject');
    });

    // ?Inquiries
    Route::get('/company/inquiries', [InquiryController::class, 'index'])->name('company.inquiries.index')->can('company');
    Route::get('/company/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('company.inquiries.show')->can('company');
    Route::patch('/company/inquiries/{inquiry}/read', [InquiryController::class, 'markRead'])->name('company.inquiries.markRead')->can('company');
    Route::delete('/company/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('company.inquiries.destroy')->can('company');
    Route::patch('/company/inquiries/{inquiry}/resolve', [InquiryController::class, 'markResolved'])
        ->name('company.inquiries.update');

    // ? Companies Crud Routes
    Route::get("/companies", [CompanyController::class, 'index'])->name('companies.index');
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::post('/companies/logo/{company}', [CompanyController::class, 'uploadLogo'])->name('companies.updateLogo');
    Route::get('/companies/edit/{company}', [CompanyController::class, 'edit'])->name('companies.edit')->middleware(CompanyOwner::class);
    Route::put('/companies/update/{id?}', [CompanyController::class, 'updateOrCreate'])->name('companies.update');
    Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])
        ->name('companies.destroy')->middleware('can:admin');

    // ? Insight Routes
    Route::resource('/insights', InsightsController::class);

    // ? Packages Routes
    Route::resource('/packages', PackageController::class);

    // ? Review Routes
    Route::resource('/reviews', ReviewController::class);


    // ? Profile Routes
    Route::get("/user-profile", [UserController::class, 'index'])->name('user.index');
    Route::put("/change-password", [UserController::class, 'changePassword'])->name('user.change.password');
    Route::post('/user-profile/image', [UserController::class, 'uploadProfile'])->name('user.profile.image.update');
    Route::put('/user-profile/update', [UserController::class, 'update'])->name('user.profile.update');
});



// Hack: Generate Slug
Route::get('/getSlug', function (Request $request) {
    $slug = '';
    if (!empty($request->name)) {
        $slug = Str::slug($request->name);
        return response()->json([
            'status' => true,
            'slug' => $slug,
        ]);
    }
})->name('getSlug');
