<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\InsightsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use App\Http\Middleware\CompanyOwner;

Route::get('/',[HomeController::class, 'index'])->name('home.index');
Route::get('/companies/{serviceSlug}', [ServiceController::class, 'index'])->name('services.companies');
Route::get('/profile/{companySlug}', [ProfileController::class, 'index'])->name('profile.index')->middleware('TrackVisit');
Route::get('/packages-plan', [ProfileController::class, 'packages'])->name('profile.plan');
Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.showForm');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');


//? Ajax Route
Route::get('/profile/{company}/project-sizes', [ProfileController::class, 'projectSizes']);

Route::get('/login',[AuthController::class, 'index'])->name('login');
Route::get('/register',[AuthController::class, 'registerPage'])->name('register.show');

//! Admin Authentication
Route::get('/admin-login', [AdminAuthController::class, 'index'])->name('admin.login.index');
Route::post('/admin-login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::get('/admin-logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// !Others Authentication
Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
Route::post('/login',[AuthController::class, 'login'])->name('auth.login');
Route::post('/register',[AuthController::class, 'register'])->name('auth.register');

// Info: Dashboard Routes
Route::prefix('dashboard')->middleware(['auth'])->group(function(){
    Route::get("/", [DashboardController::class, 'index'])->name('dashboard.index');

    // ? Contact Routes
    Route::get('/contact', [ContactController::class, 'showContactForm'])->name('contact.showForm');
    Route::get('/messages', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/message/{contact}', [ContactController::class, 'show'])->name('contact.show');
    Route::delete('/message/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::patch('contact/{contact}/mark-read', [ContactController::class, 'markRead'])->name('contact.markRead');
    Route::patch('/contact/{contact}/resolve', [ContactController::class, 'resolve'])->name('contact.resolve');

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

    // ? Profile Routes
    Route::get("/user-profile", [UserController::class, 'index'])->name('user.index');
    Route::put("/change-password",[UserController::class, 'changePassword'])->name('user.change.password');
    Route::post('/user-profile/image', [UserController::class, 'uploadProfile'])->name('user.profile.image.update');
    Route::put('/user-profile/update', [UserController::class, 'update'])->name('user.profile.update');
});



// Hack: Generate Slug
Route::get('/getSlug', function(Request $request){
    $slug = '';
    if (!empty($request->name)) {
        $slug = Str::slug($request->name);
        return response()->json([
            'status' => true,
            'slug' => $slug,
        ]);
    }
})->name('getSlug');