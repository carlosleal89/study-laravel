<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/accounts/create', function () {
    return view('accounts.create');
});

Route::get('/accounts', function () {
    return view('accounts.index');
});

Route::get('/accounts/{id}/edit', function ($id) {
    return view('accounts.edit');
});

Route::get('/accounts/{id}', function ($id) {
    return view('accounts.show');
});
