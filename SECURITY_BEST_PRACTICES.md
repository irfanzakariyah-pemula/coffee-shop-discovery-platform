# 🔐 Security Best Practices Guide

## For Developers

### 1. Never Commit Sensitive Data
```bash
# ❌ DON'T
git add .env
git commit -m "Add config"

# ✅ DO
# .env is in .gitignore
# Use .env.example as template
```

### 2. Always Validate Input
```php
// ✅ Use Form Requests
public function store(CoffeeShopRequest $request)

// ✅ Validate in controller
$validated = $request->validate([
    'email' => 'required|email',
    'rating' => 'required|integer|min:1|max:5'
]);
```

### 3. Use Eloquent/Query Builder
```php
// ✅ Safe - Parameterized
User::where('email', $email)->first()

// ❌ Vulnerable to SQL Injection
DB::select("SELECT * FROM users WHERE email = '$email'")

// ✅ Safe - With bindings
DB::select("SELECT * FROM users WHERE email = ?", [$email])
```

### 4. Escape Output
```php
// ✅ Auto-escaped
{{ $user->name }}

// ⚠️ Use only for trusted content
{!! $trustedHtml !!}
```

### 5. Use Authorization
```php
// ✅ Check ownership
Gate::authorize('update', $review);

// ✅ Middleware protection
Route::middleware('admin')->group(function() {
    // Admin only routes
});
```

### 6. Rate Limit Sensitive Actions
```php
// ✅ Throttle login attempts
Route::middleware('throttle:5,1')->post('/login');

// ✅ Throttle reviews
Route::middleware('throttle:20,1')->post('/reviews');
```

### 7. HTTPS in Production
```php
// config/app.php or AppServiceProvider
if (app()->environment('production')) {
    URL::forceScheme('https');
}
```

---

## For Deployment

### Pre-Production Checklist

```bash
# 1. Generate new app key
php artisan key:generate

# 2. Clear & cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Run migrations
php artisan migrate --force

# 4. Set proper permissions
chmod -R 755 storage bootstrap/cache
chmod -R 644 .env

# 5. Optimize autoloader
composer install --optimize-autoloader --no-dev
```

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Use strong passwords
DB_PASSWORD=strong-random-password

# Session security
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

### Web Server Config

#### Nginx
```nginx
# Force HTTPS
server {
    listen 80;
    server_name yourdomain.com;
    return 301 https://$server_name$request_uri;
}

# Security headers
add_header X-Frame-Options "DENY";
add_header X-Content-Type-Options "nosniff";
add_header X-XSS-Protection "1; mode=block";
add_header Strict-Transport-Security "max-age=31536000; includeSubDomains";

# Hide PHP version
fastcgi_hide_header X-Powered-By;
```

#### Apache
```apache
# .htaccess
<IfModule mod_headers.c>
    Header set X-Frame-Options "DENY"
    Header set X-Content-Type-Options "nosniff"
    Header set X-XSS-Protection "1; mode=block"
    Header set Strict-Transport-Security "max-age=31536000; includeSubDomains"
</IfModule>

# Force HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Security Monitoring

### 1. Error Tracking
```bash
# Install Sentry or similar
composer require sentry/sentry-laravel
```

### 2. Log Monitoring
```php
// Monitor failed login attempts
Log::warning('Failed login attempt', [
    'email' => $request->email,
    'ip' => $request->ip()
]);
```

### 3. Database Backups
```bash
# Daily backups
0 2 * * * /usr/bin/mysqldump -u user -p database > backup.sql
```

### 4. Regular Updates
```bash
# Keep Laravel & packages updated
composer update

# Check for security vulnerabilities
composer audit
```

---

## Common Vulnerabilities to Avoid

### 1. Mass Assignment
```php
// ❌ Vulnerable
User::create($request->all());

// ✅ Protected with $fillable
protected $fillable = ['name', 'email'];
User::create($request->validated());
```

### 2. Insecure Direct Object Reference
```php
// ❌ No authorization check
$review = Review::findOrFail($id);
$review->delete();

// ✅ Check ownership
Gate::authorize('delete', $review);
$review->delete();
```

### 3. Exposed Debug Info
```php
// ❌ Shows stack traces in production
APP_DEBUG=true

// ✅ Hide errors
APP_DEBUG=false
```

### 4. Weak Passwords
```php
// ❌ Weak validation
'password' => 'required|min:6'

// ✅ Strong validation
'password' => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/'
```

### 5. Session Fixation
```php
// ✅ Regenerate on login
Auth::login($user);
$request->session()->regenerate();
```

---

## Security Tools

### Static Analysis
```bash
# PHPStan
composer require --dev phpstan/phpstan
./vendor/bin/phpstan analyse

# Psalm
composer require --dev vimeo/psalm
./vendor/bin/psalm
```

### Security Scanner
```bash
# Local Security Checker
composer require --dev sensiolabs/security-checker
./vendor/bin/security-checker security:check
```

### Penetration Testing
- OWASP ZAP
- Burp Suite
- Nikto

---

## Incident Response

### If Compromised

1. **Immediately**:
   - Take site offline
   - Change all passwords & keys
   - Review access logs

2. **Investigation**:
   - Identify breach point
   - Check for backdoors
   - Review recent code changes

3. **Recovery**:
   - Restore from clean backup
   - Patch vulnerability
   - Update dependencies

4. **Prevention**:
   - Implement additional security
   - Monitor for suspicious activity
   - Document incident

---

## Resources

- [Laravel Security Documentation](https://laravel.com/docs/security)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [PHP Security Guide](https://phptherightway.com/#security)
- [Laravel Security Package](https://github.com/GeneaLabs/laravel-security)

---

**Remember**: Security is an ongoing process, not a one-time task.
