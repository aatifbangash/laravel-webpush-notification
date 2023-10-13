<?php

use App\Livewire\Counter;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Single;
use App\Livewire\Test;
use App\Livewire\UserManagement;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PushDemo;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('webpush');
});

Route::get('/query', function () {

    $data = User::with([
        'posts:id,user_id,name' => [
            'likes:id,post_id',
            'comments:post_id,content'
        ]
    ])->get();

//    $data = User::has('posts' )->find(1); // has least one post

//    $data = User::withSum('posts', 'amount')->find(1);

//    $data = User::withCount('posts')->find(1);

//    $data = User::find(1);
//    $data->load('posts');

    dd($data->toArray());
    return view('welcome2')->with('user', $data);
});

Route::get('/enum', function () {
    enum Status: int
    {
        case Pending = 0;
        case Active = 1;
        case Completed = 2;
    }

    echo Status::Active->name;
    echo Status::Active->value;
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
