<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RectorCandidate extends Model
{
    public const STATUS_BALON = 'balon';
    public const STATUS_CALON = 'calon';

    protected $fillable = [
        'candidate_order',
        'status',
        'name',
        'slug',
        'role_summary',
        'faculty_unit',
        'study_program',
        'academic_position',
        'current_position',
        'latest_education',
        'nip',
        'birth_place',
        'birth_date',
        'short_profile',
        'vision',
        'missions',
        'photo_path',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'missions' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('candidate_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @return array<string, string>
     */
    public static function statusOptions(): array
    {
        return [
            self::STATUS_BALON => 'Balon',
            self::STATUS_CALON => 'Calon',
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function defaultSeedData(): array
    {
        return [
            [
                'candidate_order' => 1,
                'status' => self::STATUS_CALON,
                'name' => 'Prof. Dr. Ir. Ahmad Prasetyo, M.Sc.',
                'slug' => 'ahmad-prasetyo',
                'role_summary' => 'Guru Besar Teknik Industri / Dekan Fakultas Teknik',
                'faculty_unit' => 'Fakultas Teknik',
                'study_program' => 'Teknik Industri',
                'academic_position' => 'Guru Besar',
                'current_position' => 'Dekan Fakultas Teknik',
                'latest_education' => 'Doktor Manajemen Teknologi Pendidikan Tinggi',
                'nip' => '19690415 199403 1 002',
                'birth_place' => 'Makassar',
                'birth_date' => '1969-04-15',
                'short_profile' => 'Akademisi senior dengan pengalaman panjang dalam pengembangan pendidikan tinggi, penguatan riset terapan, dan tata kelola fakultas yang akuntabel.',
                'vision' => 'Mewujudkan universitas yang unggul, berintegritas, inklusif, dan berdaya saing global melalui tata kelola akademik yang kolaboratif dan berkelanjutan.',
                'missions' => [
                    [
                        'title' => 'Penguatan Mutu Akademik',
                        'description' => 'Meningkatkan kualitas pembelajaran, akreditasi program studi, dan relevansi kurikulum berbasis kebutuhan masyarakat.',
                    ],
                    [
                        'title' => 'Peningkatan Riset dan Inovasi',
                        'description' => 'Memperkuat ekosistem riset unggulan melalui kolaborasi lintas disiplin dan hilirisasi inovasi.',
                    ],
                    [
                        'title' => 'Tata Kelola Transparan dan Akuntabel',
                        'description' => 'Membangun tata kelola berbasis data dan partisipatif di seluruh unit kerja universitas.',
                    ],
                ],
                'photo_path' => 'template/img/inner-pages/team/1.png',
                'is_active' => true,
            ],
            [
                'candidate_order' => 2,
                'status' => self::STATUS_CALON,
                'name' => 'Prof. Dr. Rina Kartikasari, M.Hum.',
                'slug' => 'rina-kartikasari',
                'role_summary' => 'Guru Besar Linguistik / Wakil Rektor Bidang Akademik',
                'faculty_unit' => 'Fakultas Ilmu Budaya',
                'study_program' => 'Linguistik',
                'academic_position' => 'Guru Besar',
                'current_position' => 'Wakil Rektor Bidang Akademik',
                'latest_education' => 'Doktor Ilmu Humaniora',
                'nip' => '19720308 199803 2 001',
                'birth_place' => 'Samarinda',
                'birth_date' => '1972-03-08',
                'short_profile' => 'Penggerak inovasi pembelajaran dan tata kelola akademik lintas fakultas dengan fokus penguatan mutu pendidikan.',
                'vision' => 'Universitas adaptif, inklusif, dan unggul yang mendorong transformasi akademik berkelanjutan.',
                'missions' => [
                    [
                        'title' => 'Digitalisasi Akademik',
                        'description' => 'Mempercepat layanan akademik berbasis teknologi untuk efektivitas dan transparansi.',
                    ],
                    [
                        'title' => 'Penguatan SDM Dosen',
                        'description' => 'Mendorong peningkatan kompetensi dosen melalui pelatihan, sertifikasi, dan jejaring kolaborasi.',
                    ],
                ],
                'photo_path' => 'template/img/inner-pages/team/2.png',
                'is_active' => true,
            ],
            [
                'candidate_order' => 3,
                'status' => self::STATUS_CALON,
                'name' => 'Prof. Dr. H. Budi Santoso, M.Si.',
                'slug' => 'budi-santoso',
                'role_summary' => 'Guru Besar Biologi / Ketua Senat Fakultas',
                'faculty_unit' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam',
                'study_program' => 'Biologi',
                'academic_position' => 'Guru Besar',
                'current_position' => 'Ketua Senat Fakultas',
                'latest_education' => 'Doktor Biologi Lingkungan',
                'nip' => '19700112 199602 1 005',
                'birth_place' => 'Balikpapan',
                'birth_date' => '1970-01-12',
                'short_profile' => 'Aktif mengembangkan budaya riset, tata kelola senat, dan kolaborasi ilmiah berbasis kebutuhan daerah.',
                'vision' => 'Kepemimpinan berbasis integritas ilmiah untuk membangun universitas riset yang berdampak.',
                'missions' => [
                    [
                        'title' => 'Budaya Riset',
                        'description' => 'Meningkatkan produktivitas riset dan publikasi internasional bereputasi.',
                    ],
                    [
                        'title' => 'Kolaborasi Strategis',
                        'description' => 'Memperluas kolaborasi dengan pemerintah, industri, dan komunitas internasional.',
                    ],
                ],
                'photo_path' => 'template/img/inner-pages/team/3.png',
                'is_active' => true,
            ],
            [
                'candidate_order' => 4,
                'status' => self::STATUS_CALON,
                'name' => 'Prof. Dr. Dewi Lestari, S.E., M.M.',
                'slug' => 'dewi-lestari',
                'role_summary' => 'Guru Besar Manajemen / Dekan Fakultas Ekonomi dan Bisnis',
                'faculty_unit' => 'Fakultas Ekonomi dan Bisnis',
                'study_program' => 'Manajemen',
                'academic_position' => 'Guru Besar',
                'current_position' => 'Dekan Fakultas Ekonomi dan Bisnis',
                'latest_education' => 'Doktor Manajemen',
                'nip' => '19740822 200012 2 009',
                'birth_place' => 'Bontang',
                'birth_date' => '1974-08-22',
                'short_profile' => 'Berpengalaman mengelola transformasi organisasi, tata kelola keuangan, dan kemitraan lintas sektor.',
                'vision' => 'Universitas modern yang agile, transparan, dan berdaya saing global.',
                'missions' => [
                    [
                        'title' => 'Good University Governance',
                        'description' => 'Menguatkan sistem pengambilan keputusan berbasis data dan indikator kinerja yang terukur.',
                    ],
                    [
                        'title' => 'Kemitraan Produktif',
                        'description' => 'Meningkatkan program kolaborasi dengan mitra strategis untuk dukungan akademik dan pendanaan riset.',
                    ],
                ],
                'photo_path' => 'template/img/inner-pages/team/4.png',
                'is_active' => true,
            ],
            [
                'candidate_order' => 5,
                'status' => self::STATUS_CALON,
                'name' => 'Prof. Dr. Ir. Muhammad Arifin, M.T.',
                'slug' => 'muhammad-arifin',
                'role_summary' => 'Direktur Sekolah Pascasarjana / Guru Besar Teknik Sipil',
                'faculty_unit' => 'Sekolah Pascasarjana',
                'study_program' => 'Teknik Sipil',
                'academic_position' => 'Guru Besar',
                'current_position' => 'Direktur Sekolah Pascasarjana',
                'latest_education' => 'Doktor Teknik Sipil',
                'nip' => '19681103 199501 1 007',
                'birth_place' => 'Tarakan',
                'birth_date' => '1968-11-03',
                'short_profile' => 'Memimpin penguatan kualitas pascasarjana, sinergi riset terapan, dan pengembangan inovasi infrastruktur berkelanjutan.',
                'vision' => 'Mendorong universitas sebagai pusat unggulan riset terapan dan inovasi untuk pembangunan berkelanjutan.',
                'missions' => [
                    [
                        'title' => 'Akselerasi Program Pascasarjana',
                        'description' => 'Meningkatkan kualitas program pascasarjana dan jejaring akademik internasional.',
                    ],
                    [
                        'title' => 'Inovasi Infrastruktur Berkelanjutan',
                        'description' => 'Mendorong riset terapan berbasis kebutuhan pembangunan daerah dan nasional.',
                    ],
                ],
                'photo_path' => 'template/img/inner-pages/team/1.png',
                'is_active' => true,
            ],
        ];
    }
}
