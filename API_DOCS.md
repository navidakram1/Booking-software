# GlamGo API Documentation

## Authentication

### Login
```http
POST /api/auth/login
```

**Request Body:**
```json
{
    "email": "user@example.com",
    "password": "password"
}
```

**Response:**
```json
{
    "token": "your-access-token",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "user@example.com"
    }
}
```

## Booking Endpoints

### Get Available Time Slots
```http
GET /api/bookings/available-slots
```

**Parameters:**
- `service_id` (required): ID of the service
- `specialist_id` (required): ID of the specialist
- `date` (required): Date in Y-m-d format

**Response:**
```json
{
    "slots": [
        {
            "start_time": "2024-03-04 09:00:00",
            "end_time": "2024-03-04 10:00:00",
            "is_available": true
        }
    ]
}
```

### Create Booking
```http
POST /api/bookings
```

**Request Body:**
```json
{
    "service_id": 1,
    "specialist_id": 1,
    "start_time": "2024-03-04 09:00:00",
    "customer_details": {
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+1234567890"
    }
}
```

## Service Endpoints

### List Services
```http
GET /api/services
```

**Parameters:**
- `category_id` (optional): Filter by category
- `specialist_id` (optional): Filter by specialist

**Response:**
```json
{
    "services": [
        {
            "id": 1,
            "name": "Haircut",
            "description": "Professional haircut service",
            "price": 50.00,
            "duration": 60
        }
    ]
}
```

## Specialist Endpoints

### List Specialists
```http
GET /api/specialists
```

**Parameters:**
- `service_id` (optional): Filter by service

**Response:**
```json
{
    "specialists": [
        {
            "id": 1,
            "name": "Jane Smith",
            "title": "Senior Stylist",
            "services": [
                {
                    "id": 1,
                    "name": "Haircut"
                }
            ]
        }
    ]
}
```

## Customer Endpoints

### Get Customer Profile
```http
GET /api/customer/profile
```

**Response:**
```json
{
    "customer": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+1234567890",
        "bookings": [
            {
                "id": 1,
                "service": "Haircut",
                "date": "2024-03-04",
                "status": "confirmed"
            }
        ]
    }
}
```

## Error Responses

### 400 Bad Request
```json
{
    "error": "Validation failed",
    "messages": {
        "email": ["The email field is required"]
    }
}
```

### 401 Unauthorized
```json
{
    "error": "Unauthorized",
    "message": "Invalid credentials"
}
```

### 404 Not Found
```json
{
    "error": "Not found",
    "message": "Resource not found"
}
```

## Rate Limiting
- API requests are limited to 60 per minute per user
- Rate limit headers are included in responses:
  - X-RateLimit-Limit
  - X-RateLimit-Remaining
  - X-RateLimit-Reset

## Versioning
Current API version: v1
Base URL: `/api/v1`