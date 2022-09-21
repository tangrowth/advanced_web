<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/welcome', [TaskController::class, 'login']);
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'post']);
    Route::post('/edit/{id}',[TaskController::class, 'edit']);
    Route::post('/delete/{id}', [TaskController::class, 'delete']);
    Route::get('/show',[TaskController::class, 'show']);
    Route::post('/show',[TaskController::class, 'search']);
});

require __DIR__.'/auth.php';
