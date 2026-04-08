<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image_path',
        'tags',
        'status',
        'is_featured',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
            ->whereNotNull('published_at');
    }

    public function scopeOrdered($query)
    {
        return $query->orderByDesc('published_at')->orderByDesc('id');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function defaultSeedData(): array
    {
        return [
            [
                'title' => 'Pengumuman Tahapan Penjaringan Bakal Calon Rektor Periode 2026-2030',
                'slug' => 'pengumuman-tahapan-penjaringan',
                'excerpt' => 'Panitia Pilrek Unmul resmi mengumumkan tahapan penjaringan bakal calon rektor periode 2026-2030.',
                'content' => 'Panitia Pemilihan Rektor Universitas Mulawarman mengumumkan tahapan penjaringan bakal calon rektor periode 2026-2030. Informasi ini menjadi acuan seluruh sivitas akademika dalam mengikuti proses seleksi secara transparan dan akuntabel.',
                'cover_image_path' => 'template/img/inner-pages/blog/1.png',
                'tags' => ['pengumuman', 'tahapan', 'resmi'],
                'status' => self::STATUS_PUBLISHED,
                'is_featured' => true,
                'published_at' => '2026-04-03 08:00:00',
            ],
            [
                'title' => 'Sosialisasi Pemilihan Rektor Bersama Senat Akademik dan Sivitas Kampus',
                'slug' => 'sosialisasi-pilrek-senat-akademik',
                'excerpt' => 'Kegiatan sosialisasi dilakukan untuk memastikan seluruh sivitas memahami jadwal dan mekanisme Pilrek.',
                'content' => 'Sosialisasi tahapan pemilihan rektor melibatkan senat akademik dan perwakilan sivitas kampus. Kegiatan ini menekankan prinsip partisipatif, keterbukaan informasi, dan kepatuhan pada regulasi universitas.',
                'cover_image_path' => 'template/img/inner-pages/blog/2.png',
                'tags' => ['sosialisasi', 'senat', 'kampus'],
                'status' => self::STATUS_PUBLISHED,
                'is_featured' => true,
                'published_at' => '2026-04-05 09:00:00',
            ],
            [
                'title' => 'Rapat Koordinasi Panitia Pemilihan Rektor Membahas Agenda Verifikasi Administrasi',
                'slug' => 'rapat-koordinasi-panitia-pilrek',
                'excerpt' => 'Panitia melakukan sinkronisasi jadwal verifikasi administratif bakal calon rektor.',
                'content' => 'Rapat koordinasi panitia menegaskan kesiapan tim verifikasi dalam memproses berkas calon rektor sesuai standar tata kelola universitas. Setiap dokumen akan ditinjau secara cermat dan terukur.',
                'cover_image_path' => 'template/img/inner-pages/blog/3.png',
                'tags' => ['rapat', 'panitia', 'verifikasi'],
                'status' => self::STATUS_PUBLISHED,
                'is_featured' => false,
                'published_at' => '2026-04-07 10:00:00',
            ],
            [
                'title' => 'Penetapan Daftar Calon Sementara Pemilihan Rektor Tahun 2026',
                'slug' => 'penetapan-daftar-calon-sementara',
                'excerpt' => 'Daftar calon sementara ditetapkan setelah proses verifikasi administrasi tahap awal.',
                'content' => 'Setelah proses verifikasi administrasi tahap awal, panitia menetapkan daftar calon sementara. Publikasi ini disampaikan untuk memastikan transparansi proses kepada masyarakat kampus.',
                'cover_image_path' => 'template/img/inner-pages/blog/4.png',
                'tags' => ['penetapan', 'calon', 'pengumuman'],
                'status' => self::STATUS_PUBLISHED,
                'is_featured' => false,
                'published_at' => '2026-04-09 08:30:00',
            ],
            [
                'title' => 'Kegiatan Dialog Terbuka Kandidat Bersama Dosen, Mahasiswa, dan Tenaga Kependidikan',
                'slug' => 'kegiatan-dialog-terbuka-kandidat',
                'excerpt' => 'Dialog terbuka menjadi ruang penyampaian gagasan awal kandidat kepada sivitas akademika.',
                'content' => 'Kegiatan dialog terbuka menghadirkan calon rektor bersama dosen, mahasiswa, dan tenaga kependidikan. Forum ini menjadi sarana membangun komunikasi program yang inklusif dan konstruktif.',
                'cover_image_path' => 'template/img/inner-pages/blog/5.png',
                'tags' => ['kegiatan', 'dialog', 'kandidat'],
                'status' => self::STATUS_PUBLISHED,
                'is_featured' => false,
                'published_at' => '2026-04-11 11:00:00',
            ],
            [
                'title' => 'Publikasi Jadwal Penyampaian Visi dan Misi Calon Rektor Secara Terbuka',
                'slug' => 'publikasi-jadwal-penyampaian-visi-misi',
                'excerpt' => 'Jadwal pemaparan visi misi diumumkan secara terbuka untuk seluruh warga kampus.',
                'content' => 'Panitia mengumumkan jadwal penyampaian visi dan misi calon rektor secara terbuka. Agenda ini diharapkan mendorong partisipasi aktif sivitas akademika dalam menilai arah kepemimpinan kandidat.',
                'cover_image_path' => 'template/img/inner-pages/blog/6.png',
                'tags' => ['jadwal', 'visi-misi', 'publikasi'],
                'status' => self::STATUS_PUBLISHED,
                'is_featured' => false,
                'published_at' => '2026-04-13 08:00:00',
            ],
        ];
    }
}
