<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BatchController;


//accounts routes
Route::apiResource('accounts', AccountController::class);

//batches routes
Route::post('/generate', [BatchController::class, 'generate']);