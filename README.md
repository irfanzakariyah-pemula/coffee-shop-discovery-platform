# Ngopikel - Coffee Shop Discovery Platform

<div align="center">
  
  ![Ngopikel Logo](https://img.shields.io/badge/Ngopikel-Coffee%20Shop%20Discovery-coffee?style=for-the-badge)
  
  Platform penemuan coffee shop terbaik berdasarkan lokasi, fasilitas, atmosfer, harga, dan preferensi pengguna.
  
  ![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel)
  ![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php)
  ![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.x-06B6D4?style=flat-square&logo=tailwindcss)
  ![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat-square&logo=alpinedotjs)

</div>

---

## 📖 Tentang Project

**Ngopikel** adalah platform web yang memudahkan pengguna untuk menemukan coffee shop berdasarkan berbagai kriteria seperti:

- 📍 **Lokasi & Jarak** - Temukan coffee shop terdekat dari lokasimu
- ⭐ **Rating & Review** - Baca review dari pengguna lain
- 💰 **Rentang Harga** - Filter berdasarkan budget
- 🏢 **Fasilitas** - WiFi, Parking, Power Outlet, dll.
- 🗺️ **Peta Interaktif** - Jelajahi coffee shop di peta dengan Leaflet.js
- ❤️ **Favorit** - Simpan coffee shop favorit
- 📝 **Ulasan** - Tulis dan bagikan pengalamanmu

Project ini dibangun sebagai:
1. **Portfolio Project** - Demonstrasi kemampuan full-stack development
2. **Learning Project** - Belajar best practices Laravel, database design, security, dan testing
3. **Production-Ready Demo** - Mengikuti standar industri untuk aplikasi production

---

## 🚀 Tech Stack

### Backend
- **PHP 8.3+**
- **Laravel 12+** - Full-stack PHP framework
- **MySQL 8+ / SQLite** - Relational database
- **Eloquent ORM** - Database abstraction

### Frontend
- **Blade** - Laravel templating engine
- **Tailwind CSS 4.x** - Utility-first CSS framework
- **Alpine.js** - Minimal JavaScript framework
- **Vite** - Modern build tool

### Maps
- **Leaflet.js** - Interactive map library
- **OpenStreetMap** - Free map data

### Development Tools
- **Laravel Pint** - PHP code style fixer
- **PHPUnit/Pest** - Testing framework
- **Git** - Version control

---

## 📦 Features

### 🔐 Authentication & Authorization
- [x] User registration & login
- [x] Role-based access (Guest, User, Admin)
- [ ] Password reset
- [ ] Email verification

### ☕ Coffee Shop Discovery
- [ ] Browse & search coffee shops
- [ ] Advanced filtering (price, rating, category, facilities)
- [ ] Detailed coffee shop pages
- [ ] Photo galleries
- [ ] Menu & pricing
- [ ] Opening hours

### 🗺️ Interactive Map
- [ ] Leaflet.js + OpenStreetMap integration
- [ ] Coffee shop markers
- [ ] Distance calculation
- [ ] User geolocation

### ❤️ User Features
- [ ] Favorites system
- [ ] Write/edit/delete reviews
- [ ] 1-5 star rating system
- [ ] User profile

### 👑 Admin Dashboard
- [ ] Dashboard statistics
- [ ] CRUD coffee shops
- [ ] Manage categories & facilities
- [ ] Manage promotions
- [ ] Moderate reviews

---

## 🛠️ Installation

### Prerequisites

Pastikan kamu sudah menginstall:
- PHP 8.3 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL 8+ atau SQLite
- Git

**Rekomendasi**: Gunakan [Laravel Herd](https://herd.laravel.com) (Windows/Mac) untuk setup yang lebih mudah.

### Setup Steps

1. **Clone repository**
   ```bash
   git clone https://github.com/yourusername/ngopikel.git
   cd ngopikel
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   
   Edit `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ngopikel
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   
   Or use SQLite (easier for development):
   ```env
   DB_CONNECTION=sqlite
   # Comment out other DB_* lines
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed database** (optional - untuk demo data)
   ```bash
   php artisan db:seed
   ```

8. **Build assets**
   ```bash
   npm run build
   # or for development with hot reload:
   npm run dev
   ```

9. **Start development server**
   
   Using Laravel Herd:
   ```bash
   herd link
   # Access: http://coffee-shop-discovery-platform.test
   ```
   
   Or using Artisan:
   ```bash
   php artisan serve
   # Access: http://localhost:8000
   ```

---

## 🧪 Testing

Run tests:
```bash
php artisan test
```

Run specific test file:
```bash
php artisan test tests/Feature/CoffeeShopTest.php
```

Run with coverage:
```bash
php artisan test --coverage
```

---

## 📁 Project Structure

```
ngopikel/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controllers
│   │   ├── Requests/         # Form validation
│   │   └── Middleware/       # Custom middleware
│   ├── Models/               # Eloquent models
│   ├── Policies/             # Authorization policies
│   └── Services/             # Business logic
│
├── database/
│   ├── migrations/           # Database migrations
│   ├── seeders/             # Database seeders
│   └── factories/           # Model factories
│
├── resources/
│   ├── views/               # Blade templates
│   ├── css/                 # Styles
│   └── js/                  # JavaScript
│
├── routes/
│   ├── web.php              # Web routes
│   └── api.php              # API routes
│
├── tests/
│   ├── Feature/             # Feature tests
│   └── Unit/                # Unit tests
│
└── public/                  # Public assets
```

---

## 🔒 Security

This application follows security best practices:

- ✅ **SQL Injection Prevention** - Using Eloquent ORM & parameterized queries
- ✅ **XSS Protection** - Blade escaping & input sanitization
- ✅ **CSRF Protection** - Laravel CSRF middleware enabled
- ✅ **Mass Assignment Protection** - Model `$fillable` attributes
- ✅ **Password Hashing** - Bcrypt hashing
- ✅ **Authorization** - Policies & Gates
- ✅ **Rate Limiting** - Throttle middleware on sensitive endpoints
- ✅ **File Upload Validation** - MIME type, size, extension checks
- ✅ **Secure Session** - HTTP-only cookies

See [docs/security.md](docs/security.md) for detailed security documentation.

---

## 🗺️ Roadmap

### Phase 1: Foundation ✅
- [x] Project setup
- [x] Basic layout & navigation
- [x] Database design
- [ ] Authentication system

### Phase 2: Core Features (In Progress)
- [ ] Coffee shop CRUD
- [ ] Search & filtering
- [ ] Detail pages
- [ ] Map integration

### Phase 3: User Features
- [ ] Favorites
- [ ] Reviews & ratings
- [ ] User profile

### Phase 4: Admin Features
- [ ] Admin dashboard
- [ ] Content management
- [ ] Review moderation

### Phase 5: Polish & Deploy
- [ ] Performance optimization
- [ ] Testing coverage
- [ ] Documentation
- [ ] Deployment

---

## 🤝 Contributing

This is a learning/portfolio project, but suggestions and feedback are welcome!

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'feat: add amazing feature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 👨‍💻 Developer

**Your Name**
- Portfolio: [your-portfolio.com](https://your-portfolio.com)
- GitHub: [@yourusername](https://github.com/yourusername)
- LinkedIn: [Your Name](https://linkedin.com/in/yourprofile)

---

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Alpine.js
- Leaflet.js & OpenStreetMap
- Laravel Herd
- All open-source contributors

---

<div align="center">
  
  **Built with ❤️ and ☕ by [Your Name]**
  
  ⭐ Star this repo if you find it helpful!
  
</div>
