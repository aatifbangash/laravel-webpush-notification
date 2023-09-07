<?php

use App\Livewire\Counter;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Single;
use App\Livewire\Test;
use App\Livewire\UserManagement;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('home');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

// user middleware as a wrapper for dashboard and user-management
Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/user-management', UserManagement::class)->name('user-management');



Route::get('/counter', Counter::class);
Route::get('/test', Test::class);
Route::get('/single/{id}', Single::class)->name('single');
