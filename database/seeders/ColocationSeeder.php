<?php

namespace Database\Seeders;

use App\Models\Colocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Colocation::factory(30)->create() ;
    }
}
