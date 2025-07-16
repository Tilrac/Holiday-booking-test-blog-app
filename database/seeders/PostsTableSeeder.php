<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $user = User::where('email', 'user@example.com')->first();

        Post::create([
            'user_id' => $admin->id,
            'title' => 'Admin Post',
            'content' => 'This is a post created by the admin.',
            'status' => 'published'
        ]);

        Post::create([
            'user_id' => $user->id,
            'title' => 'User Post Pending',
            'content' => 'This is a pending post by a regular user.',
            'status' => 'pending'
        ]);

        Post::create([
            'user_id' => $user->id,
            'title' => 'User Post Published',
            'content' => 'This is a published post by a regular user.',
            'status' => 'published'
        ]);

        Post::create([
            'user_id' => $user->id,
            'title' => 'User Post Rejected',
            'content' => 'This is a rejected post by a regular user.',
            'status' => 'rejected'
        ]);
    }
}