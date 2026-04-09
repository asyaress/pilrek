<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RectorRequirement extends Model
{
    public const DEFAULT_ICON_CLASS = 'fa-file-alt';

    protected $fillable = [
        'requirement_order',
        'label',
        'title',
        'description',
        'details',
        'icon_class',
        'tab_color',
        'gradient_start',
        'gradient_middle',
        'gradient_end',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'details' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('requirement_order');
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
                'requirement_order' => 1,
                'label' => 'Status Kepegawaian',
                'title' => 'Persyaratan 1 - Status Kepegawaian dan Jabatan Akademik',
                'description' => 'Calon wajib memenuhi syarat dasar kepegawaian dan memiliki jabatan akademik sesuai ketentuan pemilihan rektor.',
                'details' => [
                    'Berstatus dosen tetap Universitas Mulawarman.',
                    'Memiliki jabatan akademik sekurang-kurangnya Lektor Kepala.',
                    'Tidak sedang menjalani tugas belajar penuh waktu atau penugasan di luar ketentuan pilrek.',
                ],
                'icon_class' => 'fa-user-tie',
                'tab_color' => '#5A827E',
                'gradient_start' => '#FFFFFF',
                'gradient_middle' => '#FAFFCA',
                'gradient_end' => '#B9D4AA',
                'is_active' => true,
            ],
            [
                'requirement_order' => 2,
                'label' => 'Kualifikasi Pribadi',
                'title' => 'Persyaratan 2 - Kualifikasi Pendidikan dan Integritas',
                'description' => 'Calon wajib menunjukkan kualifikasi akademik, kesehatan, dan integritas personal sebagai pimpinan universitas.',
                'details' => [
                    'Memiliki kualifikasi akademik minimal doktor (S3).',
                    'Sehat jasmani dan rohani dibuktikan dengan surat keterangan resmi.',
                    'Tidak pernah dikenai sanksi disiplin berat serta tidak sedang tersangkut perkara pidana.',
                ],
                'icon_class' => 'fa-check-circle',
                'tab_color' => '#84AE92',
                'gradient_start' => '#FFFFFF',
                'gradient_middle' => '#B9D4AA',
                'gradient_end' => '#84AE92',
                'is_active' => true,
            ],
            [
                'requirement_order' => 3,
                'label' => 'Berkas Administratif',
                'title' => 'Persyaratan 3 - Kelengkapan Dokumen Pencalonan',
                'description' => 'Seluruh berkas administratif pencalonan harus lengkap, valid, dan sesuai format panitia.',
                'details' => [
                    'Formulir pendaftaran, surat pernyataan kesediaan, dan daftar riwayat hidup.',
                    'Salinan SK jabatan fungsional, ijazah terakhir, serta identitas kepegawaian yang sah.',
                    'Dokumen diserahkan sesuai jadwal dan format yang ditetapkan panitia.',
                ],
                'icon_class' => 'fa-file-signature',
                'tab_color' => '#5A827E',
                'gradient_start' => '#FFFFFF',
                'gradient_middle' => '#FAFFCA',
                'gradient_end' => '#B9D4AA',
                'is_active' => true,
            ],
            [
                'requirement_order' => 4,
                'label' => 'Rekam Jejak',
                'title' => 'Persyaratan 4 - Tridharma dan Kepemimpinan',
                'description' => 'Calon harus memiliki rekam jejak yang terukur pada tridharma perguruan tinggi serta pengalaman kepemimpinan.',
                'details' => [
                    'Memiliki portofolio tridharma: pendidikan, penelitian, dan pengabdian kepada masyarakat.',
                    'Memiliki pengalaman manajerial di lingkungan perguruan tinggi atau institusi sejenis.',
                    'Menyertakan bukti capaian kinerja akademik dan kelembagaan yang relevan.',
                ],
                'icon_class' => 'fa-chart-line',
                'tab_color' => '#84AE92',
                'gradient_start' => '#FFFFFF',
                'gradient_middle' => '#B9D4AA',
                'gradient_end' => '#84AE92',
                'is_active' => true,
            ],
            [
                'requirement_order' => 5,
                'label' => 'Naskah Program',
                'title' => 'Persyaratan 5 - Visi, Misi, dan Program Kerja',
                'description' => 'Calon menyampaikan naskah strategis sebagai dasar penilaian substansi kepemimpinan periode 2026-2030.',
                'details' => [
                    'Menyusun visi dan misi pengembangan Universitas Mulawarman secara terukur.',
                    'Menyusun program kerja prioritas yang realistis dan selaras dengan Renstra Unmul.',
                    'Siap memaparkan naskah program kerja pada tahap uji publik/senat sesuai jadwal.',
                ],
                'icon_class' => 'fa-bullseye',
                'tab_color' => '#5A827E',
                'gradient_start' => '#FFFFFF',
                'gradient_middle' => '#FAFFCA',
                'gradient_end' => '#B9D4AA',
                'is_active' => true,
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function iconOptions(): array
    {
        return [
            'fa-file-alt' => 'Dokumen',
            'fa-file-signature' => 'Dokumen Tanda Tangan',
            'fa-user-tie' => 'Kepegawaian',
            'fa-check-circle' => 'Verifikasi',
            'fa-shield-alt' => 'Integritas',
            'fa-chart-line' => 'Rekam Jejak',
            'fa-bullseye' => 'Visi Misi',
            'fa-tasks' => 'Persyaratan',
            'fa-clipboard-list' => 'Checklist',
            'fa-university' => 'Akademik',
            'fa-id-card' => 'Identitas',
            'fa-book' => 'Pedoman',
            'fa-balance-scale' => 'Kepatuhan',
            'fa-gavel' => 'Regulasi',
            'fa-award' => 'Prestasi',
            'fa-handshake' => 'Komitmen',
            'fa-users' => 'Sivitas',
            'fa-graduation-cap' => 'Pendidikan',
            'fa-lightbulb' => 'Inovasi',
            'fa-briefcase' => 'Manajerial',
        ];
    }

    public static function resolveIconClass(?string $iconClass): string
    {
        $iconClass = trim((string) $iconClass);
        $options = self::iconOptions();

        if ($iconClass !== '' && array_key_exists($iconClass, $options)) {
            return $iconClass;
        }

        return self::DEFAULT_ICON_CLASS;
    }
}
