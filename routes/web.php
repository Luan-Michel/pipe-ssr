<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$url = config('app.url');
if(env('APP_ENV') == 'production'){
    URL::forceScheme('https');
}
URL::forceRootUrl($url);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/create', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects/edit/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/step2/{id}', [ProjectController::class, 'step2'])->name('projects.step2');
    Route::post('/projects/uploadFile/{id}', [ProjectController::class, 'uploadFile'])->name('projects.uploadFile');
    Route::get('/projects/step3/{id}', [ProjectController::class, 'step3'])->name('projects.step3');
    Route::post('/projects/step3/insertSample', [ProjectController::class, 'insertSample'])->name('projects.insertSample');
    Route::get('/projects/step3/{id}/getSamples', [ProjectController::class, 'getSamples'])->name('projects.getSamples');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
});

require __DIR__.'/auth.php';
