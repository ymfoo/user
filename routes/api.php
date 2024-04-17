<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'getUserByLists']);
Route::get('/users/{id}', [UserController::class, 'getUserById']);