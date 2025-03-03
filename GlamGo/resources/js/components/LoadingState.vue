<template>
  <div v-if="show" class="relative">
    <!-- Overlay -->
    <div v-if="overlay" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50">
      <div class="flex flex-col items-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
        <p v-if="message" class="mt-4 text-gray-600">{{ message }}</p>
      </div>
    </div>

    <!-- Inline -->
    <div v-else class="flex items-center justify-center py-4">
      <div class="flex flex-col items-center">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
        <p v-if="message" class="mt-2 text-sm text-gray-600">{{ message }}</p>
      </div>
    </div>

    <!-- Slot for content that should be shown while loading -->
    <div :class="{ 'opacity-50': overlay }">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    show: {
      type: Boolean,
      default: true
    },
    overlay: {
      type: Boolean,
      default: false
    },
    message: {
      type: String,
      default: 'Loading...'
    }
  }
}
</script>

<style scoped>
.border-primary {
  @apply border-blue-600;
}
</style> 