<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Job extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jobs')->insert([
            'title' => "Adminstrator",
        ]);

        \App\Models\Job::factory(100)->create();
    }
}
