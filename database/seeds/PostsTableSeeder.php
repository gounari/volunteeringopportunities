<?php

use App\Post;
use App\Volunteer;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = factory(Post::class, 5) -> create();

        Volunteer::All()->each(function ($volunteer) use ($posts){
        $volunteer->posts()->saveMany($posts);
   });
    }
}
