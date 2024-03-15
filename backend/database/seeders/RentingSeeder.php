<?php

namespace Database\Seeders;

use App\Models\Renting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Renting::factory()->count(100)->create();
    }
}
