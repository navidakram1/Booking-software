# API Documentation

## Quick Navigation
- [Features](FEATURES.md) - Feature documentation
- [Testing Guide](TESTING.md) - API testing procedures
- [Deployment Guide](DEPLOYMENT.md) - API deployment
- [Work Tracking](WORK_TRACKING.md) - Development progress

## Development URLs
- API Base URL: [http://127.0.0.1:8000/api/v1](http://127.0.0.1:8000/api/v1)
- API Documentation: [http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation) (Coming Soon)

## Base URL
```
/api/v1
```

## Planned API Endpoints

### Authentication
```
POST /auth/register
POST /auth/login
POST /auth/logout
POST /auth/forgot-password
POST /auth/reset-password
```

### User Profile
```
GET    /profile
PUT    /profile
PUT    /profile/password
```

### Services
```
GET    /services
GET    /services/{id}
POST   /services          # Admin only
PUT    /services/{id}     # Admin only
DELETE /services/{id}     # Admin only
```

### Appointments
```
GET    /appointments
GET    /appointments/{id}
POST   /appointments
PUT    /appointments/{id}
DELETE /appointments/{id}
```

### Specialists
```
GET    /specialists
GET    /specialists/{id}
POST   /specialists       # Admin only
PUT    /specialists/{id}  # Admin only
DELETE /specialists/{id}  # Admin only
```

### Reviews
```
GET    /reviews
GET    /reviews/{id}
POST   /reviews
PUT    /reviews/{id}
DELETE /reviews/{id}
```

## Response Format
All API responses will follow this standard format:

### Success Response
```json
{
    "status": "success",
    "data": {
        // Response data here
    },
    "message": "Operation successful"
}
```

### Error Response
```json
{
    "status": "error",
    "error": {
        "code": "ERROR_CODE",
        "message": "Error description"
    }
}
```

## Authentication
All authenticated endpoints require a Bearer token in the Authorization header:
```
Authorization: Bearer <token>
```

## Rate Limiting
API requests are limited to 60 requests per minute per IP address.

## Firebase Data Structure

### Collections

1. `users/`
   ```json
   {
     "uid": {
       "profile": {
         "name": "string",
         "email": "string",
         "phone": "string",
         "photo": "string (URL)"
       },
       "preferences": {
         "notifications": boolean,
         "language": "string",
         "theme": "string"
       }
     }
   }
   ```

2. `bookings/`
   ```json
   {
     "bookingId": {
       "userId": "string",
       "serviceId": "string",
       "specialistId": "string",
       "date": "string (ISO)",
       "time": "string",
       "status": "string",
       "notes": "string",
       "createdAt": "timestamp",
       "updatedAt": "timestamp"
     }
   }
   ```

3. `services/`
   ```json
   {
     "serviceId": {
       "name": "string",
       "description": "string",
       "price": "number",
       "duration": "number",
       "category": "string",
       "image": "string (URL)",
       "isAvailable": "boolean"
     }
   }
   ```

4. `specialists/`
   ```json
   {
     "specialistId": {
       "name": "string",
       "bio": "string",
       "photo": "string (URL)",
       "services": ["serviceId"],
       "schedule": {
         "monday": { "start": "string", "end": "string" },
         "tuesday": { "start": "string", "end": "string" }
       }
     }
   }
   ```

## Firebase API Methods

### Authentication
```javascript
// Login
await signInWithEmailAndPassword(auth, email, password);

// Register
await createUserWithEmailAndPassword(auth, email, password);

// Logout
await signOut(auth);
```

### Bookings
```javascript
// Create booking
await set(ref(db, `bookings/${bookingId}`), bookingData);

// Get user bookings
const userBookings = await get(query(ref(db, 'bookings'), 
  where('userId', '==', userId)));

// Update booking status
await update(ref(db, `bookings/${bookingId}`), { status });
```

### Services
```javascript
// Get all services
const services = await get(ref(db, 'services'));

// Update service availability
await update(ref(db, `services/${serviceId}`), { isAvailable });
```

### Real-time Updates
```javascript
// Listen for booking changes
onValue(ref(db, `bookings/${bookingId}`), (snapshot) => {
  const data = snapshot.val();
  // Handle update
});

// Listen for specialist availability
onValue(ref(db, `specialists/${specialistId}/schedule`), (snapshot) => {
  const schedule = snapshot.val();
  // Update UI
});
```

## Security Rules
```javascript
{
  "rules": {
    "users": {
      "$uid": {
        ".read": "$uid === auth.uid",
        ".write": "$uid === auth.uid"
      }
    },
    "bookings": {
      ".read": "auth != null",
      ".write": "auth != null",
      "$bookingId": {
        ".validate": "newData.hasChildren(['userId', 'serviceId', 'date'])"
      }
    },
    "services": {
      ".read": true,
      ".write": "auth != null && root.child('users').child(auth.uid).child('role').val() === 'admin'"
    }
  }
}
