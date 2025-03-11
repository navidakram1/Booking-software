# API Documentation

## Service Search API

### Search Services

Search for services with multiple filters.

**Endpoint:** `GET /api/services/search`

**Authentication:** Required (Admin)

**Query Parameters:**
| Parameter | Type | Description | Required |
|-----------|------|-------------|----------|
| query | string | Search text for name or description | No |
| category | string | Filter by category (hair, nails, facial, massage) | No |
| status | string | Filter by status (active, inactive) | No |
| price_range | string | Filter by price range (low, medium, high) | No |
| page | integer | Page number for pagination | No |
| per_page | integer | Number of items per page | No |

**Example Request:**
```bash
curl -X GET 'http://your-domain.com/api/services/search?query=haircut&category=hair&status=active&price_range=medium&page=1&per_page=10' \
-H 'Authorization: Bearer your-token'
```

**Example Response:**
```json
{
    "data": [
        {
            "id": 1,
            "name": "Haircut & Styling",
            "description": "Professional haircut and styling service",
            "category": "hair",
            "price": 45.00,
            "duration": 45,
            "status": "active",
            "created_at": "2024-03-15T10:00:00.000000Z",
            "updated_at": "2024-03-15T10:00:00.000000Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http://your-domain.com/api/services/search",
        "per_page": 10,
        "to": 10,
        "total": 50
    }
}
```

**Response Codes:**
- 200: Success
- 401: Unauthorized
- 403: Forbidden
- 422: Validation Error
- 429: Too Many Requests

**Error Response Example:**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "category": [
            "The selected category is invalid."
        ],
        "status": [
            "The selected status is invalid."
        ]
    }
}
```

### Rate Limiting
- 60 requests per minute per user
- 1000 requests per hour per user

### Caching
- Results are cached for 5 minutes
- Cache is invalidated on service updates

### Security
- All requests require valid authentication token
- Input is sanitized and validated
- SQL injection prevention implemented
- XSS protection enabled

### Performance Considerations
- Response time target: < 200ms
- Maximum result set: 100 items
- Pagination required for large result sets

### Example Usage

#### JavaScript
```javascript
async function searchServices(params) {
    const response = await fetch('/api/services/search?' + new URLSearchParams(params), {
        headers: {
            'Authorization': `Bearer ${token}`,
            'Accept': 'application/json'
        }
    });
    return response.json();
}

// Usage
const results = await searchServices({
    query: 'haircut',
    category: 'hair',
    status: 'active',
    page: 1,
    per_page: 10
});
```

#### PHP
```php
$response = Http::withToken($token)
    ->get('/api/services/search', [
        'query' => 'haircut',
        'category' => 'hair',
        'status' => 'active',
        'page' => 1,
        'per_page' => 10
    ]);

$data = $response->json();
```

### Best Practices
1. Always include pagination parameters
2. Use appropriate filter combinations
3. Handle rate limiting gracefully
4. Implement proper error handling
5. Cache results when possible
6. Monitor API usage 