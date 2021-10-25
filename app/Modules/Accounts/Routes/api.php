<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Accounts\Http\Controllers;

Route::post('/login', [Controllers\UserAuthController::class, 'login']);
Route::post('/logout', [Controllers\UserAuthController::class, 'logout'])->middleware('auth:users');
