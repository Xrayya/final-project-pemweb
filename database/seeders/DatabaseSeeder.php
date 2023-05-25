<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Follow;
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
        // \App\Models\User::factory(10)->create();


        User::create([
            'username' => 'test',
            'password' => bcrypt('rahasia1'),
            'email' => 'testing@gmail.com',
            'bio' => 'saya adalah mahasiswa FILKOM',
            'display_name' => 'Testing User'
        ]);

        User::create([
            'username' => 'test2',
            'password' => bcrypt('rahasia2'),
            'email' => 'testing2@gmail.com',
            'display_name' => 'Testing User 2'
        ]);

        Post::create([
            'post' => 'post1',
            'id_user' => 1
        ]);

        Post::create([
            'post' => 'post2',
            'id_user' => 1
        ]);


        Post::create([
            'post' => 'post3',
            'parent' => 1,
            'id_user' => 1
        ]);

        Post::create([
            'post' => 'post4',
            'parent' => 1,
            'id_user' => 2
        ]);

        Like::create([
            'id_user' => 1,
            'id_post' => 1
        ]);

        Like::create([
            'id_user' => 2,
            'id_post' => 1
        ]);

        Follow::create([
            'id_follower' => 1,
            'id_followed' => 2
        ]);

        Follow::create([
            'id_follower' => 2,
            'id_followed' => 1
        ]);
    }
}
