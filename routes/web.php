<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landingpage');
});



Route::get('/dashboard', function () {
    return redirect('/admin'); // Filament's default URL
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/admin/logout', function () {
//     // Log the user out from Breeze (same guard as used by Filament)
//    return redirect('/login');  // Redirect to Breeze's login page
// });

// Route::get('/admin/login', function () {
//      // Log the user out from Breeze (same guard as used by Filament)
//     return redirect('/login');  // Redirect to Breeze's login page
// });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
