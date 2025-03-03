<template>
  <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg">
    <!-- Progress Bar -->
    <div class="p-4 border-b">
      <div class="flex justify-between mb-2">
        <template v-for="(step, index) in steps" :key="index">
          <div class="flex items-center" :class="{'text-primary': currentStep >= index}">
            <div class="w-8 h-8 rounded-full flex items-center justify-center"
                 :class="currentStep >= index ? 'bg-primary text-white' : 'bg-gray-200'">
              {{ index + 1 }}
            </div>
            <span class="ml-2 hidden sm:inline">{{ step }}</span>
            <div v-if="index < steps.length - 1" class="w-12 h-1 mx-2 bg-gray-200"
                 :class="{'bg-primary': currentStep > index}"></div>
          </div>
        </template>
      </div>
    </div>

    <!-- Form Steps -->
    <div class="p-6">
      <!-- Step 1: Service Selection -->
      <div v-show="currentStep === 0">
        <h2 class="text-2xl font-semibold mb-4">Select a Service</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div v-for="category in categories" :key="category.id" class="space-y-4">
            <h3 class="text-lg font-medium">{{ category.name }}</h3>
            <div v-for="service in category.services" :key="service.id"
                 class="p-4 border rounded-lg cursor-pointer transition-colors"
                 :class="{'border-primary bg-primary/5': selectedService?.id === service.id}"
                 @click="selectService(service)">
              <div class="flex justify-between items-start">
                <div>
                  <h4 class="font-medium">{{ service.name }}</h4>
                  <p class="text-sm text-gray-600">{{ service.duration }} min</p>
                  <p class="text-sm text-gray-600 mt-1">{{ service.description }}</p>
                </div>
                <div class="text-lg font-semibold">${{ service.price }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Step 2: Specialist Selection -->
      <div v-show="currentStep === 1">
        <h2 class="text-2xl font-semibold mb-4">Choose your Specialist</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <div v-for="specialist in specialists" :key="specialist.id"
               class="border rounded-lg p-4 cursor-pointer transition-colors"
               :class="{'border-primary bg-primary/5': selectedSpecialist?.id === specialist.id}"
               @click="selectSpecialist(specialist)">
            <img :src="specialist.avatar" :alt="specialist.name" class="w-24 h-24 rounded-full mx-auto mb-3">
            <h3 class="text-lg font-medium text-center">{{ specialist.name }}</h3>
            <p class="text-sm text-gray-600 text-center">{{ specialist.title }}</p>
            <div class="mt-2 flex justify-center">
              <div class="flex items-center">
                <span class="text-yellow-400">★</span>
                <span class="ml-1 text-sm">{{ specialist.rating }} ({{ specialist.reviews_count }})</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Step 3: Date & Time Selection -->
      <div v-show="currentStep === 2">
        <h2 class="text-2xl font-semibold mb-4">Select Date & Time</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Calendar -->
          <div class="border rounded-lg p-4">
            <VDatePicker v-model="selectedDate" :min-date="new Date()" />
          </div>
          <!-- Time Slots -->
          <div class="border rounded-lg p-4">
            <h3 class="text-lg font-medium mb-3">Available Times</h3>
            <div v-if="loading" class="flex justify-center">
              <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
            </div>
            <div v-else class="grid grid-cols-3 gap-2">
              <button v-for="slot in availableSlots" :key="slot.start_time"
                      class="p-2 text-sm rounded-md transition-colors"
                      :class="selectedSlot?.start_time === slot.start_time ? 
                             'bg-primary text-white' : 'bg-gray-100 hover:bg-gray-200'"
                      @click="selectTimeSlot(slot)">
                {{ formatTime(slot.start_time) }}
              </button>
            </div>
            <p v-if="availableSlots.length === 0" class="text-center text-gray-600 mt-4">
              No available slots for this date
            </p>
          </div>
        </div>
      </div>

      <!-- Step 4: Add-on Services -->
      <div v-show="currentStep === 3">
        <h2 class="text-2xl font-semibold mb-4">Add-on Services</h2>
        <div class="space-y-4">
          <div v-for="addon in availableAddons" :key="addon.id"
               class="border rounded-lg p-4">
            <div class="flex items-start justify-between">
              <div class="flex items-start">
                <input type="checkbox" :id="'addon-' + addon.id"
                       v-model="selectedAddons" :value="addon"
                       class="mt-1 rounded text-primary">
                <div class="ml-3">
                  <label :for="'addon-' + addon.id" class="font-medium">{{ addon.name }}</label>
                  <p class="text-sm text-gray-600">{{ addon.description }}</p>
                  <p class="text-sm text-gray-600">Duration: {{ addon.duration }} min</p>
                </div>
              </div>
              <div class="text-lg font-semibold">${{ addon.price }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Step 5: Customer Details -->
      <div v-show="currentStep === 4">
        <h2 class="text-2xl font-semibold mb-4">Your Details</h2>
        <form @submit.prevent="submitBooking" class="space-y-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-1">First Name</label>
              <input type="text" v-model="customerDetails.first_name" required
                     class="w-full rounded-md border-gray-300">
            </div>
            <div>
              <label class="block text-sm font-medium mb-1">Last Name</label>
              <input type="text" v-model="customerDetails.last_name" required
                     class="w-full rounded-md border-gray-300">
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" v-model="customerDetails.email" required
                   class="w-full rounded-md border-gray-300">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="tel" v-model="customerDetails.phone" required
                   class="w-full rounded-md border-gray-300">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Special Requests</label>
            <textarea v-model="customerDetails.notes" rows="3"
                      class="w-full rounded-md border-gray-300"></textarea>
          </div>
        </form>
      </div>

      <!-- Booking Summary -->
      <div v-show="currentStep === 5">
        <h2 class="text-2xl font-semibold mb-4">Booking Summary</h2>
        <div class="space-y-4 border rounded-lg p-4">
          <div class="grid grid-cols-2 gap-4">
            <div>
              <h3 class="font-medium">Service</h3>
              <p>{{ selectedService?.name }}</p>
            </div>
            <div>
              <h3 class="font-medium">Specialist</h3>
              <p>{{ selectedSpecialist?.name }}</p>
            </div>
            <div>
              <h3 class="font-medium">Date & Time</h3>
              <p>{{ formatDate(selectedDate) }} at {{ formatTime(selectedSlot?.start_time) }}</p>
            </div>
            <div>
              <h3 class="font-medium">Duration</h3>
              <p>{{ getTotalDuration }} minutes</p>
            </div>
          </div>

          <div v-if="selectedAddons.length > 0">
            <h3 class="font-medium mb-2">Add-on Services</h3>
            <ul class="list-disc list-inside">
              <li v-for="addon in selectedAddons" :key="addon.id">
                {{ addon.name }} - ${{ addon.price }}
              </li>
            </ul>
          </div>

          <div class="border-t pt-4 mt-4">
            <div class="flex justify-between text-lg font-semibold">
              <span>Total Price</span>
              <span>${{ getTotalPrice }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="p-6 border-t bg-gray-50 flex justify-between">
      <button v-if="currentStep > 0" @click="previousStep"
              class="px-6 py-2 border rounded-md hover:bg-gray-100">
        Back
      </button>
      <button v-if="currentStep < steps.length - 1" @click="nextStep"
              :disabled="!canProceed"
              class="ml-auto px-6 py-2 bg-primary text-white rounded-md hover:bg-primary-dark disabled:opacity-50">
        Continue
      </button>
      <button v-else @click="submitBooking"
              :disabled="loading"
              class="ml-auto px-6 py-2 bg-primary text-white rounded-md hover:bg-primary-dark disabled:opacity-50">
        Confirm Booking
      </button>
    </div>
  </div>
</template>

<script>
import { ref, computed, watch } from 'vue'
import { VDatePicker } from 'vuepic'
import 'vuepic/dist/vuepic.css'
import axios from 'axios'
import { format } from 'date-fns'
import Echo from 'laravel-echo'

export default {
  components: {
    VDatePicker
  },

  setup() {
    const steps = [
      'Service',
      'Specialist',
      'Date & Time',
      'Add-ons',
      'Details',
      'Summary'
    ]
    const currentStep = ref(0)
    const loading = ref(false)

    // Service Selection
    const categories = ref([])
    const selectedService = ref(null)

    // Specialist Selection
    const specialists = ref([])
    const selectedSpecialist = ref(null)

    // Date & Time Selection
    const selectedDate = ref(new Date())
    const availableSlots = ref([])
    const selectedSlot = ref(null)
    const slotLockId = ref(null)

    // Add-ons
    const availableAddons = ref([])
    const selectedAddons = ref([])

    // Customer Details
    const customerDetails = ref({
      first_name: '',
      last_name: '',
      email: '',
      phone: '',
      notes: ''
    })

    // WebSocket connection for real-time updates
    const echo = new Echo({
      broadcaster: 'pusher',
      key: process.env.MIX_PUSHER_APP_KEY,
      cluster: process.env.MIX_PUSHER_APP_CLUSTER,
      forceTLS: true
    })

    // Listen for slot availability changes
    echo.channel('bookings')
      .listen('.slot.availability', (e) => {
        if (selectedService.value?.id === e.service_id &&
            selectedSpecialist.value?.id === e.specialist_id) {
          fetchAvailableSlots()
        }
      })

    // Fetch initial data
    const fetchCategories = async () => {
      try {
        const response = await axios.get('/api/service-categories')
        categories.value = response.data
      } catch (error) {
        console.error('Error fetching categories:', error)
      }
    }

    const fetchSpecialists = async () => {
      if (!selectedService.value) return
      loading.value = true
      try {
        const response = await axios.get('/api/specialists', {
          params: { service_id: selectedService.value.id }
        })
        specialists.value = response.data
      } catch (error) {
        console.error('Error fetching specialists:', error)
      } finally {
        loading.value = false
      }
    }

    const fetchAvailableSlots = async () => {
      if (!selectedService.value || !selectedSpecialist.value || !selectedDate.value) return
      loading.value = true
      try {
        const response = await axios.get('/api/available-slots', {
          params: {
            service_id: selectedService.value.id,
            specialist_id: selectedSpecialist.value.id,
            date: format(selectedDate.value, 'yyyy-MM-dd'),
            timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
          }
        })
        availableSlots.value = response.data
      } catch (error) {
        console.error('Error fetching available slots:', error)
      } finally {
        loading.value = false
      }
    }

    const fetchAddons = async () => {
      if (!selectedService.value) return
      try {
        const response = await axios.get('/api/service-addons', {
          params: { service_id: selectedService.value.id }
        })
        availableAddons.value = response.data
      } catch (error) {
        console.error('Error fetching addons:', error)
      }
    }

    // Actions
    const selectService = (service) => {
      selectedService.value = service
      selectedSpecialist.value = null
      selectedSlot.value = null
      selectedAddons.value = []
      fetchSpecialists()
      fetchAddons()
    }

    const selectSpecialist = (specialist) => {
      selectedSpecialist.value = specialist
      selectedSlot.value = null
      fetchAvailableSlots()
    }

    const selectTimeSlot = async (slot) => {
      if (slotLockId.value) {
        await releaseLock()
      }
      
      try {
        const response = await axios.post('/api/lock-slot', {
          service_id: selectedService.value.id,
          specialist_id: selectedSpecialist.value.id,
          start_time: slot.start_time,
          end_time: slot.end_time
        })
        slotLockId.value = response.data.lock_id
        selectedSlot.value = slot
      } catch (error) {
        console.error('Error locking time slot:', error)
      }
    }

    const releaseLock = async () => {
      if (!slotLockId.value) return
      try {
        await axios.delete('/api/release-lock/' + slotLockId.value)
        slotLockId.value = null
      } catch (error) {
        console.error('Error releasing lock:', error)
      }
    }

    // Navigation
    const canProceed = computed(() => {
      switch (currentStep.value) {
        case 0:
          return selectedService.value !== null
        case 1:
          return selectedSpecialist.value !== null
        case 2:
          return selectedSlot.value !== null
        case 3:
          return true // Add-ons are optional
        case 4:
          return customerDetails.value.first_name &&
                 customerDetails.value.last_name &&
                 customerDetails.value.email &&
                 customerDetails.value.phone
        default:
          return true
      }
    })

    const nextStep = () => {
      if (currentStep.value < steps.length - 1 && canProceed.value) {
        currentStep.value++
      }
    }

    const previousStep = async () => {
      if (currentStep.value > 0) {
        currentStep.value--
      }
    }

    // Computed properties
    const getTotalDuration = computed(() => {
      let duration = selectedService.value?.duration || 0
      selectedAddons.value.forEach(addon => {
        duration += addon.duration
      })
      return duration
    })

    const getTotalPrice = computed(() => {
      let price = selectedService.value?.price || 0
      selectedAddons.value.forEach(addon => {
        price += addon.price
      })
      return price.toFixed(2)
    })

    // Formatting helpers
    const formatTime = (time) => {
      if (!time) return ''
      return format(new Date(time), 'h:mm a')
    }

    const formatDate = (date) => {
      if (!date) return ''
      return format(date, 'MMMM d, yyyy')
    }

    // Form submission
    const submitBooking = async () => {
      if (loading.value) return
      loading.value = true

      try {
        const response = await axios.post('/api/bookings', {
          service_id: selectedService.value.id,
          specialist_id: selectedSpecialist.value.id,
          start_time: selectedSlot.value.start_time,
          customer_details: {
            first_name: customerDetails.value.first_name,
            last_name: customerDetails.value.last_name,
            email: customerDetails.value.email,
            phone: customerDetails.value.phone
          },
          notes: customerDetails.value.notes,
          addons: selectedAddons.value.map(addon => addon.id),
          timezone: Intl.DateTimeFormat().resolvedOptions().timeZone
        })

        // Handle successful booking
        window.location.href = `/bookings/${response.data.confirmation_code}`
      } catch (error) {
        console.error('Error creating booking:', error)
        // Handle error (show error message to user)
      } finally {
        loading.value = false
      }
    }

    // Cleanup
    onBeforeUnmount(() => {
      if (slotLockId.value) {
        releaseLock()
      }
    })

    // Initial data fetch
    fetchCategories()

    // Watch for date changes
    watch(selectedDate, () => {
      if (selectedSpecialist.value) {
        fetchAvailableSlots()
      }
    })

    return {
      steps,
      currentStep,
      loading,
      categories,
      selectedService,
      specialists,
      selectedSpecialist,
      selectedDate,
      availableSlots,
      selectedSlot,
      availableAddons,
      selectedAddons,
      customerDetails,
      canProceed,
      getTotalDuration,
      getTotalPrice,
      selectService,
      selectSpecialist,
      selectTimeSlot,
      nextStep,
      previousStep,
      submitBooking,
      formatTime,
      formatDate
    }
  }
}
</script>

<style scoped>
.bg-primary {
  @apply bg-blue-600;
}
.text-primary {
  @apply text-blue-600;
}
.border-primary {
  @apply border-blue-600;
}
.bg-primary-dark {
  @apply bg-blue-700;
}
</style> 
</style> 