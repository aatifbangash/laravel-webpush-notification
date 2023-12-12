<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Post;
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

Route::get('/tinker', function () {

    $data = Category::query()
// (inner-join) load all the posts and categories
        ->with('posts')

// (left-join) load all the categories but only the specific posts from the posts list which matched by the query
//        ->with([
//            'posts' => fn($query) => $query->whereIn('posts.id', [1])
//        ])

// load all the categories (with posts list) which are having atleast one or more posts.
// Categories with no posts are ignored
// NOTE:- with() is not required for it. If with() is also used the eager loading will happen.
//        ->has('posts')

// (inner-join) get all categories which contains the matching post in the posts list.
// Categories with no matching posts are ignored
// NOTE:- with() is required for it. If with() is also used, the eager loading will happen.
//        ->whereHas('posts', fn($query) => $query->where('posts.id', '=', 1))

// alternative to whereHas()
//        ->whereRelation('posts', 'posts.id', '=', 1)
// load specific categories and only matching post from the list of posts.
// load categories and only specific posts which are matched by the query. Rest of the posts will be ignored.
// NOTE:- not with() is required for it. As it loads and check existence of the related models

// eager load posts (based on conditions) and also apply the query on relationships method (posts)
//        ->withWhereHas('posts', fn($query) => $query->where('posts.id', '=', 1))
        ->get();


    return CategoryResource::collection($data);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// 'abilities:post-create,post-delete,post-update' //user must have all the permissions
// 'ability:admin_role' // user must have any permissions to access the resources.
Route::middleware(['auth:sanctum', 'ability:role:admin_role'])->group(function () {
    Route::get('/ability', [AuthController::class, 'ability']);
});

Route::get('/', function () {
    return response()->json(['working' => true]);
});

Route::get('/posts', [PostsController::class, 'index']);

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
