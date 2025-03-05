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
    "start_time": "2025-03-01 14:00:00",
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
    "start_time": "2025-03-01T14:00:00Z",
    "rating": null,
    "rating_comment": null
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
    "start_time": "2025-03-01T14:00:00Z",
    "customer": {...},
    "rating": 5,
    "rating_comment": "Great service!"
}
```

#### Update Booking Rating
```http
POST /bookings/{id}/rating
```

Request Body:
```json
{
    "rating": 5,
    "comment": "Great service!"
}
```

Response:
```json
{
    "id": 123,
    "status": "completed",
    "rating": 5,
    "rating_comment": "Great service!"
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
- Rating submitted

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

## Admin Settings API Endpoints

### Security Settings

#### GET /admin/settings/security
- Description: Retrieve security settings configuration
- Authentication: Required (Admin)
- Response: Security settings view with current configuration

#### PUT /admin/settings/security
- Description: Update security settings
- Authentication: Required (Admin)
- Request Body:
  ```json
  {
    "require_uppercase": boolean,
    "require_numbers": boolean,
    "require_symbols": boolean,
    "min_password_length": integer (8-32),
    "enable_2fa": boolean,
    "force_password_change": boolean,
    "max_login_attempts": integer (3-10),
    "lockout_duration": integer (5-1440),
    "session_timeout": integer (5-1440),
    "force_https": boolean
  }
  ```

### Payment Settings

#### GET /admin/settings/payment
- Description: Retrieve payment settings configuration
- Authentication: Required (Admin)
- Response: Payment settings view with current configuration

#### PUT /admin/settings/payment
- Description: Update payment settings
- Authentication: Required (Admin)
- Request Body:
  ```json
  {
    "accept_cash": boolean,
    "accept_cards": boolean,
    "accept_online": boolean,
    "currency": string (3 chars),
    "currency_symbol_position": "before"|"after",
    "invoice_prefix": string (max 10 chars),
    "invoice_footer_text": string (max 1000 chars)
  }
  ```

## Real-Time Booking System

### WebSocket Events

#### Slot Availability Updates
```javascript
Event: 'slot.availability.changed'
Channel: 'bookings'
Data: {
  specialist_id: number,
  service_id: number,
  start_time: string,
  end_time: string,
  is_available: boolean
}
```

### Booking Endpoints

#### Get Available Slots
```http
GET /api/availability/slots

Query Parameters:
- service_id: number (required)
- specialist_id: number (required)
- date: string (required, format: YYYY-MM-DD)
- timezone: string (required)

Response:
{
  "slots": [
    {
      "start_time": "2025-03-03T09:00:00Z",
      "end_time": "2025-03-03T10:00:00Z",
      "formatted_time": "9:00 AM"
    }
  ]
}
```

#### Lock Time Slot
```http
POST /api/bookings/lock-slot

Request Body:
{
  "service_id": number,
  "specialist_id": number,
  "start_time": string,
  "end_time": string
}

Response:
{
  "lock_id": string,
  "expires_at": string
}
```

#### Release Lock
```http
DELETE /api/bookings/release-lock/{lock_id}

Response:
{
  "message": "Lock released successfully"
}
```

#### Validate Booking
```http
POST /api/bookings/validate

Request Body:
{
  "service_id": number,
  "specialist_id": number,
  "start_time": string,
  "customer_details": {
    "name": string,
    "email": string,
    "phone": string,
    "notes": string
  },
  "lock_id": string
}

Response:
{
  "is_valid": boolean,
  "message": string
}
```

#### Confirm Booking
```http
POST /api/bookings/confirm

Request Body:
{
  "service_id": number,
  "specialist_id": number,
  "start_time": string,
  "customer_details": {
    "name": string,
    "email": string,
    "phone": string,
    "notes": string
  },
  "lock_id": string
}

Response:
{
  "booking_id": number,
  "confirmation_code": string,
  "message": string
}
```

### Admin Endpoints

#### List Bookings
```http
GET /api/admin/bookings

Query Parameters:
- start_date: string (optional)
- status: string (optional)
- specialist_id: number (optional)
- page: number (optional)

Response:
{
  "bookings": [
    {
      "id": number,
      "confirmation_code": string,
      "service": object,
      "specialist": object,
      "customer_details": object,
      "start_time": string,
      "end_time": string,
      "status": string
    }
  ],
  "pagination": object
}
```

#### Update Booking Status
```http
PUT /api/admin/bookings/{booking}/status

Request Body:
{
  "status": string
}

Response:
{
  "message": string,
  "booking": object
}
```

#### Get Calendar View
```http
GET /api/admin/bookings/calendar

Query Parameters:
- start_date: string (optional)
- end_date: string (optional)

Response:
{
  "events": [
    {
      "id": number,
      "title": string,
      "start": string,
      "end": string,
      "color": string,
      "url": string
    }
  ]
}
```