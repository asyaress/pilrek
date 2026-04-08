<?php

namespace Database\Seeders;

use App\Models\RectorCandidate;
use Illuminate\Database\Seeder;

class RectorCandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RectorCandidate::defaultSeedData() as $candidate) {
            RectorCandidate::updateOrCreate(
                ['slug' => $candidate['slug']],
                $candidate
            );
        }
    }
}
