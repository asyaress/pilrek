<?php

namespace Database\Seeders;

use App\Models\NewsPost;
use Illuminate\Database\Seeder;

class NewsPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (NewsPost::defaultSeedData() as $post) {
            NewsPost::updateOrCreate(
                ['slug' => $post['slug']],
                $post
            );
        }
    }
}
