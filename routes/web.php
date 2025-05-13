<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [ProgramController::class, 'getClients'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('programs', [ProgramController::class, 'getPrograms'])
    ->middleware(['auth', 'verified'])
    ->name('programs');

    Route::get('client', [ProgramController::class, 'search'])->name('clients.name');
    Route::get('/clientProfile/{id}', [ProgramController::class, 'getClientProfile'])->name('clients.profile');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   // Route::post('/api/clients', [ProgramController::class, 'createClient'])->name('clients.create');



});

// test cookies in production
Route::get('/cookie-test', function () {
    return response('Test cookie')->cookie(
        'my_cookie', 'test_value', 60,
        '/', 'health-app-production-c58b.up.railway.app', true, false, false, 'None'
    );
});

Route::get('/debug-cookies', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'received_cookies' => $request->cookies->all(),
        'session_id' => session()->getId(),
        'csrf_token' => csrf_token(),
    ]);
});

Route::get('/debug-session', function () {
    session(['test_key' => 'test_value']);
    return 'Session set';
});

Route::get('/check-session', function () {
    dd([
        'session_cookie' => $_COOKIE['laravel_session'] ?? 'not sent',
        'session_value' => session('test_key', 'not set'),
    ]);
});


require __DIR__.'/auth.php';
