<?php

use App\Http\Controllers\AuthController;
use App\Http\Resources\UserResource;
use App\Models\Category;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'ability:role:admin_role'])->group(function () {
    Route::get('/ability', [AuthController::class, 'me2']);
});

Route::get('/', function () {
    return response()->json(['working' => true]);
});

Route::get('/users', function () {

    $response = User::with(['categories:id,user_id,name' => [
        'posts' => function ($query) {
            $query->with([
                'comments:id,post_id,content',
                'likes'
            ])->withCount('likes');
        }
    ]])->get();

//
//    $response = User::with(['categories:id,user_id,name' => [
//        'posts:id,name' => [
//            'comments:id,post_id,content',
//            'likes:id,post_id'
//        ],
//        'posts' => function($query) {
//            $query->withCount('likes');
//        }
//    ]])->get();

//    $response = User::with([
//        'categories:id,user_id,name',
//        'categories.posts' => function ($query) {
//            $query->with(['comments:id,post_id,content', 'likes:id,post_id'])
//                ->withCount('likes');
//        },
//    ])->get();
    return UserResource::collection($response);
});

Route::get('users/{id}/posts', function (Request $request, $id) {
    $user = User::with('posts')->find($id);
    return $user;
});

Route::post('users/{id}/posts', function (Request $request, $id) {
    $user = User::find($id);

    $user->posts()->create([
        'name' => 'test',
        'content' => 'test content'
    ]);

    return $user->posts;
});

Route::delete('users/{id}/posts', function (Request $request, $id) {
    $user = User::find($id);

    $user->posts()->where('id', '<>', '10')->delete();

    return $user->posts;
});

Route::put('users/{id}/posts', function (Request $request, $id) {
    $user = User::find($id);

    $user->posts()->where('id', '=', 10)->update([
        'name' => 'updated test 10'
    ]);

    return $user->posts;
});


Route::get('category/{id}/posts', function (Request $request, $id) {
    $category = Category::with('posts')->find($id);

    return $category;
});

Route::post('category/{id}/posts', function (Request $request, $id) {
    $category = Category::find($id);

    return $category;
});

Route::get('test', function (Request $request) {
    return User::find(1)->categories()->whereName('category1')->first()->posts()->get();
});

Route::get('/inspire', function (Inspire $inspire) {
    return (new Inspire())->show();
});
