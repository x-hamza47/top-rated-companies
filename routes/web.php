<?php

use App\Http\Controllers\Auth\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\CompanyController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Route::get('/',[HomeController::class, 'index'])->name('home.index');
Route::get('/companies/{serviceSlug}', [ServiceController::class, 'index'])->name('services.companies');
Route::get('/profile/{companySlug}', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/packages-plan', [ProfileController::class, 'packages'])->name('profile.plan');


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
Route::prefix('dashboard')->middleware(['auth:web,admin'])->group(function(){
    Route::get("/", [DashboardController::class, 'index'])->name('dashboard.index');

    // ? Companies Crud Routes
    Route::get("/companies", [CompanyController::class, 'index'])->name('companies.index');
    Route::get("/companies/edit/{company}", [CompanyController::class, 'edit'])->name('companies.edit')->whereNumber('id');
    Route::post("/companies/delete/{id}", [CompanyController::class, 'destroy'])->name('companies.destroy')->whereNumber('id');
    Route::put('/companies/update/{company}', [CompanyController::class, 'update'])->name("companies.update");

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
        $count = \App\Models\Company::where("slug", "LIKE", "$slug%")->count();

        if ($count > 0) {
            $slug .= '-'. ($count + 1);
        }

        return response()->json([
            'status' => true,
            'slug' => $slug,
        ]);
    }
})->name('getSlug');