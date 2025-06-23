<script setup lang="ts">
  import {
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogOverlay,
    DialogPortal,
    DialogRoot,
    DialogTitle,
  } from 'reka-ui';
  import { ref, onMounted } from 'vue';

  const isDialogOpen = ref(false)

  // Show dialog automatically on mount
  onMounted(() => {
    isDialogOpen.value = true
  })
  
  //reflect to parent component
  const emit = defineEmits<{
    (e: 'action'): void
  }>()

</script>
<template>

  <div class="flex justify-center items-center gap-[40px] relative">

      <DialogRoot v-model:open="isDialogOpen">
        <DialogPortal>
          <DialogOverlay class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50" />
          <DialogContent
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md mx-4 z-50 border border-gray-200"
          >
            <!-- Header with Icon -->
            <div class="flex flex-col items-center text-center mb-6">
              <div
                class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4"
              >
                <!-- <svg
                  class="w-8 h-8 text-red-600"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                  />
                </svg> -->
                <svg 
                  class="w-8 h-8 text-red-600"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                <path 
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" 
                    />
              </svg>
              </div>
              <DialogTitle class="text-2xl font-bold text-gray-900 mb-2">
                Confirm Deletion
              </DialogTitle>
              <DialogDescription class="text-gray-600 text-base leading-relaxed">
                Are you sure you want to delete it?
              </DialogDescription>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
              <DialogClose
                class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
              >
                Cancel
              </DialogClose>
              <DialogClose
                @click="emit('action')"
                class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-all duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
              >
                Delete
              </DialogClose>
            </div>

            <!-- Close Button -->
            <DialogClose
              class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-300"
              aria-label="Close"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              >
                <path d="M18 6L6 18" />
                <path d="M6 6l12 12" />
              </svg>
            </DialogClose>
          </DialogContent>
        </DialogPortal>
      </DialogRoot>
  </div>

</template>