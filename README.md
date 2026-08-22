# ☕ Ngopikel - Coffee Shop Discovery Platform

> **Find Your Perfect Coffee Shop in Indonesia** 🇮🇩

A modern web platform for discovering, reviewing, and sharing coffee shop experiences across Indonesia. Built with Laravel 12, Tailwind CSS, and Alpine.js.

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?logo=php)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-4.x-38B2AC?logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

![Project Banner](https://via.placeholder.com/1200x400/1F2937/FFFFFF?text=Ngopikel+-+Coffee+Shop+Discovery+Platform)

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Installation](#-installation)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [API Documentation](#-api-documentation)
- [Testing](#-testing)
- [Performance](#-performance)
- [Security](#-security)
- [Contributing](#-contributing)
- [License](#-license)

---

## ✨ Features

### 🔍 **Coffee Shop Discovery**
- Browse coffee shops with advanced filters (category, city, rating, price)
- Interactive map view with Leaflet.js integration
- Search by name, location, or facilities
- Detailed coffee shop profiles with complete information

### ⭐ **Review System**
- Write and edit reviews with 1-5 star ratings
- View aggregated ratings and review counts
- User-specific review management
- Duplicate review prevention

### ❤️ **Favorites & Collections**
- Save favorite coffee shops
- Quick access to favorites list
- Toggle favorites with one click

### 🍰 **Menu & Promotions**
- Browse coffee shop menus with pricing
- View active promotions and deals
- Filter by availability

### 👨‍💼 **Admin Dashboard**
- Complete CRUD for coffee shops
- User management
- Menu & promotion management
- Real-time statistics and analytics
- Monthly reporting

### 🔐 **Security Features**
- Role-based access control (Admin/User)
- Rate limiting on sensitive endpoints
- CSRF protection
- XSS prevention
- Security headers (CSP, HSTS, etc.)
- Input validation and sanitization

---

## 🛠 Tech Stack

### Backend
- **Framework**: Laravel 12.x
- **PHP**: 8.3+
- **Database**: SQLite (dev), MySQL/PostgreSQL (production)
- **Authentication**: Laravel Breeze

### Frontend
- **CSS Framework**: Tailwind CSS 4.x
- **JavaScript**: Alpine.js 3.x
- **Maps**: Leaflet.js
- **Icons**: Heroicons (future), currently emoji

### Development Tools
- **Local Server**: Laravel Herd
- **Version Control**: Git & GitHub
- **Testing**: PHPUnit, Pest
- **Code Quality**: PHP CS Fixer

---

## 🚀 Installation

### Prerequisites

- PHP 8.3 or higher
- Composer 2.x
- Node.js 18+ & npm
- Laravel Herd (recommended) or equivalent

### Step 1: Clone Repository

```bash
git clone https://github.com/irfanzakariyah-pemula/coffee-shop-discovery-platform.git
cd coffee-shop-discovery-platform
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### Step 3: Environment Configuration

```bash
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### Step 4: Database Setup

```bash
# Create SQLite database (Windows)
type nul > database\database.sqlite

# Run migrations
php artisan migrate

# Seed sample data
php artisan db:seed
```

### Step 5: Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### Step 6: Start Development Server

**Option A: Laravel Herd (Recommended)**
- Make sure Herd is running
- Access at: `http://coffee-shop-discovery-platform.test`

**Option B: Artisan Serve**
```bash
php artisan serve
```
- Access at: `http://localhost:8000`

---

## 👤 Demo Accounts

### Admin Account
- **Email**: admin@ngopikel.com
- **Password**: password

### User Accounts
- **Email**: john@example.com / jane@example.com
- **Password**: password

---

## 💻 Usage

### For Users

1. **Browse Coffee Shops**
   - Visit homepage or `/coffee-shops`
   - Use filters to narrow down results
   - Click "Lihat Detail" to view full information

2. **View on Map**
   - Navigate to `/map`
   - Click markers to see coffee shop info
   - Use "Dekat Saya" to find nearby shops

3. **Write Reviews**
   - Login required
   - Go to coffee shop detail page
   - Click "Tulis Review" button
   - Rate 1-5 stars and add comment

4. **Save Favorites**
   - Click heart icon on coffee shop cards
   - View all favorites at `/favorites`

### For Admins

1. **Manage Coffee Shops**
   - Login as admin
   - Navigate to `/admin/coffee-shops`
   - Create, edit, or deactivate shops

2. **Manage Users**
   - View user list at `/admin/users`
   - Manage roles and permissions

3. **Manage Menus & Promotions**
   - Edit coffee shop
   - Navigate to "Menu" or "Promosi" tab
   - Add/edit items

4. **View Analytics**
   - Dashboard at `/admin/dashboard`
   - View stats, charts, and reports

---

## 📁 Project Structure

```
coffee-shop-discovery-platform/
├── app/
│   ├── Console/Commands/         # Custom artisan commands
│   ├── Http/
│   │   ├── Controllers/          # Request handlers
│   │   │   ├── Admin/            # Admin controllers
│   │   │   ├── Api/              # API controllers
│   │   ├── Middleware/           # HTTP middleware
│   │   └── Requests/             # Form requests
│   ├── Models/                   # Eloquent models
│   └── Providers/                # Service providers
├── config/
│   ├── performance.php           # Performance settings
│   └── ...                       # Laravel configs
├── database/
│   ├── migrations/               # Database migrations
│   ├── seeders/                  # Database seeders
│   └── database.sqlite           # SQLite database
├── resources/
│   ├── views/                    # Blade templates
│   │   ├── admin/                # Admin views
│   │   ├── coffee-shops/         # Shop views
│   │   ├── components/           # Reusable components
│   │   └── layouts/              # Layout templates
│   ├── css/                      # Stylesheets
│   └── js/                       # JavaScript files
├── routes/
│   ├── web.php                   # Web routes
│   ├── api.php                   # API routes
│   └── console.php               # Console routes
├── tests/
│   ├── Feature/                  # Feature tests
│   └── Unit/                     # Unit tests
├── PERFORMANCE.md                # Performance guide
├── SECURITY_AUDIT.md             # Security documentation
├── TESTING.md                    # Testing guide
└── README.md                     # This file
```

---

## 🔌 API Documentation

### Get Nearby Coffee Shops

```http
GET /api/map/nearby?lat=-6.2088&lng=106.8456&radius=5
```

**Response:**
```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "Kopi Kenangan",
      "lat": -6.2088,
      "lng": 106.8456,
      "rating": 4.5,
      "distance": "1.2 km"
    }
  ]
}
```

### Get All Coffee Shops (Map View)

```http
GET /api/map/coffee-shops
```

**Response:**
```json
{
  "status": "success",
  "data": [...]
}
```

---

## 🧪 Testing

### Run All Tests

```bash
php artisan test
```

### Run Specific Test Suite

```bash
# Feature tests
php artisan test --testsuite=Feature

# Unit tests
php artisan test --testsuite=Unit
```

### Run with Coverage

```bash
php artisan test --coverage
```

### Current Test Status

- ✅ **12/32 tests passing** (Authentication suite complete)
- ⚠️ 20 tests require factory setup (documented in TESTING.md)

---

## ⚡ Performance

### Optimizations Implemented

1. **Database Indexing**
   - Indexed all foreign keys
   - Compound indexes for common queries
   - Unique indexes for slugs

2. **Query Optimization**
   - Eager loading to prevent N+1 queries
   - Query scopes for reusability
   - Pagination for large datasets

3. **Caching Strategy**
   - Categories & facilities cached (1 hour)
   - Popular shops cached (15 minutes)
   - Dashboard stats cached (5 minutes)

4. **Laravel Optimizations**
   - Config caching: `php artisan config:cache`
   - Route caching: `php artisan route:cache`
   - View caching: `php artisan view:cache`

### Benchmarks

- **Homepage**: ~1.2s load time
- **Coffee Shop List**: 6 queries (down from 42)
- **Admin Dashboard**: ~2.1s load time

See [PERFORMANCE.md](PERFORMANCE.md) for detailed guide.

---

## 🔒 Security

### Security Features

- **Authentication**: Laravel Breeze with session management
- **Authorization**: Role-based access control (RBAC)
- **Rate Limiting**: 
  - Login: 5 attempts per minute
  - Favorites: 60 requests per minute
  - Reviews: 20 requests per minute
- **Security Headers**: 
  - CSP, X-Frame-Options, X-Content-Type-Options
  - HSTS, Referrer-Policy
- **Input Validation**: All forms validated
- **CSRF Protection**: All POST/PUT/DELETE requests
- **XSS Prevention**: Blade templating auto-escaping

### Security Score: ⭐⭐⭐⭐⭐ (5/5)

See [SECURITY_AUDIT.md](SECURITY_AUDIT.md) for full audit report.

---

## 📊 Database Schema

### Main Tables

1. **users** - User accounts
2. **coffee_shops** - Coffee shop information
3. **categories** - Coffee shop categories
4. **facilities** - Available facilities (WiFi, parking, etc.)
5. **reviews** - User reviews and ratings
6. **favorites** - User favorite shops
7. **menus** - Coffee shop menu items
8. **promotions** - Active promotions

### Relationships

```
users (1) ----< (N) reviews
users (1) ----< (N) favorites
coffee_shops (1) ----< (N) reviews
coffee_shops (1) ----< (N) favorites
coffee_shops (1) ----< (N) menus
coffee_shops (1) ----< (N) promotions
categories (1) ----< (N) coffee_shops
coffee_shops (N) >----< (N) facilities
```

---

## 🎨 UI/UX Notes

**Current State:**
- Functional UI with Tailwind CSS
- Basic design components
- Emoji icons (temporary)
- Responsive layout

**Future Improvements:**
- Modern SVG icons (Heroicons)
- Hero section on homepage
- Better color scheme
- Professional typography
- Image uploads with optimization
- Dark mode support

---

## 🚧 Roadmap

### Phase 1 (Completed) ✅
- [x] Project setup & planning
- [x] Database design
- [x] Authentication system
- [x] Coffee shop CRUD
- [x] Map integration
- [x] Review system
- [x] Favorites feature
- [x] Menu & promotions
- [x] Admin dashboard
- [x] Security audit
- [x] Testing suite
- [x] Performance optimization
- [x] Documentation

### Phase 2 (Future)
- [ ] Modern UI redesign
- [ ] Image upload & optimization
- [ ] Full-text search (Laravel Scout)
- [ ] Email notifications
- [ ] Social sharing features
- [ ] Mobile app (Flutter/React Native)

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Code Style

- Follow PSR-12 coding standards
- Write descriptive commit messages
- Add tests for new features
- Update documentation as needed

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Irfan Zakariyah**
- GitHub: [@irfanzakariyah-pemula](https://github.com/irfanzakariyah-pemula)
- Email: [your-email@example.com]

---

## 🙏 Acknowledgments

- Laravel Framework Team
- Tailwind CSS Team
- Alpine.js Community
- Leaflet.js Contributors
- Indonesian Coffee Shop Owners

---

## 📞 Support

If you have any questions or need help, please:
- Open an issue on GitHub
- Email: support@ngopikel.com (placeholder)
- Documentation: [Wiki](https://github.com/irfanzakariyah-pemula/coffee-shop-discovery-platform/wiki)

---

<div align="center">

**Made with ☕ and ❤️ in Indonesia**

⭐ Star this repo if you found it helpful!

</div>
