<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CreateQuestionController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\StatsController;
use App\Models\Question;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::post('/register', [AuthController::class, 'submit_register'])->name('submit_register');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'submit_login'])->name('submit_login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/browse', [BrowseController::class, 'index'])->name('browse');
Route::get('/stats', [StatsController::class, 'index'])->name('stats');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::resource('questions', QuestionController::class);
Route::post('/questions/{question}/responses', [ResponseController::class, 'store'])->name('responses.store');

Route::post('/favorites/toggle/{question}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

Route::get('/favourites', [FavoriteController::class, 'index'])->name('favorites.index');

Route::delete('/responses/delete/{response}', [ResponseController::class, 'destroy'])->name('responses.destroy');

Route::resource('admin', AdminController::class);