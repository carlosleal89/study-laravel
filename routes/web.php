<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/accounts/create', function () {
    return view('accounts.create');
});

Route::get('/accounts', function () {
    return view('accounts.index');
});
