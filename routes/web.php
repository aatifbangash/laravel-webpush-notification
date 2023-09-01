<?php

use App\Livewire\Counter;
use App\Livewire\Home;
use App\Livewire\Single;
use App\Livewire\Test;
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





Route::get('/counter', Counter::class);

Route::get('/test', Test::class);
Route::get('/single/{id}', Single::class)->name('single');
