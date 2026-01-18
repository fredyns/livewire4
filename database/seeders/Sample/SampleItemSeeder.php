<?php

namespace Database\Seeders\Sample;

use App\Models\Sample\SampleItem;
use Illuminate\Database\Seeder;

class SampleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SampleItem::factory()
            ->count(32)
            ->create();
    }
}
