# 🏗 Architecture Documentation

## Overview

Ngopikel follows Laravel's MVC (Model-View-Controller) architecture pattern with additional layers for better separation of concerns and maintainability.

---

## System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                        PRESENTATION LAYER                    │
│  (Blade Templates, Tailwind CSS, Alpine.js, Leaflet.js)    │
└────────────────────────┬────────────────────────────────────┘
                         │
┌────────────────────────▼────────────────────────────────────┐
│                     APPLICATION LAYER                        │
│              (Controllers, Middleware, Routes)               │
└────────────────────────┬────────────────────────────────────┘
                         │
┌────────────────────────▼────────────────────────────────────┐
│                      BUSINESS LAYER                          │
│           (Models, Services, Observers, Events)              │
└────────────────────────┬────────────────────────────────────┘
                         │
┌────────────────────────▼────────────────────────────────────┐
│                         DATA LAYER                           │
│              (Database, Cache, File Storage)                 │
└─────────────────────────────────────────────────────────────┘
```

---

## Component Breakdown

### 1. Presentation Layer

**Responsibilities:**
- User interface rendering
- User input handling
- Client-side interactivity

**Technologies:**
- **Blade Templates**: Server-side rendering
- **Tailwind CSS 4**: Utility-first styling
- **Alpine.js 3**: Lightweight JavaScript framework
- **Leaflet.js**: Interactive maps

**Key Components:**
```
resources/views/
├── layouts/
│   ├── app.blade.php          # Main layout
│   ├── guest.blade.php        # Guest layout
│   └── admin.blade.php        # Admin layout
├── components/
│   ├── toast.blade.php        # Toast notifications
│   ├── button.blade.php       # Button component
│   ├── input.blade.php        # Input component
│   └── modal.blade.php        # Modal component
├── coffee-shops/
│   ├── index.blade.php        # Shop list
│   └── show.blade.php         # Shop detail
└── admin/
    └── dashboard.blade.php    # Admin dashboard
```

---

### 2. Application Layer

**Responsibilities:**
- HTTP request handling
- Routing
- Middleware execution
- Request validation
- Response formatting

**Controllers:**

#### Public Controllers
```php
CoffeeShopController
├── index()      # List coffee shops with filters
└── show($slug)  # Show coffee shop detail

MapPageController
└── index()      # Map view page

FavoriteController
├── index()      # User's favorites
└── toggle($id)  # Add/remove favorite

ReviewController
├── store()      # Create review
├── update($id)  # Update review
└── destroy($id) # Delete review
```

#### Admin Controllers
```php
Admin\DashboardController
└── index()      # Admin dashboard

Admin\CoffeeShopController
├── index()      # List all shops
├── create()     # Create form
├── store()      # Save new shop
├── edit($id)    # Edit form
├── update($id)  # Update shop
└── destroy($id) # Delete shop

Admin\UserController
└── index()      # List all users

Admin\MenuController
└── [CRUD methods]

Admin\PromotionController
└── [CRUD methods]
```

#### API Controllers
```php
Api\MapController
├── getCoffeeShops()    # All shops for map
└── getNearby()         # Nearby shops
```

**Middleware:**
```php
SecurityHeaders     # Add security headers
EnsureUserIsAdmin   # Admin authorization
throttle:60,1       # Rate limiting
```

---

### 3. Business Layer

**Responsibilities:**
- Business logic implementation
- Data manipulation
- Relationships management
- Validation rules

**Models:**

```php
User
├── Relationships: hasMany(Review, Favorite)
├── Methods: isAdmin(), hasFavorited()
└── Attributes: role, name, email

CoffeeShop
├── Relationships: 
│   ├── belongsTo(Category)
│   ├── belongsToMany(Facility)
│   ├── hasMany(Review, Favorite, Menu, Promotion, Image, OpeningHour)
├── Scopes:
│   ├── active()
│   ├── search($term)
│   ├── minRating($rating)
│   ├── inCity($city)
│   ├── priceBetween($min, $max)
├── Attributes: rating_avg, rating_count
└── Methods: updateRatings()

Review
├── Relationships: belongsTo(User, CoffeeShop)
├── Events: created, updated, deleted (update ratings)
└── Validation: unique per user per shop

Favorite
├── Relationships: belongsTo(User, CoffeeShop)
└── Unique: user_id + coffee_shop_id

Category, Facility, Menu, Promotion
├── Standard CRUD models
└── Relationships with CoffeeShop
```

**Model Events (Future):**
```php
CoffeeShopObserver
├── created()   # Clear cache
├── updated()   # Clear cache
└── deleted()   # Clear related data

ReviewObserver
├── created()   # Update shop ratings
└── deleted()   # Update shop ratings
```

---

### 4. Data Layer

**Responsibilities:**
- Data persistence
- Caching
- File storage

**Database Schema:**

```sql
-- Users
users (id, name, email, password, role, timestamps)

-- Coffee Shops
coffee_shops (
    id, name, slug, description, address, city, area,
    latitude, longitude, phone, email,
    price_min, price_max, rating_avg, rating_count,
    view_count, is_active, category_id, timestamps
)

-- Categories & Facilities
categories (id, name, slug, icon, timestamps)
facilities (id, name, slug, icon, timestamps)

-- Relationships
coffee_shop_facility (coffee_shop_id, facility_id)

-- User Content
reviews (id, user_id, coffee_shop_id, rating, comment, timestamps)
favorites (id, user_id, coffee_shop_id, timestamps)

-- Shop Content
menus (id, coffee_shop_id, name, description, price, is_available, timestamps)
promotions (id, coffee_shop_id, title, description, discount_percentage, valid_until, is_active, timestamps)
coffee_shop_images (id, coffee_shop_id, path, is_primary, timestamps)
opening_hours (id, coffee_shop_id, day_of_week, open_time, close_time, is_closed, timestamps)
```

**Indexes:**
```sql
-- Performance indexes
coffee_shops: slug(unique), city, area, is_active, rating_avg
reviews: coffee_shop_id, user_id, created_at
favorites: user_id, coffee_shop_id
```

**Caching Strategy:**
```php
Cache::remember('categories_all', 3600, ...)     # 1 hour
Cache::remember('facilities_all', 3600, ...)     # 1 hour
Cache::remember('cities_list', 1800, ...)        # 30 min
Cache::remember('popular_shops', 900, ...)       # 15 min
Cache::remember('admin_stats', 300, ...)         # 5 min
```

---

## Request Flow

### User Browsing Coffee Shops

```
1. User visits /coffee-shops
   ↓
2. Route: web.php → CoffeeShopController@index
   ↓
3. Controller:
   - Apply filters (category, city, rating, price)
   - Eager load relations (category, facilities)
   - Paginate results (12 per page)
   - Get cached filter options
   ↓
4. View: coffee-shops/index.blade.php
   - Render coffee shop cards
   - Display filters
   - Pagination links
   ↓
5. Response: HTML page
```

### User Writing Review

```
1. User clicks "Tulis Review" (must be logged in)
   ↓
2. POST /coffee-shops/{id}/reviews
   ↓
3. Middleware: auth, throttle:20,1
   ↓
4. Controller: ReviewController@store
   - Validate input (rating, comment)
   - Check duplicate (user already reviewed?)
   - Create review
   - Update coffee shop ratings
   - Clear related caches
   ↓
5. Redirect: Back to coffee shop page
   ↓
6. Flash message: "Review berhasil ditambahkan"
```

### Admin Managing Coffee Shops

```
1. Admin visits /admin/coffee-shops
   ↓
2. Middleware: auth, isAdmin
   ↓
3. Controller: Admin\CoffeeShopController@index
   - Get all coffee shops (paginated)
   - Include inactive shops
   ↓
4. View: admin/coffee-shops/index.blade.php
   - Display data table
   - CRUD action buttons
   ↓
5. Admin creates/edits shop
   ↓
6. Form validation (FormRequest)
   ↓
7. Save to database
   ↓
8. Clear caches
   ↓
9. Redirect with success message
```

---

## Security Architecture

### Authentication Flow

```
1. User submits login form
   ↓
2. POST /login
   ↓
3. Middleware: guest, throttle:5,1
   ↓
4. Controller: Laravel Breeze AuthenticatedSessionController
   - Validate credentials
   - Check rate limiting
   - Create session
   ↓
5. Redirect: Dashboard or home
```

### Authorization Layers

```
1. Middleware Level
   - auth: Ensure authenticated
   - isAdmin: Check admin role
   
2. Gate Level (Future)
   - Gate::define('update-review', ...)
   - Gate::define('delete-coffee-shop', ...)
   
3. Policy Level (Future)
   - ReviewPolicy: update(), delete()
   - CoffeeShopPolicy: admin operations
```

### Security Headers (Middleware)

```php
Content-Security-Policy: default-src 'self'
X-Frame-Options: SAMEORIGIN
X-Content-Type-Options: nosniff
Referrer-Policy: no-referrer-when-downgrade
Strict-Transport-Security: max-age=31536000
```

---

## API Architecture

### RESTful API Endpoints

```
GET  /api/map/coffee-shops      # All shops (map markers)
GET  /api/map/nearby            # Nearby shops (radius search)

Future:
POST   /api/v1/coffee-shops     # Create shop (admin)
GET    /api/v1/coffee-shops     # List shops
GET    /api/v1/coffee-shops/{id} # Get shop
PUT    /api/v1/coffee-shops/{id} # Update shop (admin)
DELETE /api/v1/coffee-shops/{id} # Delete shop (admin)
```

### API Response Format

```json
{
  "status": "success",
  "data": [...],
  "meta": {
    "total": 100,
    "page": 1,
    "per_page": 12
  }
}
```

---

## Deployment Architecture

### Development Environment

```
Local Machine (Windows)
├── Laravel Herd (Nginx + PHP 8.3)
├── SQLite Database
├── Vite Dev Server (HMR)
└── Git for version control
```

### Production Environment (Future)

```
┌─────────────────────────────────────────┐
│            Load Balancer (Nginx)        │
└────────────┬────────────────────────────┘
             │
    ┌────────┴────────┐
    ▼                 ▼
┌────────┐       ┌────────┐
│ App    │       │ App    │  (Multiple instances)
│ Server │       │ Server │
│ PHP-FPM│       │ PHP-FPM│
└───┬────┘       └───┬────┘
    │                │
    └────────┬───────┘
             ▼
    ┌─────────────────┐
    │   MySQL/        │
    │   PostgreSQL    │
    │   (Primary)     │
    └────────┬────────┘
             │
    ┌────────▼────────┐
    │   MySQL/        │
    │   PostgreSQL    │
    │   (Replica)     │
    └─────────────────┘

┌─────────────────┐    ┌─────────────────┐
│   Redis Cache   │    │   File Storage  │
│   (Sessions)    │    │   (S3/CDN)      │
└─────────────────┘    └─────────────────┘
```

---

## Performance Architecture

### Caching Layers

```
1. Browser Cache
   - Static assets (CSS, JS, images)
   - HTTP caching headers
   
2. Application Cache
   - Categories, facilities (1 hour)
   - Popular shops (15 minutes)
   - Dashboard stats (5 minutes)
   
3. Database Cache
   - Query result caching
   - ORM relationship caching
   
4. OPcache (PHP)
   - Compiled PHP bytecode
```

### Query Optimization

```php
// Eager Loading (prevent N+1)
CoffeeShop::with(['category', 'facilities', 'reviews.user'])->get();

// Query Scopes (reusable)
CoffeeShop::active()->minRating(4)->inCity('Jakarta')->get();

// Pagination (limit results)
CoffeeShop::paginate(12);

// Select Specific Columns
User::select('id', 'name')->get();
```

---

## Testing Architecture

### Test Pyramid

```
        ┌─────────┐
        │   E2E   │  (Future - Laravel Dusk)
        │ Tests   │
        └─────────┘
      ┌─────────────┐
      │  Feature    │  (HTTP tests, Auth flows)
      │   Tests     │
      └─────────────┘
    ┌─────────────────┐
    │   Unit Tests    │  (Model methods, helpers)
    └─────────────────┘
```

### Test Database

```
Testing Environment
├── In-memory SQLite
├── Fresh migration per test
├── RefreshDatabase trait
└── Factories for test data
```

---

## File Storage Architecture (Future)

```
Development: local storage (public/uploads)
Production: S3/CDN

storage/
├── app/
│   ├── public/
│   │   └── coffee-shops/
│   │       ├── logos/
│   │       └── photos/
```

---

## Monitoring & Logging (Future)

```
Application Logs
├── Laravel Log (storage/logs/laravel.log)
├── Slow Query Log
└── Error Tracking (Sentry)

Monitoring
├── Laravel Telescope (local)
├── New Relic / Datadog (production)
└── Google Analytics (user behavior)
```

---

## Scalability Considerations

### Current Capacity
- Single server
- SQLite database
- File cache
- Suitable for: 100-1000 users

### Future Scaling

**Horizontal Scaling:**
- Multiple app servers behind load balancer
- Redis for shared sessions
- Database read replicas

**Vertical Scaling:**
- Upgrade server resources
- Database optimization
- Caching layer (Redis/Memcached)

**Database Sharding:**
- By city/region
- Separate database per geographic area

---

## Technology Decisions

### Why Laravel?
- ✅ Rapid development
- ✅ Built-in authentication
- ✅ Eloquent ORM
- ✅ Large community
- ✅ Great documentation

### Why SQLite (Development)?
- ✅ Zero configuration
- ✅ File-based (easy with Herd)
- ✅ Fast for development
- ✅ Easy to reset/seed

### Why Tailwind CSS?
- ✅ Utility-first approach
- ✅ Fast development
- ✅ Small bundle size
- ✅ Responsive by default

### Why Alpine.js?
- ✅ Lightweight (15kb)
- ✅ Vue-like syntax
- ✅ No build step required
- ✅ Perfect for Laravel

### Why Leaflet.js?
- ✅ Open-source
- ✅ Free (no API key)
- ✅ Lightweight
- ✅ Customizable

---

## Future Architecture Enhancements

1. **Microservices** (if scale requires)
   - Separate service for map/location
   - Separate service for reviews
   
2. **GraphQL API**
   - More efficient data fetching
   - Reduce over-fetching

3. **Real-time Features**
   - WebSockets (Laravel Echo)
   - Live notifications
   - Real-time analytics

4. **CDN Integration**
   - Cloudflare for static assets
   - Image optimization service

5. **Search Service**
   - Elasticsearch for full-text search
   - Faceted search

---

**Last Updated**: August 22, 2026  
**Architecture Version**: 1.0
