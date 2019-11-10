<?php

use App\User;
use App\Volunteer;
use App\Organization;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 4) -> create();

        $volunteer1 = Volunteer::find(1);
        $user1 = User::find(1);
        $user1->profile_id = $volunteer1->id;
        $user1->profile_type = "App\Volunteer";
        $user1->save();

        $organization1 = Organization::find(1);
        $user2 = User::find(2);
        $user2->profile_id = $organization1->id;
        $user2->profile_type = "App\Organization";
        $user2->save();

        $volunteer2 = Volunteer::find(2);
        $user3 = User::find(3);
        $user3->profile_id = $volunteer2->id;
        $user3->profile_type = "App\Volunteer";
        $user3->save();

        $organization2 = Organization::find(2);
        $user4 = User::find(4);
        $user4->profile_id = $organization2->id;
        $user4->profile_type = "App\Organization";
        $user4->save();
    }
}
