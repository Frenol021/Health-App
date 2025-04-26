<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ProgramController::class, 'getClients'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('programs', [ProgramController::class, 'getPrograms'])
    ->middleware(['auth', 'verified'])
    ->name('programs');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   // Route::post('/api/clients', [ProgramController::class, 'createClient'])->name('clients.create');



});

require __DIR__.'/auth.php';
