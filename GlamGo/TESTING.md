# GlamGo Testing Guide

## Testing Overview

This document outlines the testing procedures and guidelines for the GlamGo salon booking system.

## Testing Environment Setup

1. Clone the repository
```bash
git clone https://github.com/yourusername/glamgo.git
cd glamgo
```

2. Install dependencies
```bash
composer install
npm install
```

3. Create test database
```bash
php artisan db:create --env=testing
php artisan migrate --env=testing
php artisan db:seed --env=testing
```

## Types of Tests

### 1. Unit Tests

Location: `tests/Unit`

Run unit tests:
```bash
php artisan test --testsuite=Unit
```

Key areas covered:
- Models
- Services
- Helpers
- Utilities

### 2. Feature Tests

Location: `tests/Feature`

Run feature tests:
```bash
php artisan test --testsuite=Feature
```

Key areas covered:
- Controllers
- Middleware
- Routes
- Form Requests

### 3. Integration Tests

Location: `tests/Integration`

Run integration tests:
```bash
php artisan test --testsuite=Integration
```

Key areas covered:
- API Endpoints
- Database Interactions
- External Services
- Authentication Flow

### 4. Browser Tests

Location: `tests/Browser`

Run browser tests:
```bash
php artisan dusk
```

Key areas covered:
- User Interface
- JavaScript Functionality
- Form Submissions
- Navigation Flow

## Test Cases

### Frontend Components

1. Header
```php
public function test_header_navigation()
{
    $this->browse(function ($browser) {
        $browser->visit('/')
                ->assertSee('Home')
                ->assertSee('Services')
                ->assertSee('Book Now');
    });
}
```

2. Mobile Menu
```php
public function test_mobile_menu_functionality()
{
    $this->browse(function ($browser) {
        $browser->resize(375, 812)
                ->visit('/')
                ->click('#mobile-menu-button')
                ->assertVisible('#mobile-menu');
    });
}
```

### Booking System

1. Service Selection
```php
public function test_service_selection()
{
    $response = $this->get('/services');
    $response->assertStatus(200)
             ->assertViewHas('services');
}
```

2. Booking Creation
```php
public function test_booking_creation()
{
    $response = $this->post('/booking', [
        'service_id' => 1,
        'date' => '2025-03-01',
        'time' => '14:00'
    ]);
    
    $response->assertStatus(200)
             ->assertJson(['status' => 'success']);
}
```

## Performance Testing

### Load Testing

Using Apache JMeter:
1. Homepage load test
2. Booking system stress test
3. Service listing performance
4. Search functionality

### Response Time Benchmarks

- Homepage: < 2s
- Service Listing: < 1s
- Booking Creation: < 3s
- Search Results: < 1s

## Security Testing

### Authentication Tests

```php
public function test_user_authentication()
{
    $response = $this->post('/login', [
        'email' => 'test@example.com',
        'password' => 'password'
    ]);
    
    $response->assertStatus(200)
             ->assertAuthenticated();
}
```

### Authorization Tests

```php
public function test_admin_authorization()
{
    $this->actingAs($admin)
         ->get('/admin/dashboard')
         ->assertStatus(200);

    $this->actingAs($user)
         ->get('/admin/dashboard')
         ->assertStatus(403);
}
```

## API Testing

### Endpoint Testing

```php
public function test_services_api()
{
    $response = $this->getJson('/api/v1/services');
    
    $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     '*' => ['id', 'name', 'price']
                 ]
             ]);
}
```

## Continuous Integration

### GitHub Actions Workflow

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
      - name: Run Tests
        run: |
          composer install
          php artisan test
```

## Test Coverage

Generate coverage report:
```bash
php artisan test --coverage
```

Coverage goals:
- Models: 90%
- Controllers: 85%
- Services: 80%
- Overall: 75%

## Bug Reporting

Template:
```markdown
## Bug Description
[Clear description of the issue]

## Steps to Reproduce
1. Step 1
2. Step 2
3. Step 3

## Expected Behavior
[What should happen]

## Actual Behavior
[What actually happens]

## Environment
- Browser:
- OS:
- Screen Size:
```

## Testing Schedule

1. Unit Tests: Run on every commit
2. Feature Tests: Run on every PR
3. Integration Tests: Run daily
4. Performance Tests: Run weekly
5. Security Tests: Run bi-weekly

## Resources

- PHPUnit Documentation
- Laravel Dusk Guide
- JMeter Documentation
- Testing Best Practices
