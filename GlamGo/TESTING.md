# Testing Documentation

## Quick Navigation
- [Features](FEATURES.md) - Features to test
- [API Documentation](API_DOCS.md) - API endpoints to test
- [Work Tracking](WORK_TRACKING.md) - Development progress
- [Deployment Guide](DEPLOYMENT.md) - Testing in production

## Development URLs
- Frontend: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- API Base URL: [http://127.0.0.1:8000/api/v1](http://127.0.0.1:8000/api/v1)
- Test Coverage Report: [http://127.0.0.1:8000/coverage](http://127.0.0.1:8000/coverage) (Coming Soon)

## Testing Stack
- PHPUnit for PHP unit testing
- Laravel's built-in testing utilities
- Jest for JavaScript testing
- Cypress for end-to-end testing

## Test Categories

### Unit Tests
- Controllers
- Models
- Services
- Helpers
- Middleware

### Feature Tests
- Authentication flows
- Booking process
- Admin operations
- User operations
- API endpoints

### Integration Tests
- Database operations
- External service integrations
- Email sending
- Payment processing

### End-to-End Tests
- User registration flow
- Booking appointment flow
- Admin dashboard operations
- Payment flow

## Running Tests

### PHP Tests
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit

# Run specific test file
php artisan test tests/Feature/BookingTest.php
```

### JavaScript Tests
```bash
# Run Jest tests
npm run test

# Run Cypress tests
npm run cypress:open
npm run cypress:run
```

## Test Coverage
- Generate coverage report:
```bash
php artisan test --coverage-html reports/
```

## Continuous Integration
Tests are automatically run on:
- Every pull request
- Every merge to main branch
- Every release tag

## Test Environment
- Uses SQLite database
- Mocked external services
- Seeded test data
