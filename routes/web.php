<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobHistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SecureImageController;
use App\Http\Controllers\Report\JobReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chart', [DashboardController::class, 'chart'])->name('dashboard.chart');

    Route::prefix('job')->name('job.')->group(function() {
        Route::get('/', [JobController::class, 'index'])->name('index');
        Route::post('/create', [JobController::class, 'create'])->name('create');
        Route::get('/table', [JobController::class, 'table'])->name('table');
        Route::post('/update', [JobController::class, 'update'])->name('update');
        Route::post('/delete', [JobController::class, 'delete'])->name('delete');
        Route::get('/all', [JobController::class, 'all'])->name('all');
        Route::get('/working-hours', [JobController::class, 'workingHours'])->name('working.hours');
        Route::get('/{id}', [JobController::class, 'edit'])->name('edit');
    });

    // report
    Route::prefix('report')->name('report.')->group(function () {
        Route::prefix('job')->name('job.')->group(function () {
            Route::get('/', [JobReportController::class, 'index'])->name('index');
            Route::get('/export', [JobReportController::class, 'export'])->name('export');
        });
    });

    // secure image
    Route::get('/s/{path}', [SecureImageController::class, 'index'])->name('secure.image');

    // profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/', [ProfileController::class, 'update'])->name('update');
        Route::post('/avatar', [ProfileController::class, 'avatar'])->name('avatar');
    });

    // User Management
    Route::prefix('user')->name('user.')->group(function () {
       Route::get('/', [UserController::class, 'index'])->name('index');
       Route::get('/table', [UserController::class, 'table'])->name('table');
       Route::post('/', [UserController::class, 'create'])->name('create');
       Route::post('update', [UserController::class, 'update'])->name('update');
       Route::post('/delete', [UserController::class, 'delete'])->name('delete');
       Route::get('/all', [UserController::class, 'all'])->name('all');
       Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
    });

    // Master
    Route::prefix('master')->name('master.')->group(function () {

        // Category
        Route::prefix('category')->name('category.')->group(function() {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/table', [CategoryController::class, 'table'])->name('table');
            Route::post('/', [CategoryController::class, 'create'])->name('create');
            Route::post('/update', [CategoryController::class, 'update'])->name('update');
            Route::post('/delete', [CategoryController::class, 'delete'])->name('delete');
            Route::get('/change-status/{id}', [CategoryController::class, 'changeStatus'])->name('change.status');
            Route::get('/{id}', [CategoryController::class, 'edit'])->name('edit');
        });

        // Sub Category
        Route::prefix('subcategory')->name('subcategory.')->group(function() {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/table', [SubCategoryController::class, 'table'])->name('table');
            Route::post('/', [SubCategoryController::class, 'create'])->name('create');
            Route::post('/update', [SubCategoryController::class, 'update'])->name('update');
            Route::post('/delete', [SubCategoryController::class, 'delete'])->name('delete');
            Route::get('/all', [SubCategoryController::class, 'all'])->name('all');
            Route::get('/change-status/{id}', [SubCategoryController::class, 'changeStatus'])->name('change.status');
            Route::get('/get-by-category/{categoryId}', [SubCategoryController::class, 'getByCategory'])->name('get.by.category');
            Route::get('/{id}', [SubCategoryController::class, 'edit'])->name('edit');
        });
    });

    Route::prefix('job')->name('job.')->group(function() {
        Route::get('/', [JobController::class, 'index'])->name('index');
        Route::post('/save/{id?}', [JobController::class, 'create'])->name('create');
    });

    Route::prefix('history')->name('history.')->group(function() {
        Route::get('/', [JobHistoryController::class, 'index'])->name('index');
        Route::get('/table', [JobHistoryController::class, 'datatable'])->name('datatable');
        Route::post('/jam-kerja', [JobHistoryController::class, 'jamKerja'])->name('jam.kerja');
    });
});

Route::middleware('guest')->group(function (){
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    // forgot password
    Route::get('/forgot-password', [LoginController::class, 'forgot'])->name('forgot');
    Route::post('/forgot-password', [LoginController::class, 'sendForgot'])->name('forgot.submit');
    Route::get('/resend-email', [LoginController::class, 'resendEmail'])->name('forgot.resend');
    Route::get('/verification-forgot/{user_id}', [LoginController::class, 'verificationForgot'])->name('forgot.verification');
    Route::post('/verification-forgot/{user_id}', [LoginController::class, 'verificationForgotSubmit'])->name('forgot.verification.submit');
    Route::get('/reset-password/{user_id}', [LoginController::class, 'resetPassword'])->name('reset.password');
    Route::post('/reset-password/{user_id}', [LoginController::class, 'resetPasswordSubmit'])->name('reset.password.submit');
});
