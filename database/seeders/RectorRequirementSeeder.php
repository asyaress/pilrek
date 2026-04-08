<?php

namespace Database\Seeders;

use App\Models\RectorRequirement;
use Illuminate\Database\Seeder;

class RectorRequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RectorRequirement::defaultSeedData() as $requirement) {
            RectorRequirement::updateOrCreate(
                ['requirement_order' => $requirement['requirement_order']],
                $requirement
            );
        }
    }
}
