<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadDocument extends Model
{
    protected $fillable = [
        'document_order',
        'title',
        'description',
        'file_path',
        'file_name',
        'file_extension',
        'file_size_kb',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'file_size_kb' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('document_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function defaultSeedData(): array
    {
        return [
            [
                'document_order' => 1,
                'title' => 'Surat Keputusan Panitia Pilrek Unmul 2026',
                'description' => 'Dokumen penetapan panitia pemilihan rektor periode 2026-2030.',
                'file_path' => null,
                'file_name' => null,
                'file_extension' => 'pdf',
                'file_size_kb' => null,
                'is_active' => true,
            ],
            [
                'document_order' => 2,
                'title' => 'Jadwal Tahapan Pilrek Unmul 2026-2030',
                'description' => 'Rangkaian jadwal resmi setiap tahapan pemilihan rektor.',
                'file_path' => null,
                'file_name' => null,
                'file_extension' => 'pdf',
                'file_size_kb' => null,
                'is_active' => true,
            ],
            [
                'document_order' => 3,
                'title' => 'Format Biodata Bakal Calon Rektor',
                'description' => 'Template biodata yang wajib diisi bakal calon rektor.',
                'file_path' => null,
                'file_name' => null,
                'file_extension' => 'docx',
                'file_size_kb' => null,
                'is_active' => true,
            ],
            [
                'document_order' => 4,
                'title' => 'Pakta Integritas Calon Rektor',
                'description' => 'Dokumen pakta integritas untuk proses pencalonan.',
                'file_path' => null,
                'file_name' => null,
                'file_extension' => 'docx',
                'file_size_kb' => null,
                'is_active' => true,
            ],
            [
                'document_order' => 5,
                'title' => 'Template Visi, Misi, dan Program Kerja',
                'description' => 'Format naskah visi-misi dan program kerja calon rektor.',
                'file_path' => null,
                'file_name' => null,
                'file_extension' => 'pdf',
                'file_size_kb' => null,
                'is_active' => true,
            ],
        ];
    }
}

