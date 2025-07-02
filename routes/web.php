<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/laptop', function () {
    return view('pages.plp');
})->name('plp');

Route::get('/laptop/{id}', function () {
    return view('pages.pdp');
})->name('pdp');

