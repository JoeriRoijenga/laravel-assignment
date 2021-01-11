<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Company extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'company_name' => "CRM",
            'path_to_logo' => "logo.png",
            'city' => 'Groningen',
            'zip' => "9751HA",
            'street' => "Groningerlaan",
            'housenumber' => 1,
        ]);
        
        \App\Models\Company::factory(10)->create();
    }
}
