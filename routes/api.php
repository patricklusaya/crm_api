<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// SUPER ADMIN AUTHORITIES
// perform crud operations on roles
Route::resource('role', RoleController::class);


// PUBLIC ENDPOINTS
// signup user
Route::post('/signup', [AuthController::class, 'store']);
// signin
Route::post( '/signin', [AuthController::class, 'signin']);
// signin
Route::post( '/signout', [AuthController::class, 'signout'])->middleware('auth:sanctum');
// find info of a user
Route::get( '/users/{id}', [AuthController::class, 'findUser'])->middleware('auth:sanctum');


Route::post( '/signin', [AuthController::class, 'signin']);

Route::middleware('api')->group(function () {
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']); // Update customer
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
});

