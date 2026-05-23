# Gugugaga Wedding Organizer

> Website premium wedding organizer dengan admin dashboard — dibangun menggunakan Laravel 10, MySQL, dan Blade Template.

![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)

---

## ✨ Fitur

### Frontend (Website Publik)
- 🏠 **Home** — Hero animasi, statistik, layanan, gallery, testimoni, partner
- 👤 **Profil** — Tentang perusahaan & tim
- 👁️ **Visi & Misi** — Visi, misi, dan core values
- 💼 **Layanan** — Daftar paket dengan detail & harga
- 🤝 **Partner** — Kolaborasi vendor dengan filter kategori
- 🖼️ **Gallery** — Foto & video dengan lightbox + filter
- 📩 **Kontak** — Form inquiry lengkap

### Admin Dashboard
- 📊 Dashboard statistik & ringkasan
- ✏️ Kelola profil, visi & misi, tim
- 💼 CRUD layanan, partner, gallery, testimoni
- 📨 Baca & kelola pesan masuk
- ⚙️ Pengaturan SEO, warna brand, maintenance mode

---

## 🛠️ Persyaratan

Pastikan sudah terinstall:

- PHP >= 8.1
- Composer
- MySQL >= 8.0
- Git

---

## 🚀 Cara Menjalankan

### 1. Clone Repository

```bash
git clone https://github.com/dhimsky/WeddingOrganizer.git
cd gugugaga-wedding-organizer
```

### 2. Install Dependency

```bash
composer install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gugugaga_wedding
DB_USERNAME=root
DB_PASSWORD=password_kamu
```

Buat database:

```bash
mysql -u root -p -e "CREATE DATABASE gugugaga_wedding;"
```

### 5. Migrasi & Seed Database

```bash
php artisan migrate
php artisan db:seed
```

### 6. Storage Link

```bash
php artisan storage:link
```

### 7. Jalankan Server

```bash
php artisan serve
```

- 🌐 **Website** → http://127.0.0.1:8000
- 🔐 **Admin** → http://127.0.0.1:8000/admin/login

---

## 🔐 Akun Admin Default

| | |
|---|---|
| **Email** | `admin@gugugaga-wedding.com` |
| **Password** | `password` |

> ⚠️ Ganti password setelah login pertama kali!

---

## 📁 Struktur Folder

gugugaga-wedding-organizer/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Controller admin dashboard
│   │   └── Frontend/       # Controller halaman publik
│   └── Models/             # Eloquent models
├── database/
│   ├── migrations/         # Schema database
│   └── seeders/            # Data awal / demo
├── resources/views/
│   ├── layouts/            # Layout utama (frontend & admin)
│   ├── frontend/           # Halaman publik
│   └── admin/              # Halaman dashboard
└── routes/web.php          # Semua routing

---

## ⚙️ Konfigurasi Tambahan

### Upload File Besar (Video)

Edit `php.ini`:

```ini
upload_max_filesize = 100M
post_max_size = 100M
max_execution_time = 120
```

Jika menggunakan **Laravel Herd**:
1. Klik icon Herd di menu bar
2. Pilih **PHP → Edit configuration**
3. Ubah nilai di atas
4. Restart PHP dari menu Herd

### Ganti Warna Brand

Edit CSS variable di `resources/views/layouts/frontend.blade.php`:

```css
:root {
    --gold: #C9A96E;
}
```

Atau lewat **Admin → Pengaturan → Warna Utama**.

---

## 🔄 Setelah Pull Perubahan

```bash
git pull origin main
composer install
php artisan migrate
php artisan storage:link
```

---

## 🐛 Troubleshooting

**Error: `Could not open input file: artisan`**
```bash
cd gugugaga-wedding-organizer
php artisan serve
```

**Error: `Access denied for user root`**
```bash
mysql -u root -p -e "CREATE DATABASE gugugaga_wedding;"
```

**Gambar tidak tampil setelah upload**
```bash
php artisan storage:link
```

**Error: `PostTooLargeException` saat upload video**

Naikkan nilai `upload_max_filesize` dan `post_max_size` di `php.ini`.

**Halaman 404**
```bash
php artisan route:clear
php artisan cache:clear
```

---

## 🛠️ Tech Stack

| Komponen | Teknologi |
|---|---|
| Framework | Laravel 10 |
| Language | PHP 8.1+ |
| Database | MySQL 8 |
| Template | Laravel Blade |
| CSS | Vanilla CSS |
| Font | Cormorant Garamond + Jost |
| Icons | Font Awesome 6 |
| Auth | Laravel Built-in |

---

*Gugugaga Wedding Organizer — Crafted with ♥ Love*