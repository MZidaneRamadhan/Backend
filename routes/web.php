<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\BiayaTambahanController;
use App\Http\Controllers\PaketInternetController;

Route::post('/register', [OTPController::class, 'register']);
Route::post('/verify-otp', [OTPController::class, 'virifyOtp']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [UserController::class, 'profile']);
});

// Costumers Route
Route::middleware('auth:api')->group(function () {
    Route::controller(PelangganController::class)->group(function () {
        Route::get('costumers', 'index');
        Route::post('costumers/store', 'store');
        Route::get('costumers/{id}/details', 'details');
        Route::get('costumers/{id}/edit', 'edit');
        Route::put('costumers/{id}/update', 'update');
        Route::delete('costumers/{id}/delete', 'destroy');
        Route::post('costumers/multi-delete', 'multiDeleted');
        Route::get('costumers/trashed', 'trashed');
        Route::post('costumers/{id}/restore', 'restore');
        Route::delete('costumers/{id}/forcedelete', 'forceDelete');
    });

    // Biaya Tambahan Route
    Route::controller(CompanyController::class)->group(function () {
        Route::get('company', 'index');
        Route::post('company/store', 'store');
        Route::put('company/{id}/update', 'update');
        Route::delete('company/{id}/delete', 'destroy');
        Route::get('company/trashed', 'trashed');
        Route::post('company/{id}/restore', 'restore');
        Route::delete('company/{id}/forcedelete', 'forceDelete');
    });

    // Package Internet Route
    Route::controller(PaketInternetController::class)->group(function () {
        Route::get('internet-packages', 'index');
        Route::get('internet-packages/{id}/details', 'details');
        Route::post('internet-packages/store', 'store');
        Route::put('internet-packages/{id}/update', 'update');
        Route::delete('internet-packages/{id}/delete', 'destroy');
        Route::get('internet-packages/trashed', 'trashed');
        Route::post('internet-packages/{id}/restore', 'restore');
        Route::delete('internet-packages/{id}/forcedelete', 'forceDelete');
    });

    // Server Route
    Route::controller(ServerController::class)->group(function () {
        Route::get('server-locations', 'index');
        Route::post('server-locations/store', 'store');
        Route::put('server-locations/{id}/update', 'update');
        Route::delete('server-locations/{id}/delete', 'destroy');
        Route::get('internet/trashed', 'trashed');
        Route::post('internet/{id}/restore', 'restore');
        Route::delete('internet/{id}/forcedelete', 'forceDelete');
    });

    // Cluster Route
    Route::controller(ClusterController::class)->group(function () {
        Route::get('clustering', 'index');
        Route::post('clustering/store', 'store');
        Route::put('clustering/{id}/update', 'update');
        Route::delete('clustering/{id}/delete', 'destroy');
        Route::get('clustering/trashed', 'trashed');
        Route::post('clustering/{id}/restore', 'restore');
        Route::delete('clustering/{id}/forcedelete', 'forceDelete');
    });

    // Costumers Route
    Route::controller(InventarisController::class)->group(function () {
        Route::get('inventories', 'index');
        Route::post('inventories/store', 'store');
        Route::put('inventories/{id}/update', 'update');
        Route::delete('inventories/{id}/delete', 'destroy');
        Route::get('inventories/trashed', 'trashed');
        Route::post('inventories/{id}/restore', 'restore');
        Route::delete('inventories/{id}/forcedelete', 'forceDelete');
    });

    // Biaya Tambahan Route
    Route::controller(BiayaTambahanController::class)->group(function () {
        Route::get('additional-fee', 'index');
        Route::post('additional-fee/store', 'store');
        Route::put('additional-fee/{id}/update', 'update');
        Route::delete('additional-fee/{id}/delete', 'destroy');
        Route::get('additional-fee/trashed', 'trashed');
        Route::post('additional-fee/{id}/restore', 'restore');
        Route::delete('additional-fee/{id}/forcedelete', 'forceDelete');
    });

    // Discount Route
    Route::controller(DiscountController::class)->group(function () {
        Route::get('discount', 'index');
        Route::post('discount/store', 'store');
        Route::put('discount/{id}/update', 'update');
        Route::delete('discount/{id}/delete', 'destroy');
        Route::get('discount/trashed', 'trashed');
        Route::post('discount/{id}/restore', 'restore');
        Route::delete('discount/{id}/forcedelete', 'forceDelete');
    });

    // User Route
    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'index');
        Route::post('user/store', 'store');
        Route::get('user/{id}/edit', 'edit');
        Route::put('user/{id}/update', 'update');
        Route::get('user/{id}/details', 'details');
        Route::put('user/change-password', 'changePassword');
        Route::delete('user/{id}/delete', 'destroy');
        Route::get('user/trashed', 'trashed');
        Route::post('user/{id}/restore', 'restore');
        Route::delete('user/{id}/forcedelete', 'forceDelete');
    });
});
