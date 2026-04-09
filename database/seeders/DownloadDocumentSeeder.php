<?php

namespace Database\Seeders;

use App\Models\DownloadDocument;
use Illuminate\Database\Seeder;

class DownloadDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (DownloadDocument::defaultSeedData() as $document) {
            DownloadDocument::updateOrCreate(
                ['document_order' => $document['document_order']],
                $document
            );
        }
    }
}

