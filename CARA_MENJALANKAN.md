# 🚀 Cara Menjalankan Project Ngopikel

Panduan lengkap untuk menjalankan Coffee Shop Discovery Platform di komputer Anda.

---

## ✅ Prerequisites (Yang Sudah Terinstall)

Berdasarkan project Anda, ini yang sudah terinstall:
- ✅ **PHP 8.3+** 
- ✅ **Composer**
- ✅ **Node.js & npm**
- ✅ **Laravel Herd** (RECOMMENDED!)
- ✅ **Git**

---

## 🎯 Metode 1: Menggunakan Laravel Herd (PALING MUDAH) ⭐

### Langkah 1: Pastikan Herd Berjalan

1. **Buka Laravel Herd** dari taskbar/system tray
2. Pastikan status **Running** (hijau)
3. Jika belum running, klik **Start**

### Langkah 2: Buka Project di Browser

Langsung buka browser dan akses:
```
http://coffee-shop-discovery-platform.test
```

**SELESAI!** 🎉

### Troubleshooting Herd:

**Jika tidak bisa akses:**
```powershell
# 1. Restart Herd
# Tutup Herd dari system tray → Start lagi

# 2. Atau restart Herd services
# Klik kanan Herd icon → Restart Services
```

**Jika domain .test tidak terdeteksi:**
```powershell
# 1. Check Herd settings
# Buka Herd → Settings → Check site directory

# 2. Re-link project
cd "d:\COFFEE SHOP DISCOVERY PLATFORM"
herd link
```

---

## 🎯 Metode 2: Menggunakan PHP Artisan Serve (Alternatif)

### Jika Herd Bermasalah atau Ingin Pakai Port Berbeda

### Langkah 1: Buka Terminal

Buka PowerShell atau Command Prompt di folder project:
```powershell
cd "d:\COFFEE SHOP DISCOVERY PLATFORM"
```

### Langkah 2: Jalankan Laravel Server

```powershell
php artisan serve
```

**Output yang muncul:**
```
INFO  Server running on [http://127.0.0.1:8000]
Press Ctrl+C to stop the server
```

### Langkah 3: Buka di Browser

Buka browser dan akses:
```
http://localhost:8000
```

### Menggunakan Port Berbeda:

Jika port 8000 sudah dipakai:
```powershell
php artisan serve --port=9000
```

Akses di:
```
http://localhost:9000
```

---

## 📋 Checklist Sebelum Menjalankan

Pastikan semua ini sudah dilakukan:

### ✅ 1. Database Sudah Ada
```powershell
# Check apakah database.sqlite ada
dir database\database.sqlite
```

**Jika tidak ada, buat dengan:**
```powershell
type nul > database\database.sqlite
php artisan migrate
php artisan db:seed
```

### ✅ 2. Dependencies Sudah Terinstall
```powershell
# Check node_modules & vendor
dir node_modules
dir vendor
```

**Jika tidak ada, install:**
```powershell
composer install
npm install
```

### ✅ 3. Assets Sudah Di-build
```powershell
# Check public/build folder
dir public\build
```

**Jika tidak ada, build:**
```powershell
npm run build
```

### ✅ 4. File .env Sudah Ada
```powershell
# Check .env
dir .env
```

**Jika tidak ada:**
```powershell
copy .env.example .env
php artisan key:generate
```

---

## 🔄 Langkah-Langkah Lengkap dari Awal

Jika ini pertama kali menjalankan atau ada error:

### 1. Clone/Pull Repository (Jika Belum)
```powershell
cd d:\
git clone https://github.com/irfanzakariyah-pemula/coffee-shop-discovery-platform.git
cd "COFFEE SHOP DISCOVERY PLATFORM"
```

### 2. Install Dependencies
```powershell
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Setup Environment
```powershell
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Setup Database
```powershell
# Create SQLite database
type nul > database\database.sqlite

# Run migrations
php artisan migrate

# Seed data (10 coffee shops)
php artisan db:seed
```

### 5. Build Assets
```powershell
npm run build
```

### 6. Run Server
```powershell
# PILIHAN A: Gunakan Herd (recommended)
# Buka browser: http://coffee-shop-discovery-platform.test

# PILIHAN B: Gunakan Artisan Serve
php artisan serve
# Buka browser: http://localhost:8000
```

---

## 🎮 Demo Accounts

Setelah seeding, gunakan akun ini:

### Admin Account
- **Email**: `admin@ngopikel.com`
- **Password**: `password`
- **Akses**: Full admin dashboard

### User Accounts
- **Email**: `john@example.com` atau `jane@example.com`
- **Password**: `password`
- **Akses**: User features (review, favorite)

---

## 🔧 Commands Yang Berguna

### Development Commands:
```powershell
# Run tests
php artisan test

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Or clear all
php artisan optimize:clear

# Build assets (development dengan hot reload)
npm run dev

# Build assets (production)
npm run build

# Clear app cache (custom command)
php artisan app:clear-cache --all
```

### Database Commands:
```powershell
# Reset database (fresh migrate + seed)
php artisan migrate:fresh --seed

# Run only migrations
php artisan migrate

# Run only seeders
php artisan db:seed

# Rollback migrations
php artisan migrate:rollback
```

---

## 🐛 Troubleshooting

### Error: "Port already in use"
```powershell
# Gunakan port berbeda
php artisan serve --port=9000
```

### Error: "Database not found"
```powershell
# Buat ulang database
del database\database.sqlite
type nul > database\database.sqlite
php artisan migrate --seed
```

### Error: "Class not found"
```powershell
# Clear & regenerate autoload
composer dump-autoload
php artisan optimize:clear
```

### Error: "npm ERR!"
```powershell
# Delete dan reinstall node_modules
rmdir /s /q node_modules
del package-lock.json
npm install
```

### Error: "419 Page Expired"
```powershell
# Clear config cache
php artisan config:clear
```

### Halaman Blank atau Error 500
```powershell
# Check log
type storage\logs\laravel.log

# Clear all cache
php artisan optimize:clear
```

### Assets Tidak Muncul (CSS/JS)
```powershell
# Rebuild assets
npm run build

# Atau untuk development
npm run dev
```

---

## 📱 Mengakses Dari Device Lain (HP/Tablet)

### Jika Menggunakan Artisan Serve:

1. **Cari IP komputer Anda:**
```powershell
ipconfig
# Cari "IPv4 Address", contoh: 192.168.1.100
```

2. **Jalankan server dengan host:**
```powershell
php artisan serve --host=0.0.0.0 --port=8000
```

3. **Akses dari device lain:**
```
http://192.168.1.100:8000
```

### Jika Menggunakan Herd:

Herd sudah expose ke network local secara default.
```
http://coffee-shop-discovery-platform.test
```

---

## 🎨 Melihat Modern UI

Setelah berhasil running, cek pages ini:

1. **Homepage**: `/` - Hero section dengan gradient
2. **Coffee Shop List**: `/coffee-shops` - Modern cards
3. **Detail Page**: `/coffee-shops/kopi-kenangan` - Professional layout
4. **Map View**: `/map` - Interactive map
5. **Admin Dashboard**: `/admin/dashboard` - (login as admin)

---

## ⚡ Quick Start (TL;DR)

Jika semua sudah setup:

### Dengan Herd:
```powershell
# Pastikan Herd running
# Buka: http://coffee-shop-discovery-platform.test
```

### Dengan Artisan:
```powershell
cd "d:\COFFEE SHOP DISCOVERY PLATFORM"
php artisan serve
# Buka: http://localhost:8000
```

---

## 📞 Butuh Bantuan?

Jika masih error:

1. **Check Laravel Log:**
```powershell
type storage\logs\laravel.log
```

2. **Check Herd Status:**
- Klik icon Herd di system tray
- Check "View Logs" untuk error

3. **Run in Debug Mode:**
```powershell
# Edit .env
APP_DEBUG=true
APP_ENV=local
```

4. **Fresh Start:**
```powershell
# Reset everything
php artisan optimize:clear
composer dump-autoload
npm run build
php artisan migrate:fresh --seed
```

---

## 🎉 Selamat!

Setelah berhasil running, Anda akan melihat:
- ✅ Modern homepage dengan gradient hero
- ✅ Professional coffee shop cards
- ✅ Beautiful icons (Heroicons, bukan emoji!)
- ✅ Smooth animations
- ✅ Responsive design

**Enjoy exploring! ☕**

---

**Last Updated**: August 22, 2026
**Project**: Ngopikel - Coffee Shop Discovery Platform
**Status**: ✅ Production Ready
