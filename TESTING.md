# GlamGo Testing Documentation

## Testing Environment Setup

### Prerequisites
- PHPUnit for PHP testing
- Jest for JavaScript testing
- Laravel Dusk for browser testing
- MySQL test database

### Configuration
1. Create test database
```bash
mysql -u root -p
CREATE DATABASE glamgo_test;
```

2. Configure `.env.testing`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=glamgo_test
DB_USERNAME=root
DB_PASSWORD=
```

## Running Tests

### PHP Unit Tests
```bash
php artisan test
```

### JavaScript Tests
```bash
npm run test
```

### Browser Tests
```bash
php artisan dusk
```

## Test Categories

### 1. Unit Tests
- Models
- Services
- Helpers
- Utilities

### 2. Feature Tests
- Authentication
- Booking Process
- Service Management
- User Management
- Admin Functions

### 3. Integration Tests
- API Endpoints
- Database Operations
- External Services
- Payment Processing

### 4. Browser Tests
- User Flows
- Form Submissions
- JavaScript Interactions
- Responsive Design

## Test Coverage

### Critical Paths
- Booking Creation
- Payment Processing
- User Authentication
- Admin Operations
- Data Security

### Edge Cases
- Concurrent Bookings
- Failed Payments
- Network Issues
- Invalid Inputs
- Rate Limiting

## Writing Tests

### Unit Test Example
```php
public function test_can_create_booking()
{
    $booking = Booking::factory()->create();
    $this->assertDatabaseHas('bookings', [
        'id' => $booking->id
    ]);
}
```

### Feature Test Example
```php
public function test_user_can_book_appointment()
{
    $response = $this->post('/api/bookings', [
        'service_id' => 1,
        'specialist_id' => 1,
        'date' => '2024-03-04'
    ]);
    
    $response->assertStatus(201);
}
```

### Browser Test Example
```php
public function test_user_can_navigate_booking_flow()
{
    $this->browse(function ($browser) {
        $browser->visit('/bookings')
                ->select('service')
                ->select('specialist')
                ->click('.submit-booking')
                ->assertSee('Booking Confirmed');
    });
}
```

## Continuous Integration

### GitHub Actions Workflow
```yaml
name: Tests
on: [push, pull_request]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
      - name: Run Tests
        run: php artisan test
```

## Test Reports

### Coverage Reports
- Generate with `php artisan test --coverage`
- View in `tests/coverage/index.html`
- Minimum coverage: 80%

### Performance Metrics
- Response times
- Database queries
- Memory usage
- Load testing results