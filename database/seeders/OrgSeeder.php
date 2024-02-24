<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Org;

class OrgSeeder extends Seeder
{
    public function run(): void
    {
        Org::factory(10)->create();
    }
}
