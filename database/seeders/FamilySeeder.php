<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Family;
use App\Models\FamilyMember;

class FamilySeeder extends Seeder
{
    public function run()
    {
        // Create 10 families
        Family::factory(10)
        ->has(FamilyMember::factory()->count(5))
        ->create();
    }
}
