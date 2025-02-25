<template>
  <div class="fixed bottom-4 right-4 z-50">
    <!-- Notification List -->
    <transition-group 
      name="notification" 
      tag="div" 
      class="space-y-4"
    >
      <div
        v-for="notification in notifications"
        :key="notification.id"
        class="bg-white rounded-lg shadow-lg p-4 max-w-sm transform transition-all duration-300"
        :class="{
          'border-l-4 border-green-500': notification.type === 'success',
          'border-l-4 border-blue-500': notification.type === 'info',
          'border-l-4 border-yellow-500': notification.type === 'warning',
          'border-l-4 border-red-500': notification.type === 'error'
        }"
      >
        <div class="flex items-start">
          <!-- Icon -->
          <div class="flex-shrink-0">
            <svg
              v-if="notification.type === 'success'"
              class="h-6 w-6 text-green-500"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 13l4 4L19 7"
              />
            </svg>
            <svg
              v-else-if="notification.type === 'error'"
              class="h-6 w-6 text-red-500"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
            <!-- Add more icons for other types -->
          </div>

          <!-- Content -->
          <div class="ml-3 w-0 flex-1">
            <p class="text-sm font-medium text-gray-900">
              {{ notification.title }}
            </p>
            <p class="mt-1 text-sm text-gray-500">
              {{ notification.message }}
            </p>
          </div>

          <!-- Close Button -->
          <div class="ml-4 flex-shrink-0 flex">
            <button
              @click="removeNotification(notification.id)"
              class="inline-flex text-gray-400 hover:text-gray-500 focus:outline-none"
            >
              <span class="sr-only">Close</span>
              <svg
                class="h-5 w-5"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </transition-group>
  </div>
</template>

<script>
export default {
  data() {
    return {
      notifications: [],
      nextId: 0
    }
  },

  created() {
    // Listen for Echo events (development mode)
    if (window.Echo) {
      Echo.channel('appointments')
        .listen('AppointmentStatusChanged', (notification) => {
          this.addNotification({
            id: this.nextId++,
            title: this.getNotificationTitle(notification),
            message: notification.message,
            type: this.getNotificationType(notification),
            timeout: 5000
          })
        })
    }
  },

  methods: {
    addNotification(notification) {
      this.notifications.push(notification)

      if (notification.timeout) {
        setTimeout(() => {
          this.removeNotification(notification.id)
        }, notification.timeout)
      }
    },

    removeNotification(id) {
      const index = this.notifications.findIndex(n => n.id === id)
      if (index > -1) {
        this.notifications.splice(index, 1)
      }
    },

    getNotificationTitle(notification) {
      switch (notification.type) {
        case 'App\\Notifications\\AppointmentNotification':
          return 'Appointment Update'
        default:
          return 'Notification'
      }
    },

    getNotificationType(notification) {
      if (notification.status) {
        switch (notification.status) {
          case 'confirmed':
            return 'success'
          case 'cancelled':
            return 'error'
          case 'pending':
            return 'warning'
          default:
            return 'info'
        }
      }
      return 'info'
    }
  }
}
</script>

<style>
.notification-enter-active,
.notification-leave-active {
  transition: all 0.3s ease;
}
.notification-enter-from,
.notification-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>
