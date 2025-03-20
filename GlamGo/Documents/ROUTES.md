# GlamGo Routes Documentation

This document provides a comprehensive list of all routes available in the GlamGo application.

## Table of Contents
- [Authentication Routes](#authentication-routes)
- [Public Routes](#public-routes)
- [Customer Routes](#customer-routes)
- [Admin Routes](#admin-routes)
- [API Routes](#api-routes)

## Authentication Routes

### Login & Registration
- `GET /login` - Show login form
- `POST /login` - Process login
- `GET /register` - Show registration form
- `POST /register` - Process registration

### Password Reset
- `GET /forgot-password` - Show password reset request form
- `POST /forgot-password` - Send password reset link
- `GET /reset-password/{token}` - Show password reset form
- `POST /reset-password` - Process password reset

### Email Verification
- `GET /verify-email` - Show email verification notice
- `GET /verify-email/{id}/{hash}` - Verify email
- `POST /email/verification-notification` - Resend verification email

### Session Management
- `POST /logout` - Logout user
- `GET /confirm-password` - Show password confirmation form
- `POST /confirm-password` - Confirm password
- `PUT /password` - Update password

## Public Routes

### Main Pages
- `GET /` - Home page
- `GET /about` - About page
- `GET /contact` - Contact page
- `GET /services` - Services listing
- `GET /services/{service}` - Individual service details
- `GET /specialists` - Specialists listing
- `GET /gallery` - Gallery page
- `GET /blog` - Blog listing
- `GET /help` - Help center

### Legal Pages
- `GET /privacy` - Privacy policy
- `GET /terms` - Terms of service
- `GET /cookies` - Cookie policy

### Contact
- `POST /contact/send` - Send contact form

## Customer Routes

### Dashboard & Profile
- `GET /customer/dashboard` - Customer dashboard
- `GET /customer/profile` - Customer profile
- `GET /customer/bookings` - Customer bookings
- `GET /customer/reviews` - Customer reviews
- `GET /customer/favorites` - Customer favorites

## Admin Routes

### Dashboard
- `GET /admin` - Admin dashboard
- `POST /admin/check-session` - Check session status

### Bookings Management
- `GET /admin/bookings` - Bookings overview
- `GET /admin/bookings/calendar` - Calendar view
- `GET /admin/bookings/list` - List view
- `GET /admin/bookings/pending` - Pending bookings
- `GET /admin/bookings/create` - Create booking
- `POST /admin/bookings` - Store booking
- `GET /admin/bookings/{booking}` - View booking
- `GET /admin/bookings/{booking}/edit` - Edit booking
- `PUT /admin/bookings/{booking}` - Update booking
- `DELETE /admin/bookings/{booking}` - Delete booking
- `POST /admin/bookings/{booking}/status` - Update status
- `POST /admin/bookings/{booking}/reschedule` - Reschedule booking
- `GET /admin/bookings/export` - Export bookings

### Services Management
- `GET /admin/services` - Services overview
- `GET /admin/services/categories` - Service categories
- `GET /admin/services/offers` - Special offers
- `GET /admin/services/catalog` - Service catalog

### Staff Management
- `GET /admin/staff` - Staff overview
- `GET /admin/staff/list` - Staff list
- `GET /admin/staff/schedule` - Staff schedules
- `GET /admin/staff/performance` - Performance metrics

### Customer Management
- `GET /admin/customers` - Customer overview
- `GET /admin/customers/list` - Customer list
- `GET /admin/customers/loyalty` - Loyalty program
- `GET /admin/customers/communications` - Communications

### Marketing
- `GET /admin/marketing/campaigns` - Email campaigns
- `GET /admin/marketing/sms` - SMS marketing
- `GET /admin/marketing/promotions` - Promotions

### Content Management
- `GET /admin/content/gallery` - Gallery management
- `GET /admin/content/blog` - Blog management
- `GET /admin/content/testimonials` - Testimonials

### Analytics
- `GET /admin/analytics/revenue` - Revenue analytics
- `GET /admin/analytics/bookings` - Booking analytics
- `GET /admin/analytics/customers` - Customer analytics
- `GET /admin/analytics/revenue/export` - Export revenue data

### Settings
- `GET /admin/settings/business` - Business settings
- `GET /admin/settings/integrations` - Integration settings
- `GET /admin/settings/security` - Security settings

## API Routes

### Authentication
- `GET /api/user` - Get authenticated user

### Booking
- `POST /api/bookings` - Create booking
- `GET /api/bookings/{booking}` - Get booking details
- `GET /api/bookings` - List bookings
- `GET /api/bookings/check-availability` - Check availability
- `POST /api/bookings/book` - Book appointment

### Services
- `GET /api/services` - List services
- `GET /api/services/categories` - List categories
- `GET /api/service-addons` - List add-ons

### Staff
- `GET /api/specialists` - List specialists
- `GET /api/available-slots` - Get available slots

### v1 API Routes
- `GET /api/v1/services` - List services
- `POST /api/v1/check-availability` - Check availability
- `POST /api/v1/appointments` - Create appointment 