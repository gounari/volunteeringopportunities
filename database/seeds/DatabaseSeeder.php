<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VolunteersTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(ApplicationFormsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
    }
}
