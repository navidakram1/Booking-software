# GlamGo Project Rules

## Code Style and Structure

### TypeScript Coding Standards
- Use TypeScript strict mode (`"strict": true` in tsconfig.json)
- Prefer `const` over `let`, avoid `var`
- Use functional programming patterns:
```typescript
// ❌ Avoid imperative approach
let total = 0;
for (let i = 0; i < items.length; i++) {
  total += items[i].price;
}

// ✅ Use functional approach
const total = items.reduce((sum, item) => sum + item.price, 0);
```

### Function Patterns
- Use pure functions where possible:
```typescript
// ❌ Avoid side effects
let globalTotal = 0;
const addToTotal = (price: number) => {
  globalTotal += price;
};

// ✅ Use pure functions
const calculateTotal = (prices: number[]): number => {
  return prices.reduce((sum, price) => sum + price, 0);
};
```

### Variable Naming
- Use descriptive names with auxiliary verbs:
```typescript
// ❌ Avoid unclear names
const flag = false;
const data = [];
const proc = () => {};

// ✅ Use descriptive names
const isLoading = false;
const userBookings = [];
const handleSubmit = () => {};
```

### Type Definitions
- Use interfaces for object shapes:
```typescript
interface Booking {
  id: string;
  userId: string;
  serviceId: string;
  startTime: Date;
  duration: number;
  status: BookingStatus;
}

// Use type for unions or complex types
type BookingStatus = 'pending' | 'confirmed' | 'cancelled';
```

### Code Organization
- One concept per file
- Export at declaration instead of bulk exports
- Group related functionality in feature folders

### Modularization Example
```typescript
// ❌ Avoid large files with multiple concerns
export const bookingUtils = {
  validate: () => {},
  format: () => {},
  calculate: () => {},
  process: () => {},
};

// ✅ Split into focused modules
// bookingValidation.ts
export const validateBookingTime = (time: Date): boolean => {};
export const validateServiceAvailability = (serviceId: string): Promise<boolean> => {};

// bookingFormatter.ts
export const formatBookingTime = (time: Date): string => {};
export const formatBookingDuration = (minutes: number): string => {};
```

### Repository Structure
```
GlamGo/
├── client/
│   ├── src/
│   │   ├── components/          # Reusable UI components
│   │   │   ├── booking/        # Booking-related components
│   │   │   ├── services/       # Service-related components
│   │   │   └── shared/         # Shared/common components
│   │   ├── hooks/              # Custom React hooks
│   │   │   ├── useBooking.ts
│   │   │   ├── useServices.ts
│   │   │   └── useAuth.ts
│   │   ├── utils/              # Helper functions
│   │   │   ├── date.ts
│   │   │   ├── validation.ts
│   │   │   └── formatting.ts
│   │   ├── types/              # TypeScript type definitions
│   │   │   ├── booking.types.ts
│   │   │   ├── service.types.ts
│   │   │   └── common.types.ts
│   │   └── lib/               # Third-party integrations
│   │       ├── api.ts
│   │       └── storage.ts
├── server/                    # Backend Laravel structure
└── shared/                   # Shared code between client/server
```

### Code Iteration
- Use array methods over loops:
```typescript
// ❌ Avoid traditional loops
const activeBookings = [];
for (const booking of bookings) {
  if (booking.status === 'active') {
    activeBookings.push(booking);
  }
}

// ✅ Use array methods
const activeBookings = bookings
  .filter(booking => booking.status === 'active')
  .map(booking => ({
    ...booking,
    displayDate: formatDate(booking.date)
  }));
```

### Error Handling
```typescript
// ✅ Use Result type for operations that might fail
type Result<T> = {
  success: true;
  data: T;
} | {
  success: false;
  error: string;
};

const processBooking = async (booking: Booking): Promise<Result<string>> => {
  try {
    // Process booking
    return { success: true, data: 'Booking confirmed' };
  } catch (error) {
    return { 
      success: false, 
      error: error instanceof Error ? error.message : 'Unknown error'
    };
  }
};
```