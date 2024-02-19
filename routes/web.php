<?php

use App\Livewire\Home;
use App\Livewire\Post;
use Livewire\Volt\Volt;
use App\Mail\SendCVEmail;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', Home::class);


// Route::get('posts', Post::class)->name('posts');
// Volt::route('posts/create', 'posts.create');
// Volt::route('posts/{post}/edit', 'posts.create');
