<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Company extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Company::factory(2)->create();
    }
}
