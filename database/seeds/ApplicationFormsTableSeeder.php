<?php

use App\ApplicationForm;
use Illuminate\Database\Seeder;

class ApplicationFormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ApplicationForm::class, 5) -> create();
    }
}
