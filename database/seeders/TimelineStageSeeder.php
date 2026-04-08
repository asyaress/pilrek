<?php

namespace Database\Seeders;

use App\Models\TimelineStage;
use Illuminate\Database\Seeder;

class TimelineStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (TimelineStage::defaultSeedData() as $stage) {
            TimelineStage::updateOrCreate(
                ['stage_order' => $stage['stage_order']],
                $stage
            );
        }
    }
}
