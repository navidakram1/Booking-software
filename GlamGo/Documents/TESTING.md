# Testing Documentation

## Overview

This document outlines the testing procedures for the GlamGo salon management system. Testing is performed at multiple levels to ensure the quality and reliability of the application.

## Test Environment Setup

1. Clone the repository
2. Install dependencies: `composer install && npm install`
3. Copy `.env.example` to `.env.testing`
4. Configure test database in `.env.testing`
5. Run migrations: `php artisan migrate --env=testing`
6. Run seeders: `php artisan db:seed --env=testing`

## Unit Tests

### Admin Features

#### Profile Management
```php
php artisan test --filter=AdminProfileTest
```
- Test profile view
- Test profile update
- Test password change
- Test avatar upload

#### Settings Management
```php
php artisan test --filter=AdminSettingsTest
```
- Test settings retrieval
- Test settings update
- Test settings validation

#### Booking Management
```php
php artisan test --filter=AdminBookingTest
```
- Test booking list
- Test booking creation
- Test booking update
- Test booking deletion
- Test status changes
- Test rescheduling

#### Revenue Management
```php
php artisan test --filter=AdminRevenueTest
```
- Test revenue overview
- Test daily revenue
- Test monthly revenue
- Test yearly revenue
- Test revenue export

### Public Features

#### Services
```php
php artisan test --filter=ServiceTest
```
- Test service listing
- Test service details
- Test category listing

#### Specialists
```php
php artisan test --filter=SpecialistTest
```
- Test specialist listing
- Test specialist details
- Test schedule viewing

#### Bookings
```php
php artisan test --filter=BookingTest
```
- Test booking creation
- Test time slot availability
- Test specialist availability

## Integration Tests

### API Endpoints
```php
php artisan test --filter=ApiTest
```
- Test authentication
- Test admin endpoints
- Test public endpoints
- Test rate limiting
- Test error handling

### Frontend Integration
```php
php artisan dusk
```
- Test user flows
- Test admin dashboard
- Test booking process
- Test responsive design

## User Acceptance Testing (UAT)

### Admin Dashboard
1. Login to admin panel
2. Navigate through all sections
3. Test CRUD operations
4. Verify data accuracy
5. Test export functionality

### Booking System
1. Browse services
2. Select time slot
3. Choose specialist
4. Complete booking
5. Receive confirmation

### Revenue Reports
1. View daily reports
2. Generate monthly summary
3. Export yearly data
4. Verify calculations
5. Test filtering options

## Performance Testing

### Load Testing
Using Apache JMeter:
- Test concurrent users: 100
- Test response time < 2s
- Test error rate < 1%

### Security Testing
- SQL injection prevention
- XSS protection
- CSRF protection
- Rate limiting
- Input validation

## Automated Testing

### CI/CD Pipeline
```bash
# Run in GitHub Actions
composer test
npm run test
```

### Code Quality
```bash
# Run static analysis
./vendor/bin/phpstan analyse
# Run code style checks
./vendor/bin/php-cs-fixer fix --dry-run
```

## Bug Reporting

Report bugs using the following format:
```
Title: [Component] Brief description
Description:
- Steps to reproduce
- Expected behavior
- Actual behavior
- Screenshots/logs
Environment:
- Browser/OS
- PHP version
- Database version
```

## Test Coverage

Maintain minimum coverage:
- Unit Tests: 80%
- Integration Tests: 70%
- Feature Tests: 60%

Generate coverage report:
```bash
php artisan test --coverage-html reports/
```

## Service Search Functionality Testing

### 1. Search Filters Testing
- [ ] Test text search functionality
  - Search by service name
  - Search by service description
  - Search with partial matches
  - Search with special characters
  - Search with empty query

- [ ] Test category filter
  - Filter by Hair category
  - Filter by Nails category
  - Filter by Facial category
  - Filter by Massage category
  - Test with no category selected

- [ ] Test status filter
  - Filter active services
  - Filter inactive services
  - Test with no status selected

- [ ] Test price range filter
  - Filter services under $50
  - Filter services between $51-$150
  - Filter services over $150
  - Test with no price range selected

### 2. Combined Filters Testing
- [ ] Test multiple filter combinations
  - Text search + category
  - Text search + status
  - Text search + price range
  - Category + status
  - Category + price range
  - Status + price range
  - All filters combined

### 3. UI/UX Testing
- [ ] Test search form responsiveness
  - Desktop view
  - Tablet view
  - Mobile view

- [ ] Test form elements
  - Input field validation
  - Dropdown selections
  - Search button functionality
  - Reset button functionality

- [ ] Test results display
  - Table responsiveness
  - Pagination functionality
  - Empty results message
  - Loading states

### 4. Performance Testing
- [ ] Test search response time
  - With no filters
  - With single filter
  - With multiple filters
  - With large dataset

- [ ] Test pagination performance
  - First page load
  - Subsequent page loads
  - Edge cases (last page)

### 5. Security Testing
- [ ] Test input validation
  - SQL injection attempts
  - XSS attempts
  - Special character handling

- [ ] Test access control
  - Unauthorized access attempts
  - Session handling
  - CSRF protection

### 6. Edge Cases
- [ ] Test boundary conditions
  - Maximum text length
  - Special characters in search
  - Empty results handling
  - Network error handling

### 7. Browser Compatibility
- [ ] Test on different browsers
  - Chrome
  - Firefox
  - Safari
  - Edge

### 8. Integration Testing
- [ ] Test with related features
  - Service creation
  - Service editing
  - Service deletion
  - Status updates

### 9. Data Integrity
- [ ] Verify search results
  - Accuracy of filters
  - Data consistency
  - Real-time updates

### 10. Error Handling
- [ ] Test error scenarios
  - Invalid input handling
  - Database connection issues
  - Timeout handling
  - Error message display

## Test Cases

### Basic Search Test Cases
```php
public function test_basic_search_functionality()
{
    // Test text search
    $response = $this->get('/admin/services/search?query=haircut');
    $response->assertStatus(200);
    $response->assertViewHas('services');

    // Test category filter
    $response = $this->get('/admin/services/search?category=hair');
    $response->assertStatus(200);
    $response->assertViewHas('services');

    // Test status filter
    $response = $this->get('/admin/services/search?status=active');
    $response->assertStatus(200);
    $response->assertViewHas('services');

    // Test price range filter
    $response = $this->get('/admin/services/search?price_range=low');
    $response->assertStatus(200);
    $response->assertViewHas('services');
}
```

### Combined Filters Test Cases
```php
public function test_combined_filters()
{
    // Test multiple filters
    $response = $this->get('/admin/services/search?query=haircut&category=hair&status=active&price_range=medium');
    $response->assertStatus(200);
    $response->assertViewHas('services');

    // Test empty results
    $response = $this->get('/admin/services/search?query=nonexistent&category=invalid');
    $response->assertStatus(200);
    $response->assertViewHas('services');
    $response->assertSee('No services found');
}
```

### Security Test Cases
```php
public function test_security_measures()
{
    // Test SQL injection prevention
    $response = $this->get('/admin/services/search?query=" OR "1"="1');
    $response->assertStatus(200);
    $response->assertViewHas('services');

    // Test XSS prevention
    $response = $this->get('/admin/services/search?query=<script>alert("xss")</script>');
    $response->assertStatus(200);
    $response->assertDontSee('<script>');
}
```

### Performance Test Cases
```php
public function test_search_performance()
{
    // Test response time
    $start = microtime(true);
    $response = $this->get('/admin/services/search');
    $end = microtime(true);
    
    $this->assertLessThan(1, $end - $start); // Should respond within 1 second

    // Test pagination performance
    $response = $this->get('/admin/services/search?page=2');
    $response->assertStatus(200);
    $response->assertViewHas('services');
}
```

## Test Data Setup

### Database Seeder
```php
public function run()
{
    // Create test services
    Service::factory()->count(50)->create([
        'category' => 'hair',
        'status' => 'active',
        'price' => rand(30, 200)
    ]);

    Service::factory()->count(30)->create([
        'category' => 'nails',
        'status' => 'active',
        'price' => rand(20, 150)
    ]);

    // Create services with specific test cases
    Service::factory()->create([
        'name' => 'Test Haircut Service',
        'category' => 'hair',
        'status' => 'active',
        'price' => 45,
        'description' => 'A test service for search functionality'
    ]);
}
```

## Running Tests

### Command Line
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test --filter=ServiceSearchTest

# Run with coverage report
php artisan test --coverage-html coverage
```

### Test Environment Setup
1. Configure `.env.testing`:
```env
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

2. Update `phpunit.xml`:
```xml
<php>
    <env name="APP_ENV" value="testing"/>
    <env name="DB_CONNECTION" value="sqlite"/>
    <env name="DB_DATABASE" value=":memory:"/>
</php>
```

## Continuous Integration

### GitHub Actions Workflow
```yaml
name: Service Search Tests

on:
  push:
    branches: [ main ]
  pull_request:
    branches: [ main ]

jobs:
  test:
    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v2
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.1'
        
    - name: Install Dependencies
      run: composer install --prefer-dist --no-progress
      
    - name: Execute Tests
      run: php artisan test
```

## Test Reports

### Coverage Report
- Run coverage report:
```bash
php artisan test --coverage-html coverage
```
- View report at: `coverage/index.html`

### Test Results Format
```json
{
    "testsuites": {
        "testsuite": {
            "name": "Service Search Tests",
            "tests": 15,
            "failures": 0,
            "errors": 0,
            "time": "1.234"
        }
    }
}
```

## Maintenance

### Regular Testing Schedule
- Run full test suite daily
- Run critical path tests on every commit
- Run performance tests weekly

### Test Data Maintenance
- Refresh test data weekly
- Update test cases as features change
- Archive old test data monthly

### Documentation Updates
- Update test documentation when adding new features
- Review and update test cases quarterly
- Maintain test coverage reports
