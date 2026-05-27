<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware(['role:SUPERADMIN'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('dashboard');
        
        Route::resource('dealerships', \App\Http\Controllers\Admin\DealershipController::class);
        Route::resource('vehicle-models', \App\Http\Controllers\Admin\VehicleModelController::class);
        Route::resource('legal-documents', \App\Http\Controllers\Admin\LegalDocumentController::class);
    });

    Route::middleware(['role:MANAGER'])->prefix('manager')->name('manager.')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Manager/Dashboard');
        })->name('dashboard');
        
        Route::resource('customers', \App\Http\Controllers\Manager\CustomerController::class);
        Route::resource('slots', \App\Http\Controllers\Manager\AvailabilitySlotController::class);
        Route::resource('test-drives', \App\Http\Controllers\Manager\TestDriveController::class);
        
        Route::get('consent-logs/create', [\App\Http\Controllers\Manager\ConsentLogController::class, 'create'])->name('consent-logs.create');
        Route::post('consent-logs', [\App\Http\Controllers\Manager\ConsentLogController::class, 'store'])->name('consent-logs.store');
        
        Route::get('surveys/create', [\App\Http\Controllers\Manager\SurveyController::class, 'create'])->name('surveys.create');
        Route::post('surveys', [\App\Http\Controllers\Manager\SurveyController::class, 'store'])->name('surveys.store');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
