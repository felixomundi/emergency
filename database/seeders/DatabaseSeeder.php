<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeed;
use Database\Seeders\CountySeeder;
use Database\Seeders\SubCountySeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeed::class,
            CountySeeder::class,
            SubCountySeeder::class,
        ]);
        
    }
}
