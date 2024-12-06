# GlamGo - Modern Salon Booking Platform

![GlamGo Banner](public/images/logo.png)

A sophisticated salon booking platform built with Laravel 11, featuring a modern UI and seamless booking experience.

## 🌟 Features

### 📱 Modern User Interface
- Responsive design for all devices
- Glass-morphism effects
- Gradient color schemes
- Smooth animations
- Interactive components

### 🎨 Design System
- **Color Palette**
  - Primary Pink: #ec4899
  - Primary Purple: #9333ea
  - Gradient: Pink to Purple
- **Typography**: Poppins Font Family
- **Components**: Modern, glass-morphic design

### 🚀 Key Features
1. **Interactive Booking System**
   - Real-time availability
   - Service selection
   - Stylist booking
   - Date/time picker

2. **Gallery Showcase**
   - Masonry layout
   - Hover animations
   - Image captions
   - Lightbox view

3. **Blog Section**
   - Latest beauty tips
   - Trending styles
   - Expert advice
   - Category filtering

4. **Service Sections**
   - Detailed service listings
   - Pricing information
   - Service descriptions
   - Category filtering

5. **Specialist Profiles**
   - Team showcase
   - Expertise details
   - Availability status
   - Booking integration

6. **Live Queue System**
   - Real-time updates
   - Queue position
   - Wait time estimates
   - SMS notifications

7. **Contact & Support**
   - Contact form
   - Location map
   - Business hours
   - Social media links

8. **FAQ Section**
   - Common questions
   - Searchable answers
   - Category organization
   - Quick navigation

## 📑 Page Structure

### 1. Customer-Facing Pages
- **Home Page** (`/`)
  - Hero section with booking CTA
  - Featured services
  - Testimonials
  - Latest work gallery
  - Team highlights

- **Services Page** (`/services`)
  - Service categories
  - Detailed service listings
  - Pricing information
  - Booking integration

- **Booking Page** (`/booking`)
  - Service selection
  - Stylist selection
  - Date/time picker
  - Customer details form
  - Payment integration

- **Gallery Page** (`/gallery`)
  - Work showcase
  - Before/after transformations
  - Category filters
  - Lightbox view

- **Specialists Page** (`/specialists`)
  - Team profiles
  - Expertise details
  - Available time slots
  - Direct booking option

- **Blog Page** (`/blog`)
  - Beauty articles
  - Style tips
  - Industry news
  - Category filters

- **Contact Page** (`/contact`)
  - Contact form
  - Location map
  - Business hours
  - Social media links

- **About Us Page** (`/about`)
  - Salon story
  - Mission & vision
  - Team overview
  - Achievements

### 2. Customer Account Pages
- **Profile** (`/profile`)
  - Personal details
  - Booking history
  - Favorite services
  - Saved stylists

- **Appointments** (`/appointments`)
  - Upcoming bookings
  - Past appointments
  - Cancellation/Rescheduling
  - Reviews & ratings

### 3. Authentication Pages
- **Login** (`/login`)
- **Register** (`/register`)
- **Password Reset** (`/password/reset`)
- **Email Verification** (`/email/verify`)

### 4. Admin Dashboard Pages
- **Dashboard** (`/admin`)
  - Overview statistics
  - Recent bookings
  - Revenue charts
  - Quick actions

- **Appointment Management** (`/admin/appointments`)
  - Booking calendar
  - Schedule management
  - Customer details
  - Service history

- **Service Management** (`/admin/services`)
  - Service CRUD
  - Pricing updates
  - Category management
  - Special offers

- **Staff Management** (`/admin/staff`)
  - Staff profiles
  - Schedule setting
  - Performance metrics
  - Commission tracking

- **Customer Management** (`/admin/customers`)
  - Customer database
  - Booking history
  - Communication logs
  - Loyalty points

- **Reports** (`/admin/reports`)
  - Revenue reports
  - Service analytics
  - Staff performance
  - Customer insights

## 🚀 Development Status
- ✅ Project Setup
- ✅ Design System Implementation
- ✅ Home Page Development
- ✅ Services Page Development
- 🟡 Booking System Integration
- 🟡 Authentication System
- ⭕ Admin Dashboard
- ⭕ Payment Integration
- ⭕ Email Notifications
- ⭕ SMS Notifications

## 🛠 Technical Stack

### Frontend
- Blade Templates
- Tailwind CSS
- Alpine.js
- JavaScript
- Lord Icons
- Swiper.js

### Backend
- Laravel 11
- PHP 8.2+
- MySQL
- RESTful API

## 📦 Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/GlamGo.git
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Set up database:
```bash
php artisan migrate
php artisan db:seed
```

5. Start development server:
```bash
php artisan serve
npm run dev
```

## 📦 Simple Hostinger Deployment Guide

### Prerequisites
- A Hostinger hosting plan (Premium or Business recommended)
- Domain name configured
- Hostinger Control Panel access

### Step 1: Upload Files
1. Download the complete GlamGo project zip file
2. Login to Hostinger Control Panel
3. Open File Manager
4. Navigate to `public_html`
5. Upload the zip file and extract it

### Step 2: Database Setup
1. In Hostinger Control Panel, go to "MySQL Databases"
2. Create a new database and user
3. Note down the database details:
   - Database name
   - Username
   - Password
   - Host (usually localhost)

### Step 3: Configure Environment
1. Rename `.env.example` to `.env`
2. Update these important settings:
```env
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### Step 4: Set Permissions
In File Manager:
1. Right-click on `storage` folder → select "Change Permissions" → set to 755
2. Right-click on `bootstrap/cache` folder → set to 755
3. Right-click on `.env` file → set to 644

### Step 5: Configure Domain
1. In Hostinger Control Panel, go to "Domains"
2. Point your domain to `public_html/public` folder
3. Enable SSL (Free Let's Encrypt)

### Common Issues & Solutions
1. **White Screen or 500 Error**
   - Check `.env` file exists and has correct permissions
   - Verify database details are correct
   - Contact Hostinger support for PHP settings check

2. **Images Not Loading**
   - Make sure all image files are uploaded
   - Check image paths in code
   - Verify folder permissions

3. **Can't Access Website**
   - Confirm domain is pointed correctly
   - Wait for DNS propagation (up to 24 hours)
   - Check SSL is enabled

### Need Help?
- Contact Hostinger 24/7 support
- They can help with:
  - PHP configuration
  - Database setup
  - Domain pointing
  - SSL setup

## 🎯 Future Enhancements
- Online payment integration
- Customer loyalty program
- Mobile app development
- AI-powered style recommendations
- Multi-language support
- Advanced analytics dashboard

## 🔒 Security
- CSRF protection
- XSS prevention
- SQL injection protection
- Input validation
- Secure authentication

## 📄 License
[MIT License](LICENSE.md)

## 👥 Contributors
- [Your Name]
- [Other Contributors]

## 📞 Support
For support, email support@glamgo.com or open an issue in the repository.

---
Made with ❤️ by GlamGo Team
