<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RectorRequirement extends Model
{
    protected $fillable = [
        'requirement_order',
        'label',
        'title',
        'description',
        'details',
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
                'label' => 'Kartu Identitas',
                'title' => 'Persyaratan 1 - Kartu Identitas',
                'description' => 'Siapkan identitas utama yang masih berlaku agar proses verifikasi berjalan cepat dan data pendaftar sesuai.',
                'details' => [
                    'Unggah KTP, KK, atau identitas lain yang masih aktif.',
                    'Pastikan nama, tanggal lahir, dan nomor identitas terlihat jelas.',
                    'Data identitas harus sama dengan data pada formulir pendaftaran.',
                ],
                'tab_color' => '#f0b221',
                'gradient_start' => '#d39311',
                'gradient_middle' => '#f0b221',
                'gradient_end' => '#d78712',
                'is_active' => true,
            ],
            [
                'requirement_order' => 2,
                'label' => 'Dokumen Pendukung',
                'title' => 'Persyaratan 2 - Dokumen Pendukung',
                'description' => 'Lengkapi dokumen tambahan supaya berkas tidak tertunda saat proses pemeriksaan administrasi.',
                'details' => [
                    'Siapkan pas foto, surat keterangan, atau formulir yang diminta.',
                    'Gunakan format file sesuai ketentuan, misalnya PDF atau JPG.',
                    'Gabungkan dokumen bila diminta agar lebih mudah saat diunggah.',
                ],
                'tab_color' => '#f15c63',
                'gradient_start' => '#d94d54',
                'gradient_middle' => '#f15c63',
                'gradient_end' => '#da4e55',
                'is_active' => true,
            ],
            [
                'requirement_order' => 3,
                'label' => 'Data Kontak Aktif',
                'title' => 'Persyaratan 3 - Data Kontak Aktif',
                'description' => 'Informasi kontak harus aktif karena seluruh pemberitahuan lanjutan akan dikirim melalui data ini.',
                'details' => [
                    'Masukkan nomor telepon aktif yang dapat dihubungi.',
                    'Gunakan email yang rutin dibuka untuk menerima notifikasi.',
                    'Periksa ulang penulisan alamat email dan nomor telepon.',
                ],
                'tab_color' => '#8ac667',
                'gradient_start' => '#70ae52',
                'gradient_middle' => '#8ac667',
                'gradient_end' => '#6da94f',
                'is_active' => true,
            ],
            [
                'requirement_order' => 4,
                'label' => 'Bukti Pembayaran',
                'title' => 'Persyaratan 4 - Bukti Pembayaran',
                'description' => 'Unggah bukti pembayaran sesuai nominal dan ketentuan agar verifikasi dapat segera diproses.',
                'details' => [
                    'Pastikan nominal transfer sesuai tagihan yang tercantum.',
                    'Unggah file yang jelas dan tidak buram.',
                    'Simpan bukti pembayaran sampai proses selesai diverifikasi.',
                ],
                'tab_color' => '#6170e6',
                'gradient_start' => '#4e5ad4',
                'gradient_middle' => '#6170e6',
                'gradient_end' => '#4a58d0',
                'is_active' => true,
            ],
            [
                'requirement_order' => 5,
                'label' => 'Konfirmasi Akhir',
                'title' => 'Persyaratan 5 - Konfirmasi Akhir',
                'description' => 'Tahap terakhir berisi pengecekan ulang seluruh informasi dan persetujuan bahwa data yang dikirim sudah benar.',
                'details' => [
                    'Periksa kembali seluruh data sebelum dikirim.',
                    'Centang persetujuan syarat dan ketentuan.',
                    'Simpan bukti pendaftaran setelah proses selesai.',
                ],
                'tab_color' => '#36b6a5',
                'gradient_start' => '#299a8d',
                'gradient_middle' => '#36b6a5',
                'gradient_end' => '#268d83',
                'is_active' => true,
            ],
        ];
    }
}
