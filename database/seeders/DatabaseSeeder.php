<?php

namespace Database\Seeders;

use App\Models\Secret;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Secret::factory(10)->create();
    }
}
