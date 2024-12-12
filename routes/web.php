<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// In routes/web.php
// Route::get('/admin', [\Filament\Pages\Dashboard::class, 'login'])->name('admin');
