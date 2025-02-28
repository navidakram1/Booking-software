# GlamGo Changelog

All notable changes to the GlamGo project will be documented in this file.

## [Unreleased]

### Added
- Mobile-responsive header with animated menu
- Modern homepage layout with hero section
- Service listing and detail pages
- Gallery showcase section
- Contact form with validation
- Newsletter subscription component
- Reusable navigation components
- Lord Icons integration

### Changed
- Updated navigation structure for better UX
- Improved mobile menu animations
- Enhanced booking button placement

### Fixed
- Mobile menu animation issues
- Navigation link routing
- Header transparency on scroll
- Booking route definition

## [1.0.0] - 2025-02-28

### Added
- Initial release of GlamGo
- Basic salon booking functionality
- Service management system
- Staff/specialist profiles
- Appointment scheduling
- User authentication
- Admin dashboard
- Basic reporting

### Security
- SSL implementation
- Basic authentication
- Form validation
- CSRF protection

## Version Format

The versioning scheme we use is [SemVer](http://semver.org/).

Given a version number MAJOR.MINOR.PATCH, increment the:
1. MAJOR version when you make incompatible API changes
2. MINOR version when you add functionality in a backward compatible manner
3. PATCH version when you make backward compatible bug fixes

## Commit Message Format

Each commit message consists of a header, a body, and a footer:

```
<type>(<scope>): <subject>
<BLANK LINE>
<body>
<BLANK LINE>
<footer>
```

### Type
Must be one of the following:
- feat: A new feature
- fix: A bug fix
- docs: Documentation only changes
- style: Changes that do not affect the meaning of the code
- refactor: A code change that neither fixes a bug nor adds a feature
- perf: A code change that improves performance
- test: Adding missing tests
- chore: Changes to the build process or auxiliary tools

### Scope
The scope could be anything specifying the place of the commit change.

### Subject
The subject contains a succinct description of the change.

## Examples

```
feat(booking): add appointment confirmation emails

- Implement email notification system
- Add email templates
- Configure SMTP settings
```

```
fix(mobile): resolve menu animation glitch

- Update transition timing
- Fix z-index issues
- Improve touch response
```

## Release Process

1. Update version number in relevant files
2. Update CHANGELOG.md
3. Create release branch
4. Run tests
5. Build assets
6. Create tag
7. Deploy to production

## How to Update

To update your local project:

```bash
git pull origin main
composer install
npm install
php artisan migrate
npm run build
```
