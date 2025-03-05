# GlamGo - Beauty Salon Booking System

## Overview
GlamGo is a modern, full-featured beauty salon booking system built with Laravel and React. It provides an intuitive interface for customers to book appointments and for salon staff to manage their services, schedules, and customer relationships.

## Features
- Online booking system
- Service and specialist management
- Customer profiles and history
- Admin dashboard with analytics
- Automated notifications
- Payment processing
- Review and rating system

## Tech Stack
- Backend: Laravel 10.x
- Frontend: React with TypeScript
- Database: MySQL
- Authentication: Laravel Sanctum
- UI Framework: Tailwind CSS

## Installation

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL >= 8.0

### Setup Steps
1. Clone the repository
```bash
git clone https://github.com/yourusername/glamgo.git
cd glamgo
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

4. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Set up database
```bash
php artisan migrate
php artisan db:seed
```

6. Start development servers
```bash
php artisan serve
npm run dev
```

## Documentation
- [API Documentation](API_DOCS.md)
- [Features Documentation](FEATURES.md)
- [Testing Guide](TESTING.md)
- [Deployment Guide](DEPLOYMENT.md)
- [Work Tracking](WORK_TRACKING.md)

## Contributing
Please read our [Contributing Guidelines](CONTRIBUTING.md) before submitting pull requests.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.