<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Company;
use Database\Seeders\User;
use Database\Seeders\Job;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Company::class,
            Job::class,
            User::class,
        ]);
    }
}
