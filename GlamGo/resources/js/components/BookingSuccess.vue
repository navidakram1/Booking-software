<template>
  <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8">
    <!-- Success Header -->
    <div class="text-center mb-8">
      <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
      </div>
      <h1 class="text-2xl font-bold text-gray-900">Booking Confirmed!</h1>
      <p class="text-gray-600 mt-2">
        Your appointment has been successfully booked. A confirmation email has been sent to your inbox.
      </p>
    </div>

    <!-- Booking Details -->
    <div class="border rounded-lg p-6 mb-8">
      <h2 class="text-lg font-semibold mb-4">Booking Details</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm text-gray-600">Service</p>
          <p class="font-medium">{{ booking.service.name }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Specialist</p>
          <p class="font-medium">{{ booking.specialist.name }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Date</p>
          <p class="font-medium">{{ formatDate(booking.start_time) }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Time</p>
          <p class="font-medium">{{ formatTime(booking.start_time) }} - {{ formatTime(booking.end_time) }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Duration</p>
          <p class="font-medium">{{ getTotalDuration }} minutes</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Confirmation Code</p>
          <p class="font-medium">{{ booking.confirmation_code }}</p>
        </div>
      </div>

      <!-- Add-ons -->
      <template v-if="booking.addons.length > 0">
        <h3 class="text-lg font-semibold mt-6 mb-3">Add-on Services</h3>
        <ul class="space-y-2">
          <li v-for="addon in booking.addons" :key="addon.id" class="flex justify-between">
            <span>{{ addon.name }}</span>
            <span>${{ addon.price }}</span>
          </li>
        </ul>
      </template>

      <!-- Total Price -->
      <div class="border-t mt-6 pt-4">
        <div class="flex justify-between text-lg font-semibold">
          <span>Total Price</span>
          <span>${{ booking.total_price }}</span>
        </div>
      </div>
    </div>

    <!-- Important Information -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
      <h2 class="text-lg font-semibold text-blue-800 mb-4">Important Information</h2>
      <ul class="space-y-2 text-blue-700">
        <li class="flex items-start">
          <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
          </svg>
          Please arrive 10 minutes before your appointment
        </li>
        <li class="flex items-start">
          <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
          </svg>
          Cancellations require 24 hours notice
        </li>
        <li class="flex items-start">
          <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
          </svg>
          A calendar invite has been sent to your email
        </li>
      </ul>
    </div>

    <!-- Actions -->
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <button @click="downloadCalendarInvite" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        Add to Calendar
      </button>
      <button @click="goToHome" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary-dark">
        Return to Home
      </button>
    </div>
  </div>
</template>

<script>
import { format } from 'date-fns'
import { saveAs } from 'file-saver'

export default {
  props: {
    booking: {
      type: Object,
      required: true
    }
  },

  computed: {
    getTotalDuration() {
      let duration = this.booking.service.duration
      this.booking.addons.forEach(addon => {
        duration += addon.duration
      })
      return duration
    }
  },

  methods: {
    formatDate(date) {
      return format(new Date(date), 'MMMM d, yyyy')
    },

    formatTime(time) {
      return format(new Date(time), 'h:mm a')
    },

    async downloadCalendarInvite() {
      try {
        const response = await axios.get(`/api/bookings/${this.booking.id}/calendar`, {
          responseType: 'blob'
        })
        saveAs(response.data, `booking-${this.booking.confirmation_code}.ics`)
      } catch (error) {
        console.error('Error downloading calendar invite:', error)
      }
    },

    goToHome() {
      window.location.href = '/'
    }
  }
}
</script>

<style scoped>
.bg-primary {
  @apply bg-blue-600;
}
.bg-primary-dark {
  @apply bg-blue-700;
}
</style> 