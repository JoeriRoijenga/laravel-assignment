<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Job extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Job::factory(100)->create();
    }
}
