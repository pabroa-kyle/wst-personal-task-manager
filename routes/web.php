<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [TaskController::class, 'dashboard'])->name('dashboard');
Route::get('/tasks/board', [TaskController::class, 'board'])->name('tasks.board');

Route::resource('tasks', TaskController::class)->except('show');
Route::patch('tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.update-status');
