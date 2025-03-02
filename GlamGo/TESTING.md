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
