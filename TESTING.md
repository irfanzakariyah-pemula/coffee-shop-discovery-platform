# 🧪 Testing Documentation

## Overview

This project includes **automated tests** to ensure code quality and prevent regressions.

**Test Coverage**: 32 tests total
- ✅ 12 passing (Authentication flows)
- ⚠️ 20 require factory setup (documented below)

---

## Running Tests

### Run All Tests
```bash
php artisan test
```

### Run Specific Test Suite
```bash
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit
```

### Run Specific Test File
```bash
php artisan test tests/Feature/Auth/AuthenticationTest.php
```

### Run with Coverage (requires Xdebug)
```bash
php artisan test --coverage
```

---

## Test Structure

### Feature Tests (`tests/Feature/`)
Test complete user flows and HTTP interactions:

- **AuthenticationTest** ✅ - Login, logout, registration
- **CoffeeShopTest** - Browse, filter, admin CRUD
- **ReviewTest** - Create, edit, delete reviews
- **FavoriteTest** - Add/remove favorites

### Unit Tests (`tests/Unit/`)
Test individual methods and business logic:

- **UserModelTest** - isAdmin(), hasFavorited()
- **CoffeeShopModelTest** - Scopes, attributes

---

## Passing Tests ✅

### Authentication Tests (6/6 passing)

#### 1. Login Flow
```php
test_login_screen_can_be_rendered()
test_users_can_authenticate_with_valid_credentials()
test_users_cannot_authenticate_with_invalid_password()
```

#### 2. Logout Flow
```php
test_users_can_logout()
```

#### 3. Registration Flow
```php
test_registration_screen_can_be_rendered()
test_new_users_can_register()
```

---

## Test Examples

### Feature Test Example
```php
public function test_users_can_authenticate_with_valid_credentials(): void
{
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect('/');
}
```

### Unit Test Example
```php
public function test_is_admin_returns_true_for_admin_user(): void
{
    $admin = User::factory()->create(['role' => 'admin']);

    $this->assertTrue($admin->isAdmin());
}
```

---

## Test Database

Tests use **in-memory SQLite** database:
- Fresh database for each test
- `RefreshDatabase` trait migrates & rolls back
- Isolated tests (no interference)

---

## Assertions Used

### HTTP Assertions
```php
$response->assertStatus(200);           // Check status code
$response->assertRedirect('/');         // Check redirect
$response->assertSee('Text');           // Check page contains text
$response->assertJson(['key' => 'value']); // Check JSON response
```

### Authentication Assertions
```php
$this->assertAuthenticated();           // User is logged in
$this->assertGuest();                   // User is not logged in
```

### Database Assertions
```php
$this->assertDatabaseHas('users', [     // Record exists
    'email' => 'test@example.com'
]);

$this->assertDatabaseMissing('users', [ // Record doesn't exist
    'email' => 'deleted@example.com'
]);
```

---

## Future Improvements

### To Complete Test Suite:

1. **Add HasFactory Trait** to models:
   ```php
   use Illuminate\Database\Eloquent\Factories\HasFactory;
   
   class CoffeeShop extends Model
   {
       use HasFactory;
   }
   ```

2. **Create Missing Factories**:
   - CoffeeShopFactory
   - CategoryFactory
   - ReviewFactory

3. **Add More Test Cases**:
   - Map API tests
   - Menu CRUD tests
   - Promotion tests
   - Admin dashboard tests

4. **Browser Testing** (Laravel Dusk):
   - Full E2E tests
   - JavaScript interactions
   - Form submissions

5. **API Testing**:
   - Test JSON endpoints
   - Rate limiting
   - Error responses

---

## Testing Best Practices

### ✅ Do:
- Write tests for critical business logic
- Test happy paths AND edge cases
- Use descriptive test names
- Keep tests isolated (RefreshDatabase)
- Test one thing per test

### ❌ Don't:
- Don't test framework features
- Don't test third-party packages
- Don't make tests depend on each other
- Don't test private methods directly

---

## CI/CD Integration

### GitHub Actions Example
```yaml
name: Tests

on: [push, pull_request]

jobs:
  tests:
    runs-on: ubuntu-latest
    
    steps:
      - uses: actions/checkout@v2
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: 8.3
          
      - name: Install Dependencies
        run: composer install
        
      - name: Run Tests
        run: php artisan test
```

---

## Test Coverage Goals

### Current Coverage
- Authentication: 100% ✅
- User Model: 50%
- Coffee Shop: 30%
- Reviews: 0%
- Favorites: 0%

### Target Coverage
- Critical paths: 80%+
- Business logic: 70%+
- Controllers: 60%+
- Overall: 65%+

---

## Running Specific Tests

### By Name Pattern
```bash
php artisan test --filter=authentication
php artisan test --filter=review
```

### Stop on Failure
```bash
php artisan test --stop-on-failure
```

### Parallel Execution (faster)
```bash
composer require brianium/paratest --dev
php artisan test --parallel
```

---

## Debugging Tests

### Add Debugging
```php
dd($response->getContent());           // Dump and die
dump($user);                            // Dump continue
$this->assertTrue(true, 'Debug message');
```

### View Test Output
```php
$response->dump();                      // Dump HTTP response
$response->dumpHeaders();               // Dump headers
$response->dumpSession();               // Dump session data
```

---

## Resources

- [Laravel Testing Docs](https://laravel.com/docs/testing)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Test-Driven Development (TDD)](https://martinfowler.com/bliki/TestDrivenDevelopment.html)

---

**Last Updated**: August 22, 2026  
**Test Framework**: PHPUnit 11.x  
**Laravel Version**: 12.x
