<?php

// routes/dashboard.php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
