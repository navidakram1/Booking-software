# GlamGo API Documentation

## API Overview
The GlamGo API provides programmatic access to salon booking functionality, services, and user management.

## Base URL
```
https://api.glamgo.com/v1
```

## Authentication
All API requests require authentication using Bearer token:
```
Authorization: Bearer {your_token}
```

## Endpoints

### Services

#### List Services
```http
GET /services
```

Parameters:
- `category` (optional): Filter by category
- `page` (optional): Page number for pagination
- `limit` (optional): Items per page

Response:
```json
{
    "data": [
        {
            "id": 1,
            "name": "Hair Styling",
            "description": "Professional hair styling service",
            "duration": 60,
            "price": 50.00,
            "category": "Hair",
            "image_url": "..."
        }
    ],
    "meta": {
        "current_page": 1,
        "total": 50,
        "per_page": 10
    }
}
```

#### Get Service Details
```http
GET /services/{id}
```

Response:
```json
{
    "id": 1,
    "name": "Hair Styling",
    "description": "Professional hair styling service",
    "duration": 60,
    "price": 50.00,
    "category": "Hair",
    "image_url": "...",
    "specialists": [...],
    "reviews": [...]
}
```

### Bookings

#### Create Booking
```http
POST /bookings
```

Request Body:
```json
{
    "service_id": 1,
    "specialist_id": 2,
    "date": "2025-03-01",
    "time": "14:00",
    "customer": {
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+1234567890"
    }
}
```

Response:
```json
{
    "id": 123,
    "status": "confirmed",
    "booking_reference": "BK123456",
    "service": {...},
    "specialist": {...},
    "datetime": "2025-03-01T14:00:00Z"
}
```

#### Get Booking Details
```http
GET /bookings/{id}
```

Response:
```json
{
    "id": 123,
    "status": "confirmed",
    "booking_reference": "BK123456",
    "service": {...},
    "specialist": {...},
    "datetime": "2025-03-01T14:00:00Z",
    "customer": {...}
}
```

### Specialists

#### List Specialists
```http
GET /specialists
```

Parameters:
- `service_id` (optional): Filter by service
- `date` (optional): Filter by availability date

Response:
```json
{
    "data": [
        {
            "id": 1,
            "name": "Jane Smith",
            "specialization": "Hair Stylist",
            "experience": "5 years",
            "image_url": "...",
            "services": [...]
        }
    ]
}
```

### Time Slots

#### Get Available Time Slots
```http
GET /time-slots
```

Parameters:
- `service_id`: Required
- `specialist_id`: Required
- `date`: Required (YYYY-MM-DD)

Response:
   ```json
   {
    "date": "2025-03-01",
    "slots": [
        {
            "time": "09:00",
            "available": true
        },
        {
            "time": "10:00",
            "available": false
        }
    ]
}
```

## Error Responses

### 400 Bad Request
   ```json
   {
    "error": "validation_error",
    "message": "The given data was invalid",
    "errors": {
        "field": ["Error message"]
     }
   }
   ```

### 401 Unauthorized
   ```json
   {
    "error": "unauthorized",
    "message": "Invalid or expired token"
}
```

### 404 Not Found
   ```json
   {
    "error": "not_found",
    "message": "Resource not found"
}
```

## Rate Limiting
- 1000 requests per hour per API token
- Rate limit headers included in response:
  - X-RateLimit-Limit
  - X-RateLimit-Remaining
  - X-RateLimit-Reset

## Webhooks
Webhooks are available for:
- Booking created
- Booking updated
- Booking cancelled
- Payment completed

## SDK Support
- PHP SDK: [GitHub Link]
- JavaScript SDK: [GitHub Link]
- Mobile SDKs: Coming soon

For additional support or questions, contact our API team at api@glamgo.com

## Authentication

### Login
- **POST** `/api/login`
- Authenticate user and get access token

### Logout
- **POST** `/api/logout`
- Invalidate current access token

## Admin Endpoints

### Profile Management
- **GET** `/api/admin/profile`
  - Get admin profile information
- **PUT** `/api/admin/profile`
  - Update admin profile
- **PUT** `/api/admin/profile/password`
  - Update admin password
- **POST** `/api/admin/profile/avatar`
  - Upload profile avatar

### Settings
- **GET** `/api/admin/settings`
  - Get all settings
- **GET** `/api/admin/settings/{section}`
  - Get specific settings section
- **PUT** `/api/admin/settings/{section}`
  - Update settings section

### Bookings
- **GET** `/api/admin/bookings`
  - List all bookings
- **GET** `/api/admin/bookings/{id}`
  - Get booking details
- **POST** `/api/admin/bookings`
  - Create new booking
- **PUT** `/api/admin/bookings/{id}`
  - Update booking
- **DELETE** `/api/admin/bookings/{id}`
  - Delete booking
- **PUT** `/api/admin/bookings/{id}/status`
  - Update booking status
- **PUT** `/api/admin/bookings/{id}/reschedule`
  - Reschedule booking

### Revenue
- **GET** `/api/admin/revenue`
  - Get revenue overview
- **GET** `/api/admin/revenue/daily`
  - Get daily revenue
- **GET** `/api/admin/revenue/monthly`
  - Get monthly revenue
- **GET** `/api/admin/revenue/yearly`
  - Get yearly revenue
- **GET** `/api/admin/revenue/export`
  - Export revenue report

## Public Endpoints

### Services
- **GET** `/api/services`
  - List all services
- **GET** `/api/services/{id}`
  - Get service details
- **GET** `/api/services/categories`
  - List service categories

### Specialists
- **GET** `/api/specialists`
  - List all specialists
- **GET** `/api/specialists/{id}`
  - Get specialist details
- **GET** `/api/specialists/{id}/schedule`
  - Get specialist schedule

### Bookings
- **POST** `/api/bookings`
  - Create new booking
- **GET** `/api/bookings/time-slots`
  - Get available time slots
- **GET** `/api/bookings/specialists/{serviceId}`
  - Get available specialists for service

## Response Format

```json
{
    "success": true,
    "data": {
        // Response data
    },
    "message": "Success message",
    "errors": {
        // Error details if any
    }
}
```

## Error Codes

- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 422: Validation Error
- 500: Server Error

## Authentication

All admin endpoints require authentication using Bearer token:

```http
Authorization: Bearer <token>
```

## Rate Limiting

API requests are limited to:
- 60 requests per minute for public endpoints
- 120 requests per minute for authenticated endpoints