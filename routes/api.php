<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CopyController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthorController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PublisherController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Authentication
Route::post('register', [AuthController::class, 'register']);
Route::post('login',    [AuthController::class, 'login']);

// Protected Endpoints
Route::middleware('auth:sanctum')->group(function () {
    // User Management
    Route::apiResource('users', UserController::class)->except(['store']);

    // Library Entities
    Route::apiResource('authors', AuthorController::class);
    Route::apiResource('books',   BookController::class);
    Route::apiResource('copies',  CopyController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('publishers', PublisherController::class);

    // Loan Operations
    Route::post('loans/borrow',           [LoanController::class, 'borrow']);
    Route::patch('loans/{loan}/return',   [LoanController::class, 'return']);
    Route::get('loans/overdue',           [LoanController::class, 'overdue']);

    // Logout
    Route::post('logout', [AuthController::class, 'logout']);
});