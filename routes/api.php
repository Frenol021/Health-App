
<?php


use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

// route to create clients

Route::post('clients', [ProgramController::class, 'createClient'])->name('clients.create');
// route to create programs
Route::post('programs', [ProgramController::class, 'createProgram'])->name('programs.create');
Route::post('enrollments', [ProgramController::class, 'enrollClientInProgram'])->name('enrollments.create');