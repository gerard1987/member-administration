<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FiscalYear;

class FiscalYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FiscalYear::factory()->count(6)->sequence(
            ['year' => 2020],
            ['year' => 2021],
            ['year' => 2022],
            ['year' => 2023],
            ['year' => 2024],
            ['year' => 2025],
        )->create();
    }
}
