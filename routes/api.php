<?php

use App\Models\User;
use Custom\Inspire\Inspire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function (Request $request) {
   return User::find(1)->categories()->whereName('category1')->first()->posts()->get();
});

Route::get('/inspire', function (Inspire $inspire) {
    return (new Inspire())->show();
});
