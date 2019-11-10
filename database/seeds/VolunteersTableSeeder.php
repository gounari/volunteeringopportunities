<?php

use App\Volunteer;
use Illuminate\Database\Seeder;

class VolunteersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Volunteer::class, 2) -> create();
    }
}
