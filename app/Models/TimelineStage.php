<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineStage extends Model
{
    public const STATUS_UPCOMING = 'upcoming';
    public const STATUS_ONGOING = 'ongoing';
    public const STATUS_DONE = 'done';

    protected $fillable = [
        'stage_order',
        'date_label',
        'title',
        'description',
        'status',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('stage_order');
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
                'stage_order' => 1,
                'date_label' => 'Juni 2026',
                'title' => 'Sosialisasi dan Penjaringan',
                'description' => 'Pengumuman resmi tahapan Pilrek dan pembukaan informasi untuk sivitas akademika.',
                'status' => self::STATUS_DONE,
                'is_active' => true,
            ],
            [
                'stage_order' => 2,
                'date_label' => 'Juli 2026',
                'title' => 'Pendaftaran Bakal Calon',
                'description' => 'Pendaftaran bakal calon rektor serta verifikasi administrasi dan persyaratan.',
                'status' => self::STATUS_DONE,
                'is_active' => true,
            ],
            [
                'stage_order' => 3,
                'date_label' => 'Agustus 2026',
                'title' => 'Pemaparan Visi dan Misi',
                'description' => 'Penyampaian program kerja calon rektor di hadapan senat dan perwakilan pemangku kepentingan.',
                'status' => self::STATUS_ONGOING,
                'is_active' => true,
            ],
            [
                'stage_order' => 4,
                'date_label' => 'September 2026',
                'title' => 'Pemilihan dan Penetapan',
                'description' => 'Pemungutan suara, penetapan hasil Pilrek, dan proses administrasi pelantikan.',
                'status' => self::STATUS_UPCOMING,
                'is_active' => true,
            ],
            [
                'stage_order' => 5,
                'date_label' => 'Oktober 2026',
                'title' => 'Penetapan dan Pengajuan Hasil',
                'description' => 'Dokumen hasil pemilihan disampaikan sesuai mekanisme tata kelola universitas.',
                'status' => self::STATUS_UPCOMING,
                'is_active' => true,
            ],
            [
                'stage_order' => 6,
                'date_label' => 'November 2026',
                'title' => 'Persiapan Pelantikan',
                'description' => 'Tahap akhir administrasi dan persiapan transisi kepemimpinan periode 2026-2030.',
                'status' => self::STATUS_UPCOMING,
                'is_active' => true,
            ],
            [
                'stage_order' => 7,
                'date_label' => 'Desember 2026',
                'title' => 'Monitoring Transisi Kepemimpinan',
                'description' => 'Pemantauan kelancaran masa transisi agar agenda strategis universitas tetap berjalan.',
                'status' => self::STATUS_UPCOMING,
                'is_active' => true,
            ],
            [
                'stage_order' => 8,
                'date_label' => 'Januari 2027',
                'title' => 'Sinkronisasi Program Kerja',
                'description' => 'Penajaman target awal periode kepemimpinan berdasarkan masukan sivitas akademika.',
                'status' => self::STATUS_UPCOMING,
                'is_active' => true,
            ],
            [
                'stage_order' => 9,
                'date_label' => 'Februari 2027',
                'title' => 'Publikasi Laporan Tahap Akhir',
                'description' => 'Laporan akhir proses Pilrek dipublikasikan sebagai bentuk transparansi tata kelola.',
                'status' => self::STATUS_UPCOMING,
                'is_active' => true,
            ],
            [
                'stage_order' => 10,
                'date_label' => 'Maret 2027',
                'title' => 'Evaluasi Menyeluruh Pilrek',
                'description' => 'Evaluasi proses untuk peningkatan mekanisme pemilihan rektor pada periode berikutnya.',
                'status' => self::STATUS_UPCOMING,
                'is_active' => true,
            ],
        ];
    }
}
