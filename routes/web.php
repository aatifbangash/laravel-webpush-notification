<?php

use App\Livewire\Counter;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Single;
use App\Livewire\Test;
use App\Livewire\UserManagement;
use App\Models\User;
use App\Notifications\PushDemo;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('webpush');
});

Route::get('/push', function (Request $request) {
    Notification::send(User::find(1), new PushDemo);
//    return redirect()->back();
})->name('push');

Route::post('/push', function (Request $request) {
//dd($request->keys);
//    $request->validate($request,[
//        'endpoint'    => 'required',
//        'keys.auth'   => 'required',
//        'keys.p256dh' => 'required'
//    ]);

    $endpoint = $request->endpoint;

    $token = $request->keys['auth'];
    $key = $request->keys['p256dh'];
    $user = User::find(1);

    $user->updatePushSubscription($endpoint, $key, $token);

    return response()->json(['success' => true], 200);
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

// user middleware as a wrapper for dashboard and user-management
Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/user-management', UserManagement::class)->name('user-management');


Route::get('/counter', Counter::class);
Route::get('/test', Test::class);
Route::get('/single/{id}', Single::class)->name('single');
