# 📦 Installation Guide

Complete step-by-step installation guide for Ngopikel Coffee Shop Discovery Platform.

---

## 🎯 Prerequisites

Before you begin, make sure you have:

### Required Software

| Software | Version | Download Link |
|----------|---------|---------------|
| PHP | 8.3+ | [php.net](https://www.php.net/downloads) |
| Composer | 2.x | [getcomposer.org](https://getcomposer.org/) |
| Node.js | 18+ | [nodejs.org](https://nodejs.org/) |
| npm | 9+ | (included with Node.js) |

### Recommended Tools

- **Laravel Herd** - Local development environment ([herd.laravel.com](https://herd.laravel.com/))
- **Git** - Version control ([git-scm.com](https://git-scm.com/))
- **VS Code** - Code editor ([code.visualstudio.com](https://code.visualstudio.com/))

---

## 📥 Installation Methods

Choose one of the following installation methods:

### Method 1: Quick Install (Laravel Herd) ⚡

**Recommended for beginners**

1. Install Laravel Herd
2. Clone repository to Herd sites folder
3. Run setup commands
4. Access via `*.test` domain

### Method 2: Manual Install 🔧

**For advanced users or production setup**

1. Install PHP, Composer, Node.js manually
2. Configure web server (Nginx/Apache)
3. Setup database
4. Run setup commands

---

## 🚀 Method 1: Quick Install with Laravel Herd

### Step 1: Install Laravel Herd

1. Download Laravel Herd from [herd.laravel.com](https://herd.laravel.com/)
2. Run installer
3. Follow installation wizard
4. Herd will install PHP 8.3, Nginx, and Node.js automatically

### Step 2: Clone Repository

```bash
# Navigate to Herd sites folder
cd ~/Herd  # macOS/Linux
cd C:\Users\YourUsername\Herd  # Windows

# Clone repository
git clone https://github.com/irfanzakariyah-pemula/coffee-shop-discovery-platform.git

# Enter project directory
cd coffee-shop-discovery-platform
```

### Step 3: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

**If you encounter errors:**

```bash
# Clear composer cache
composer clear-cache

# Update composer
composer self-update

# Try install again
composer install --no-cache
```

### Step 4: Environment Setup

```bash
# Copy environment file (Windows)
copy .env.example .env

# Copy environment file (macOS/Linux)
cp .env.example .env

# Generate application key
php artisan key:generate
```

### Step 5: Database Setup

**For SQLite (Default):**

```bash
# Create database file (Windows)
type nul > database\database.sqlite

# Create database file (macOS/Linux)
touch database/database.sqlite

# Run migrations
php artisan migrate

# Seed with sample data
php artisan db:seed
```

**For MySQL:**

1. Open `.env` file
2. Update database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ngopikel
DB_USERNAME=root
DB_PASSWORD=your_password
```

3. Create database:

```sql
CREATE DATABASE ngopikel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

4. Run migrations:

```bash
php artisan migrate
php artisan db:seed
```

### Step 6: Build Assets

```bash
# Development (with hot reload)
npm run dev

# OR build for production
npm run build
```

### Step 7: Access Application

**With Laravel Herd:**

Open browser and visit:
```
http://coffee-shop-discovery-platform.test
```

Herd automatically creates `.test` domain for your project!

### Step 8: Login with Demo Accounts

**Admin:**
- Email: `admin@ngopikel.com`
- Password: `password`

**User:**
- Email: `john@example.com`
- Password: `password`

---

## 🔧 Method 2: Manual Installation

### Step 1: Install PHP 8.3

**Windows:**

1. Download PHP from [windows.php.net](https://windows.php.net/download/)
2. Extract to `C:\php`
3. Add to PATH environment variable
4. Verify: `php -v`

**macOS (Homebrew):**

```bash
brew install php@8.3
brew link php@8.3
php -v
```

**Ubuntu/Debian:**

```bash
sudo apt update
sudo apt install php8.3 php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-sqlite3
php -v
```

### Step 2: Install Composer

```bash
# Download installer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Run installer
php composer-setup.php

# Move to global bin
sudo mv composer.phar /usr/local/bin/composer  # macOS/Linux
move composer.phar C:\composer\composer.bat     # Windows

# Verify
composer --version
```

### Step 3: Install Node.js & npm

Download and install from [nodejs.org](https://nodejs.org/)

Verify installation:

```bash
node -v  # Should show v18 or higher
npm -v   # Should show v9 or higher
```

### Step 4: Clone Repository

```bash
git clone https://github.com/irfanzakariyah-pemula/coffee-shop-discovery-platform.git
cd coffee-shop-discovery-platform
```

### Step 5: Install Dependencies & Setup

```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Create database
touch database/database.sqlite  # macOS/Linux
type nul > database\database.sqlite  # Windows

# Run migrations & seeders
php artisan migrate
php artisan db:seed

# Build assets
npm run build
```

### Step 6: Configure Web Server

#### Option A: Use Artisan Serve (Development)

```bash
php artisan serve
```

Access at: `http://localhost:8000`

#### Option B: Nginx (Production)

Create Nginx config:

```nginx
server {
    listen 80;
    server_name ngopikel.local;
    root /path/to/coffee-shop-discovery-platform/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Restart Nginx:

```bash
sudo systemctl restart nginx
```

#### Option C: Apache (Production)

Create `.htaccess` in `public/` folder:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## ⚙️ Configuration

### Environment Variables

Edit `.env` file:

```env
# Application
APP_NAME="Ngopikel"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite

# Cache (Development)
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Mail (Optional)
MAIL_MAILER=log
```

### Production Environment

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ngopikel.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=ngopikel
DB_USERNAME=production_user
DB_PASSWORD=strong_password

CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

---

## 🔍 Verification

### Check Installation

```bash
# Check PHP version
php -v

# Check Composer
composer --version

# Check Node.js
node -v

# Check npm
npm -v

# Check Laravel
php artisan --version

# Check database connection
php artisan tinker
>>> DB::connection()->getPdo();  # Should connect without error
>>> exit
```

### Run Tests

```bash
php artisan test
```

Expected output:
```
PASS  Tests\Feature\Auth\AuthenticationTest
✓ login screen can be rendered
✓ users can authenticate with valid credentials
...

Tests:  12 passed (21 assertions)
```

### Access Application

1. Open browser
2. Visit `http://coffee-shop-discovery-platform.test` (Herd) or `http://localhost:8000` (Artisan)
3. You should see the homepage
4. Try logging in with demo accounts

---

## 🐛 Troubleshooting

### Common Issues

#### Issue: "Call to undefined function Illuminate\Encryption\openssl_encrypt"

**Solution:**
```bash
# Enable OpenSSL extension
# Edit php.ini and uncomment:
extension=openssl
```

#### Issue: "PDOException: could not find driver"

**Solution:**
```bash
# Enable SQLite extension
# Edit php.ini and uncomment:
extension=pdo_sqlite
extension=sqlite3
```

#### Issue: "npm ERR! code ENOENT"

**Solution:**
```bash
# Delete node_modules and reinstall
rm -rf node_modules package-lock.json
npm install
```

#### Issue: "Class 'App\Models\User' not found"

**Solution:**
```bash
# Regenerate autoload files
composer dump-autoload
```

#### Issue: "419 Page Expired" on forms

**Solution:**
- Clear browser cache
- Check CSRF token in forms
- Run: `php artisan config:clear`

#### Issue: Vite not loading assets

**Solution:**
```bash
# Development
npm run dev

# Production
npm run build
php artisan config:clear
```

---

## 📝 Additional Setup

### Setup Queue Worker (Optional)

```bash
# Run queue worker
php artisan queue:work --tries=3

# Setup Supervisor (Production)
# Create config: /etc/supervisor/conf.d/ngopikel-worker.conf
```

### Setup Task Scheduler (Optional)

```bash
# Add to cron (Linux/macOS)
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1

# Add to Task Scheduler (Windows)
# Run: php artisan schedule:run every minute
```

### Enable Redis Cache (Production)

```bash
# Install Redis
sudo apt install redis-server  # Ubuntu
brew install redis             # macOS

# Start Redis
sudo systemctl start redis
redis-cli ping  # Should return PONG

# Update .env
CACHE_STORE=redis
SESSION_DRIVER=redis
```

---

## 🚀 Optimization for Production

### Step 1: Build Assets

```bash
npm run build
```

### Step 2: Optimize Laravel

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### Step 3: Setup Permissions

```bash
# Set correct permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Step 4: Enable OPcache

Edit `php.ini`:

```ini
[opcache]
opcache.enable=1
opcache.memory_consumption=256
opcache.max_accelerated_files=20000
opcache.validate_timestamps=0
```

---

## 📊 Performance Testing

### Test page load speed:

```bash
# Using curl
curl -w "@curl-format.txt" -o /dev/null -s http://localhost/

# Using Apache Bench
ab -n 100 -c 10 http://localhost/
```

---

## 🎓 Next Steps

After installation:

1. **Explore the Application**
   - Browse coffee shops
   - Try creating reviews
   - Test favorites feature

2. **Admin Panel**
   - Login as admin
   - Add new coffee shops
   - Manage users

3. **Read Documentation**
   - [README.md](README.md) - Project overview
   - [ARCHITECTURE.md](ARCHITECTURE.md) - System architecture
   - [TESTING.md](TESTING.md) - Testing guide
   - [PERFORMANCE.md](PERFORMANCE.md) - Performance optimization

4. **Customize**
   - Update branding
   - Add custom features
   - Deploy to production

---

## 💬 Get Help

If you encounter issues:

1. Check [Troubleshooting](#-troubleshooting) section
2. Search [GitHub Issues](https://github.com/irfanzakariyah-pemula/coffee-shop-discovery-platform/issues)
3. Create a new issue with:
   - Error message
   - Steps to reproduce
   - Your environment (OS, PHP version, etc.)

---

**Last Updated**: August 22, 2026  
**Tested on**: Windows 11, macOS Sonoma, Ubuntu 22.04
