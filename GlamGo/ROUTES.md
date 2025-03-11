# GlamGo Routes Documentation

This document provides a comprehensive list of all routes available in the GlamGo application.

## Table of Contents
- [Public Routes](#public-routes)
- [Authentication Routes](#authentication-routes)
- [Customer Routes](#customer-routes)
- [Booking Routes](#booking-routes)
- [Admin Routes](#admin-routes)
- [API Routes](#api-routes)

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

## Authentication Routes

### Customer Authentication
- `GET /login` - Show login form
- `POST /login` - Process login
- `POST /logout` - Logout user

### Admin Authentication
- `GET /admin/login` - Show admin login form
- `POST /admin/login` - Process admin login
- `POST /admin/logout` - Logout admin
- `GET /admin/check-session` - Check session timeout

## Customer Routes

### Dashboard & Profile
- `GET /customer/dashboard` - Customer dashboard
- `GET /customer/profile` - Customer profile
- `GET /customer/bookings` - Customer bookings
- `GET /customer/reviews` - Customer reviews
- `GET /customer/favorites` - Customer favorites

## Booking Routes

### Public Booking
- `GET /booking` - Booking form
- `POST /booking` - Create booking
- `GET /booking/specialists/{serviceId}` - Get specialists for service
- `GET /booking/time-slots` - Get available time slots

## Admin Routes

### Dashboard
- `GET /admin` - Admin dashboard
- `GET /admin/dashboard` - Admin dashboard (alternate)

### Bookings Management
- `GET /admin/bookings` - List all bookings
- `GET /admin/bookings/calendar` - Calendar view
- `GET /admin/bookings/create` - Create booking
- `POST /admin/bookings` - Store booking
- `GET /admin/bookings/{booking}/edit` - Edit booking
- `PUT /admin/bookings/{booking}` - Update booking
- `DELETE /admin/bookings/{booking}` - Delete booking
- `PUT /admin/bookings/{booking}/status` - Update booking status
- `PUT /admin/bookings/{booking}/reschedule` - Reschedule booking
- `PUT /admin/bookings/{booking}/cancel` - Cancel booking

### Services Management
- `GET /admin/services` - List services
- `GET /admin/services/create` - Create service form
- `POST /admin/services` - Store service
- `GET /admin/services/{service}/edit` - Edit service
- `PUT /admin/services/{service}` - Update service
- `DELETE /admin/services/{service}` - Delete service
- `GET /admin/services/search` - Search services

### Staff Management
- `GET /admin/staff` - List staff
- `GET /admin/staff/create` - Create staff form
- `POST /admin/staff` - Store staff
- `GET /admin/staff/{staff}/edit` - Edit staff
- `PUT /admin/staff/{staff}` - Update staff
- `DELETE /admin/staff/{staff}` - Delete staff

### Customer Management
- `GET /admin/customers` - List customers
- `GET /admin/customers/create` - Create customer form
- `POST /admin/customers` - Store customer
- `GET /admin/customers/{customer}/edit` - Edit customer
- `PUT /admin/customers/{customer}` - Update customer
- `DELETE /admin/customers/{customer}` - Delete customer

### Content Management

#### Pages
- `GET /admin/content/pages` - List pages
- `GET /admin/content/pages/create` - Create page
- `POST /admin/content/pages` - Store page
- `GET /admin/content/pages/{page}/edit` - Edit page
- `PUT /admin/content/pages/{page}` - Update page
- `DELETE /admin/content/pages/{page}` - Delete page

#### Blog
- `GET /admin/content/blog` - List blog posts
- `GET /admin/content/blog/create` - Create blog post
- `POST /admin/content/blog` - Store blog post
- `GET /admin/content/blog/{post}/edit` - Edit blog post
- `PUT /admin/content/blog/{post}` - Update blog post
- `DELETE /admin/content/blog/{post}` - Delete blog post

#### Gallery
- `GET /admin/content/gallery` - List gallery items
- `GET /admin/content/gallery/create` - Create gallery item
- `POST /admin/content/gallery` - Store gallery item
- `GET /admin/content/gallery/{image}/edit` - Edit gallery item
- `PUT /admin/content/gallery/{image}` - Update gallery item
- `DELETE /admin/content/gallery/{image}` - Delete gallery item

#### Testimonials
- `GET /admin/content/testimonials` - List testimonials
- `POST /admin/content/testimonials` - Store testimonial
- `GET /admin/content/testimonials/{testimonial}` - Show testimonial
- `PUT /admin/content/testimonials/{testimonial}` - Update testimonial
- `DELETE /admin/content/testimonials/{testimonial}` - Delete testimonial
- `POST /admin/content/testimonials/{testimonial}/approve` - Approve testimonial

## API Routes

### Authentication
- `GET /api/user` - Get authenticated user (requires Sanctum auth)

### Status
- `GET /api/status` - API status check

### Bookings
- `POST /api/bookings` - Create booking
- `GET /api/bookings/{booking}` - Get booking details
- `GET /api/bookings` - List bookings
- `POST /api/lock-slot` - Lock time slot
- `DELETE /api/release-lock/{lockId}` - Release locked slot
- `GET /api/bookings/check-availability` - Check availability
- `POST /api/bookings/book` - Book appointment

### Services
- `GET /api/services` - List services
- `GET /api/services/categories` - List service categories
- `GET /api/services/category/{categoryId}` - Get services by category
- `GET /api/service-categories` - Get all service categories with services
- `GET /api/service-addons` - List service add-ons

### Appointments
- `GET /api/appointments/check-availability` - Check appointment availability
- `POST /api/appointments/book` - Book appointment

### Staff/Specialists
- `GET /api/specialists` - List specialists
- `GET /api/staff/{id}` - Get staff profile
- `PUT /api/staff/{id}` - Update staff profile
- `GET /api/staff/{id}/availability` - Get staff availability
- `GET /api/staff/{id}/performance` - Get staff performance metrics

### Time Slots
- `GET /api/available-slots` - Get available time slots

## API v1 Routes

### Booking
- `GET /api/v1/services` - List services
- `POST /api/v1/check-availability` - Check availability
- `POST /api/v1/appointments` - Create appointment

### Staff
- `GET /api/v1/staff/{id}` - Get staff details
- `PUT /api/v1/staff/{id}` - Update staff details
- `GET /api/v1/staff/{id}/availability` - Get staff availability
- `GET /api/v1/staff/{id}/performance` - Get staff performance metrics 