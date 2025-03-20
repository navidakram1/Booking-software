# GlamGo Booking Software

A modern booking and management system for beauty salons and spas.

## Features
- Unified authentication system for admins and customers
- Comprehensive booking management
- Service and staff management
- Customer relationship management
- Marketing tools
- Analytics and reporting
- Content management

## Requirements
- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js and NPM

## Quick Start
1. Clone the repository
2. Run `setup.bat` for first-time installation
3. Run `serve.bat` to start the development server
4. Visit http://localhost:8000

## Default Login Credentials
Email: admin@glamgo.com
Password: admin123

## Development
- Use `serve.bat` for local development
- All changes are tracked in WORK_TRACKING.md
- Features are documented in FEATURES.md
- Follow the coding standards in CONTRIBUTING.md

## Directory Structure
```
GlamGo/
├── app/               # Application core code
├── config/           # Configuration files
├── database/         # Migrations and seeders
├── public/           # Public assets
├── resources/        # Views and assets
├── routes/           # Route definitions
├── storage/          # Application storage
├── tests/            # Test cases
├── setup.bat         # First-time setup script
└── serve.bat         # Development server script
```

## Authentication System
The system uses a unified login system that:
- Provides a single entry point for all users
- Automatically redirects to appropriate dashboard based on role
- Maintains secure session management
- Includes remember me functionality
- Supports password reset and email verification

## Contributing
Please read CONTRIBUTING.md for details on our code of conduct and the process for submitting pull requests.

## License
This project is licensed under the MIT License - see the LICENSE.md file for details.

## Support
For support, please email support@glamgo.com
