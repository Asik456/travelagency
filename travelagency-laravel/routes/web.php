<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\LanguageController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/check-login', [AuthController::class, 'checkLogin']);
Route::post('/check-register', [AuthController::class, 'checkRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/home', function () {
    if (!session('user_id')) return redirect('/login');
    return view('home');
});

Route::get('/dashboard', function () {
    if (!session('user_id') || session('user_role') !== 'admin') return redirect('/home');
    return view('admin.dashboard');
});

Route::post('/resources', [ResourceController::class, 'store']);
Route::put('/resources/{id}', [ResourceController::class, 'update']);

Route::post('/language/switch', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/users', function () {
    if (!session('user_id') || session('user_role') !== 'admin') {
        return redirect('/home');
    }
    $users = \App\Models\User::all();
    return view('admin.users', compact('users'));
});

Route::post('/users/{id}/role', function ($id, \Illuminate\Http\Request $request) {
    if (!session('user_id') || session('user_role') !== 'admin') {
        return response()->json(['error' => 'Forbidden'], 403);
    }

    if ($id == session('user_id')) {
        return response()->json(['error' => 'Cannot change your own role'], 403);
    }

    $user = \App\Models\User::findOrFail($id);

    if ($user->role === 'admin') {
        return response()->json(['error' => 'Cannot change admin role'], 403);
    }

    $user->role = $request->input('role');
    $user->save();

    return response()->json(['success' => true, 'role' => $user->role]);
});

