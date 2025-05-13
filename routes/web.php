<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

Route::get('/test-cookies', function () {
    return response('Cookie set')->cookie(
        'test_cookie',
        'test_value',
        60,
        '/', // path
        null, // ← no domain
        true, // secure
        true, // httpOnly
        false,
        'Lax'
    );
});

Route::get('/debug-session', function () {
    session(['test_key' => 'test_value']);
    $sessionId = session()->getId();
    Log::info('Setting session ID: ' . $sessionId);
    $cookie = cookie('laravel_session', $sessionId, 120, '/', '', true, true, false, 'lax');
    $response = response('Session set')->withCookie($cookie);
    Log::info('Response headers: ' . json_encode(headers_list()));
    return $response;
});

Route::get('/check-session', function () {
    $sessionId = session()->getId();
    Log::info('Checking session ID: ' . $sessionId);
    return response()->json([
        'session_cookie' => $_COOKIE['laravel_session'] ?? 'not sent',
        'session_value' => session('test_key', 'not set'),
        'session_id' => $sessionId,
        'session_files' => glob(storage_path('framework/sessions/*')) ?: ['no session files'],
        'storage_writable' => is_writable(storage_path('framework/sessions')),
        'response_headers' => headers_list(),
        'port' => env('PORT', 'unknown'),
    ]);
});

Route::get('/test-assets', function () {
    try {
        $manifest = file_get_contents(public_path('build/manifest.json'));
        return response()->json([
            'status' => 'success',
            'manifest' => json_decode($manifest, true),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});

require __DIR__.'/auth.php';
