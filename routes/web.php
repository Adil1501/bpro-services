<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/test', function() {
    return '<h1>Admin Test Pagina</h1><p>Als je dit ziet, werkt de middleware!</p>';
})->middleware(['auth', 'admin']);

require __DIR__.'/auth.php';


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
        ->name('dashboard');
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::post('users/{user}/toggle-admin', [App\Http\Controllers\Admin\UserController::class, 'toggleAdmin'])
        ->name('users.toggle-admin');
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('tags', App\Http\Controllers\Admin\TagController::class)
        ->except(['show']);
    Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)
        ->except(['show']);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
});
