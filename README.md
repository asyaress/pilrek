# Portal Pilrek Unmul 2026-2030

Website publik + CMS admin untuk Pemilihan Rektor Universitas Mulawarman periode 2026-2030.

## Ringkasan Fitur

### Website Publik
- Beranda (`/`) dengan section:
  - timeline roadmap
  - bakal calon rektor (balon)
  - calon rektor
  - rektor terpilih
  - persyaratan calon rektor (stacked card)
  - berita terbaru
- Halaman timeline lengkap (`/timeline`)
- Halaman Balon (`/balon`) + detail (`/balon/{slug}`)
- Halaman Calon Rektor (`/calon-rektor`) + detail (`/calon-rektor/{slug}`)
- Halaman Persyaratan (`/persyaratan-calon-rektor`)
- Halaman Pendaftaran (`/pendaftaran`)
- Halaman Unduhan (`/unduhan`)
- Halaman Berita (`/berita`, `/berita/{slug}`)

### CMS Admin
- Login admin berbasis tabel `users` bawaan Laravel
- Role: `super_admin`, `editor`
- Kelola konten:
  - Timeline
  - Balon/Calon Rektor (termasuk promote/demote)
  - Persyaratan Calon Rektor
  - Berita (Summernote + media library)
  - Unduhan dokumen
  - Pengaturan situs (site info, logo, favicon, logo institusi, rektor terpilih)
  - Pesan masuk
  - Activity log

## Teknologi
- PHP `^8.2`
- Laravel `^12`
- MySQL
- Blade template
- AdminLTE 3.1
- Vite

## Persiapan Server Lokal
Pastikan sudah terpasang:
- PHP 8.2+
- Composer
- Node.js 20+ dan npm
- MySQL 8+

## Setup Proyek (MySQL)

### 1) Clone + install dependency
```bash
git clone <url-repo> pilrek
cd pilrek
composer install
npm install
```

### 2) Siapkan file environment
Linux/macOS:
```bash
cp .env.example .env
```
Windows PowerShell:
```powershell
Copy-Item .env.example .env
```

### 3) Atur koneksi database di `.env`
Contoh:
```env
APP_NAME="Portal Pilrek Unmul"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pilrek
DB_USERNAME=root
DB_PASSWORD=
```

Buat databasenya di MySQL (contoh):
```sql
CREATE DATABASE pilrek CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4) Generate key + migrasi + seeder
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5) Wajib buat storage symlink
```bash
php artisan storage:link
```

### 6) Jalankan aplikasi
Terminal 1:
```bash
php artisan serve
```
Terminal 2:
```bash
npm run dev
```

Alternatif satu perintah (opsional):
```bash
composer run dev
```

## Akun Default Seeder
- Super Admin
  - Email: `admin@gmail.com`
  - Password: `password`
- Editor
  - Email: `editor@gmail.com`
  - Password: `password`

## URL Penting
- Publik: `http://127.0.0.1:8000`
- Login Admin: `http://127.0.0.1:8000/admin/login`
- Dashboard Admin: `http://127.0.0.1:8000/admin`

## Catatan Alur Data Penting

### 1) Alur Balon -> Calon
- Data kandidat hanya satu sumber (`rector_candidates`), dibedakan oleh status.
- Saat kandidat dipromosikan dari balon ke calon:
  - tetap muncul di halaman Balon (riwayat tahap awal)
  - otomatis muncul di halaman Calon tanpa input ulang

### 2) Rektor Terpilih di Home
- Dipilih dari Admin -> Pengaturan Situs (`/admin/settings`)
- Opsi hanya kandidat berstatus `calon`
- Jika sudah dipilih, section "Rektor Terpilih" otomatis tampil di Home

### 3) Upload File Seluruh Modul Admin
Semua upload tersimpan di `storage/app/public/...` lalu diakses lewat `/storage/...`:
- Foto kandidat: `storage/app/public/candidates`
- Gambar berita/editor: `storage/app/public/news`
- Dokumen unduhan: `storage/app/public/downloads`
- Logo/favicon/logo institusi: `storage/app/public/settings`

Karena itu `php artisan storage:link` wajib dijalankan.

## Struktur Utama
- `routes/web.php` -> semua route publik + admin
- `app/Http/Controllers/PageController.php` -> logika halaman publik
- `app/Http/Controllers/Admin/*` -> CRUD CMS admin
- `resources/views/index.blade.php` -> home
- `resources/views/pages/*` -> halaman publik
- `resources/views/pages/admin/*` -> halaman admin
- `resources/views/partials/navbar.blade.php` -> navbar + logo institusi
- `resources/views/partials/footer.blade.php` -> footer

## Perintah Maintenance
Clear cache saat ada perubahan env/config/view:
```bash
php artisan optimize:clear
```

Jalankan test:
```bash
php artisan test
```

## Troubleshooting Singkat
- Gambar/file upload tidak tampil:
  - pastikan `php artisan storage:link` sudah sukses
  - cek path file tersimpan di kolom database menggunakan prefix `storage/...`
- Error koneksi DB:
  - cek `.env` MySQL
  - pastikan service MySQL aktif
  - pastikan database sudah dibuat
- Seeder ulang data awal:
```bash
php artisan migrate:fresh --seed
```

## Lisensi
Proyek internal Portal Pilrek Unmul.
