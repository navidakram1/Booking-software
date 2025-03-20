# GlamGo Route Guide

## Quick Access URLs
```bash
# Main URLs
http://127.0.0.1:8000/login           # Main login page
http://127.0.0.1:8000/admin           # Admin dashboard (after login)
http://127.0.0.1:8000/customer        # Customer dashboard (after login)

# Default Admin Credentials
Email: admin@glamgo.com
Password: admin123
```

## Starting the Server Correctly
```bash
# Wrong way (will fail)
cd GlamGo && serve.bat

# Correct ways (use any of these)
cd GlamGo; php artisan serve
# OR
cd GlamGo; ./serve.bat
# OR
cd GlamGo
php artisan serve
```

## Route Flow Explained
1. All users start at `/login`
2. After successful login:
   - Admins → redirected to `/admin`
   - Customers → redirected to `/customer`

## Common Issues & Solutions

### 1. "Page Not Found"
- **Cause**: Server not running
- **Solution**: Run `cd GlamGo; php artisan serve`

### 2. "Route [password.request] not defined"
- **Cause**: Missing password reset routes
- **Solution**: Already fixed in web.php, just clear route cache:
  ```bash
  php artisan route:clear
  php artisan cache:clear
  ```

### 3. Can't Access Admin Dashboard
- **Check 1**: Are you logged in?
- **Check 2**: Are you using correct URL? (`/admin` not `/admin/dashboard`)
- **Check 3**: Does the admin user exist?
  ```bash
  # Check using debug route
  http://127.0.0.1:8000/debug-admin
  ```

### 4. Route Protection Levels
```php
Public Routes:      No authentication needed
├── /login         # Anyone can access
├── /register      # Anyone can access
└── /              # Homepage, public access

Protected Routes:   Requires login
├── /admin/*       # Requires admin role
└── /customer/*    # Requires customer role
```

## Complete Route Map

### Admin Routes
```bash
/admin                          # Dashboard home
├── /admin/bookings            # Booking management
│   ├── /calendar             # Calendar view
│   ├── /list                 # List view
│   └── /pending              # Pending bookings
├── /admin/services           # Service management
├── /admin/staff             # Staff management
├── /admin/customers         # Customer management
├── /admin/marketing         # Marketing tools
├── /admin/content           # Content management
├── /admin/analytics         # Analytics & reports
└── /admin/settings          # System settings
```

### Customer Routes
```bash
/customer                    # Customer dashboard
├── /dashboard              # Overview
├── /profile               # Profile settings
├── /bookings             # Booking history
├── /reviews              # Customer reviews
└── /favorites            # Favorite services
```

## Troubleshooting Steps

1. **Server Issues**
   ```bash
   # 1. Stop any running servers
   # 2. Clear all caches
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   # 3. Start server
   php artisan serve
   ```

2. **Database Issues**
   ```bash
   # Refresh database
   php artisan migrate:fresh --seed
   ```

3. **Permission Issues**
   ```bash
   # Check if admin exists
   http://127.0.0.1:8000/debug-admin
   ```

## Best Practices

1. Always use `127.0.0.1:8000` instead of `localhost:8000`
2. Clear cache after route changes
3. Check debug route if login fails
4. Use incognito mode for testing
5. Keep server running in dedicated terminal 