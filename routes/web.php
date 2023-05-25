<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/signup', [SignUpController::class, 'index'])->middleware('guest');
Route::post('/signup', [SignUpController::class, 'signup'])->middleware('guest');

Route::get('/signin', [SignInController::class, 'index'])->middleware('guest')->name('login');
Route::post('/signin', [SignInController::class, 'authenticate']);
Route::post('/signout', [SignInController::class, 'signout']);


Route::resource('/post', PostsController::class)->except(['create', 'index'])->middleware('auth');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->middleware('auth')->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.show');

Route::post('/toggle-like', [LikeController::class, 'toggleLike']);
Route::post('/toggle-follow', [FollowController::class, 'toggleFollow']);
