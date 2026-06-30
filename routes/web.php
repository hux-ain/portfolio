<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SkillsController;
use Illuminate\Support\Facades\Route;

// Frontend Routes (Public)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('/skills', [SkillsController::class, 'index'])->name('skills');
Route::get('/experience', [ExperienceController::class, 'index'])->name('experience');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/chatbot/ask', [ContactController::class, 'chatbot'])->name('chatbot.ask');

// Admin Routes (Protected by auth & admin middleware)
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Projects CRUD
    Route::resource('projects', App\Http\Controllers\Admin\ProjectController::class);

    // Skills CRUD
    Route::resource('skills', App\Http\Controllers\Admin\SkillController::class);

    // Experiences CRUD
    Route::resource('experiences', App\Http\Controllers\Admin\ExperienceController::class);

    // Messages
    Route::get('/messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{message}/mark-read', [App\Http\Controllers\Admin\MessageController::class, 'markRead'])->name('messages.mark-read');
});

// Profile Routes (Auth required)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
