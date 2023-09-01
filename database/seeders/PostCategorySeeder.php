<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'atif',
            'email' => 'atif@gmail.com',
            'password' => bcrypt('atifatif')
        ]);

        $category = Category::create([
            'name' => 'category1',
            'user_id' => $user->id
        ]);

        $post = Post::create([
            'name' => 'category1',
            'user_id' => $user->id
        ]);

        $category->posts()->attach($post);
    }
}
