<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// AUTH (public)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// 🔐 PROTECTED ROUTES (Sanctum + RBAC)
Route::middleware('auth:sanctum')->group(function () {

    // USER INFO
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);


    // =========================
    // 🔐 RBAC ROLE TEST ROUTES
    // =========================

    Route::get('/admin-only', function () {
        return response()->json([
            'message' => 'Admin access granted'
        ]);
    })->middleware('role:admin');

    Route::get('/manager-only', function () {
        return response()->json([
            'message' => 'Manager access granted'
        ]);
    })->middleware('role:manager');

    Route::get('/customer-only', function () {
        return response()->json([
            'message' => 'Customer access granted'
        ]);
    })->middleware('role:customer');

    Route::get('/moderator-only', function () {
        return response()->json([
            'message' => 'Moderator access granted'
        ]);
    })->middleware('role:moderator');


    // =========================
    // 🔐 PERMISSION TEST ROUTE
    // =========================

    Route::get('/delete-resource', function () {
        return response()->json([
            'message' => 'Permission granted: delete resources'
        ]);
    })->middleware('permission:delete resources');

});
