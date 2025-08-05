
<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<h2 align="center">Kuliner Khas Bali - Laravel Web App</h2>

---

## 📦 Fitur Utama
- Menampilkan daftar menu kuliner Bali
- Pemesanan makanan online
- Rating makanan
- Download struk pesanan
- Integrasi Midtrans QRIS
- Frontend modern dengan Tailwind CSS + Vite

---

## 🚀 Cara Menjalankan Project Ini

### 1. Clone Repository
```bash
git clone https://github.com/kamu/nama-repo.git
cd nama-repo
```

### 2. Install Laravel dan Setup Environment
```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Import Database
1. Buat database baru bernama `dbbalinew` di phpMyAdmin
2. Import file `dbbalinew.sql` ke dalam database tersebut

### 4. Konfigurasi `.env`
```env
DB_DATABASE=dbbalinew
<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<h2 align="center">Kuliner Khas Bali - Laravel Web App</h2>

---

## 📦 Fitur Utama
- Menampilkan daftar menu kuliner Bali
- Pemesanan makanan online
- Rating makanan
- Download struk pesanan (PDF)
- Integrasi pembayaran Midtrans (QRIS)
- Tampilan modern menggunakan Tailwind CSS + Vite

---

## 🚀 Cara Menjalankan Project Ini

### 1. Clone Repository
```bash
git clone https://github.com/kamu/nama-repo.git
cd nama-repo
```

### 2. Install Laravel dan Setup Environment
```bash
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Import Database
1. Buat database baru bernama `dbbalinew` di phpMyAdmin
2. Import file `database/dbkulinerkhasbali.sql` ke dalam database tersebut

### 4. Konfigurasi `.env`
```env
DB_DATABASE=dbbalinew
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Server Laravel
```bash
php artisan serve
```
Buka di browser: [http://localhost:8000](http://localhost:8000)

---

## 🌐 Jalankan Frontend (Vite + Tailwind CSS)

### 6. Install & Jalankan Vite
```bash
npm install
npm run dev
```

Untuk build versi production:
```bash
npm run build
```

> Pastikan sudah menginstall Node.js & NPM: https://nodejs.org

---

## 🎨 Tailwind CSS

Project ini menggunakan [Tailwind CSS](https://tailwindcss.com/) dengan konfigurasi di file:

```js
// tailwind.config.js
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

---

## 👨‍💻 Developer
- 3312411055 - Juann Rizki Ramadhan  
- 3312411053 - Muhammad Abdul Ghofur  
- 3312411046 - Riansyah  
- 3312411057 - Nafisah Nurul Wahida  
> Project PBL - IF239 - Politeknik Negeri Batam

---

## ⚠️ Catatan
- Tidak perlu menjalankan `php artisan migrate` karena database sudah tersedia dalam file `.sql`
- Jalankan `php artisan storage:link` agar gambar bisa muncul dengan benar di browser

---

## 📄 Lisensi
Proyek ini dibangun menggunakan Laravel dan berlisensi MIT.

DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan Server Laravel
```bash
php artisan serve
```
Akses: [http://localhost:8000](http://localhost:8000)

---

## 🌐 Jalankan Frontend (Vite + Tailwind CSS)

### 6. Install & Jalankan Vite
```bash
npm install
npm run dev
```

Untuk build versi production:
```bash
npm run build
```

> Pastikan sudah menginstall Node.js & NPM: https://nodejs.org

---

## 🎨 Tailwind CSS

Project ini menggunakan [Tailwind CSS](https://tailwindcss.com/) dan konfigurasi default di file:

```js
// tailwind.config.js
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

---

## 👨‍💻 Developer
-3312411055 Juann Rizki ramadhan
3312411053 Muhammad Abdul Ghofur
3312411046 Riansyah
3312411057 Nafisah Nurul Wahida (PBL-IF239-POLITEKNIK NEGERI BATAM)

---

## ⚠️ Catatan
- Tidak perlu menjalankan `php artisan migrate`, karena database sudah tersedia via file `.sql`
- Gunakan `php artisan storage:link` jika gambar tidak muncul

---

## 📄 License
Proyek ini dibangun dengan Laravel

## Link Vieo
Vidio Demo : https://youtu.be/hdlCUPxFJWQ?si=bmv3_BbnGHQSbUL7
Vidio Presentasi:  https://youtu.be/pJ2ZUtEM5A4
