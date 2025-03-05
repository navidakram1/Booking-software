import { database } from '/js/firebase-init.js';
import { ref, push, set, get, query, orderByChild } from 'https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js';

export class BookingRepository {
    constructor() {
        this.bookingsRef = ref(database, 'bookings');
    }

    async createBooking(bookingData) {
        const newBookingRef = push(this.bookingsRef);
        await set(newBookingRef, {
            ...bookingData,
            createdAt: new Date().toISOString()
        });
        return newBookingRef.key;
    }

    async getBookingsByUser(userId) {
        const userBookingsQuery = query(this.bookingsRef, orderByChild('userId'), userId);
        const snapshot = await get(userBookingsQuery);
        return snapshot.val();
    }

    async getBookingsByDate(date) {
        const dateBookingsQuery = query(this.bookingsRef, orderByChild('date'), date);
        const snapshot = await get(dateBookingsQuery);
        return snapshot.val();
    }

    async updateBookingStatus(bookingId, status) {
        const bookingRef = ref(database, `bookings/${bookingId}`);
        await set(bookingRef, {
            status: status,
            updatedAt: new Date().toISOString()
        });
    }
}
