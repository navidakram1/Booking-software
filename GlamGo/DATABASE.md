# GlamGo Database Documentation

## Database Overview
- **Name**: glamgo
- **Type**: MySQL
- **Character Set**: utf8mb4
- **Collation**: utf8mb4_unicode_ci

## Connection Details
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=glamgo
DB_USERNAME=root
```

## Key Tables and Relationships

### Core Tables
1. **users**
   - Primary authentication table
   - Related to: staff, customers

2. **categories**
   - Service categories
   - Related to: services

3. **services**
   - Main services offered
   - Related to: bookings, reviews, service_packages

4. **bookings**
   - Customer bookings
   - Related to: customers, services, staff
   - Includes: rating, rating_comment fields for feedback

### Customer Management
1. **customers**
   - Customer profiles
   - Related to: bookings, reviews, loyalty_points

2. **customer_preferences**
   - Customer settings and preferences
   - Related to: customers

3. **loyalty_points**
   - Customer reward system
   - Related to: customers, services

### Staff Management
1. **staff**
   - Staff profiles and details
   - Related to: services, bookings

2. **team_members**
   - Team member profiles
   - Related to: services, events

// ... existing code ...