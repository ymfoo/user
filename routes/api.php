<?php

use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'getUserByLists']);
Route::get('/users/details/{id}', [UserController::class, 'getUserById']);
Route::post('/users/create', [UserController::class, 'createUser']);
Route::put('/users/update/{id}', [UserController::class, 'updateUser']);
Route::delete('/users/delete/{id}', [UserController::class, 'deleteUser']);

Route::get('/departments', [DepartmentController::class, 'index']);