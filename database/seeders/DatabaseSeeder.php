<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


//        Post::factory(1000)->create();
//        User::factory(1)->has(
//            Category::factory(5)->has(
//                Post::factory(2)->has(
//                    Comment::factory(3))->has(
//                    Like::factory(1)
//                )
//            )
//        )->create();

        User::factory(2)->has(
            Category::factory(2)->has(
                Post::factory(5)
                    ->state(function (array $attributes, Category $category) {
                        return ['user_id' => $category->user_id];
                    })->has(
                        Comment::factory(2)
                            ->state(function (array $attributes, Post $post) {
                                return ['user_id' => $post->user_id];
                            })
                    )->has(
                        Like::factory(2)
                            ->state(function (array $attributes, Post $post) {
                                return ['user_id' => $post->user_id];
                            })
                    )
            )
        )->create();
//         \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        $this->call(PostCategorySeeder::class);
    }
}
