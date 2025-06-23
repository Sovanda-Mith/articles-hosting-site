<template>
  <div class="pl-6 relative flex items-center justify-between">
    <p v-if="props.viewType === 'profile'" class="text-h2">{{ userStore.user.name || 'ANONYMOUS' }}</p>
    <p v-if="props.viewType === 'viewer'" class="text-h2">{{ props.name || 'ANONYMOUS' }}</p>
    <button
      @click="showMenu = !showMenu"
      class="absolute right-4 top-1/2 -translate-y-1/2 bg-transparent border-none cursor-pointer p-1 flex items-center justify-center rounded-full hover:bg-gray-100 transition"
      aria-label="More options"
      type="button"
      style="width: 32px; height: 32px;"
    >
      <span class="flex flex-col gap-0.5 items-center justify-center">
      <span class="w-1.5 h-1.5 bg-gray-800 rounded-full block"></span>
      <span class="w-1.5 h-1.5 bg-gray-800 rounded-full block"></span>
      <span class="w-1.5 h-1.5 bg-gray-800 rounded-full block"></span>
      </span>
    </button>
    <div
      v-if="showMenu"
      class="absolute right-4 mt-2 w-40 bg-white border border-gray-200 rounded shadow-lg z-10"
      ref="menuRef"
    >
      <ul class="py-1">
      <li>
        <button
        class="w-full text-left px-4 py-2 hover:bg-gray-100"
        >
        Copy link
        </button>
      </li>
      <li>
        <button
        class="w-full text-left px-4 py-2 hover:bg-gray-100"
        >
        Block User
        </button>
      </li>
      <li>
        <button
        class="w-full text-left px-4 py-2 hover:bg-gray-100"
        >
        Report User
        </button>
      </li>
      </ul>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { useUserStore } from '@/stores/features/users/user'
import { defineProps } from 'vue'

const userStore = useUserStore()
const showMenu = ref(false)
const menuRef = ref<HTMLElement | null>(null)

const props = defineProps<{
  name?: string
  viewType: 'profile' | 'viewer'
}>()

function handleClickOutside(event: MouseEvent) {
  if (showMenu.value && menuRef.value && !menuRef.value.contains(event.target as Node)) {
    showMenu.value = false
  }
}


onMounted(() => {
  document.addEventListener('mousedown', handleClickOutside)
})

onBeforeUnmount(() => {
  document.removeEventListener('mousedown', handleClickOutside)
})

</script>
