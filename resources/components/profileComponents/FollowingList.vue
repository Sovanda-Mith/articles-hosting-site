<template>
  <ul class="space-y-3">
    <li
      v-for="(following, index) in displayedNames"
      :key="index"
      class="relative flex items-center justify-between px-3 py-2 rounded-lg transition hover:bg-muted"
      :ref="(el) => setMenuRef(el, index)"
    >
      <!-- User Info -->
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-muted rounded-full flex items-center justify-center overflow-hidden">
          <img
            src="/logo.png"
            alt="avatar"
            class="w-6 h-6 object-contain"
          />
        </div>
        <span class="text-sm font-medium text-foreground">{{ following }}</span>
      </div>

      <!-- Options Button -->
      <div class="relative">
        <button
          @click.stop="toggleMenu(index)"
          class="p-1 text-muted-foreground hover:text-foreground transition focus:outline-none"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <circle cx="5" cy="12" r="2"/>
            <circle cx="12" cy="12" r="2"/>
            <circle cx="19" cy="12" r="2"/>
          </svg>
        </button>

        <!-- Dropdown Menu -->
        <div
          v-if="activeMenu === index"
          class="absolute right-0 mt-2 w-36 bg-card border border-border rounded-md shadow-lg z-20"
        >
          <button
            class="block w-full text-left px-4 py-2 text-sm text-foreground hover:bg-muted"
          >
            View Profile
          </button>
          <button
            class="block w-full text-left px-4 py-2 text-sm text-destructive hover:bg-muted"
          >
            Unfollow
          </button>
        </div>
      </div>
    </li>
  </ul>
</template>


<script setup lang="ts">
import { ref, computed, onMounted, onBeforeUnmount } from 'vue'
import { useFollowersStore } from '@/stores/followerList/follower'

interface Props {
  max?: number
}

const props = defineProps<Props>()
const followersStore = useFollowersStore()

const displayedNames = computed(() => {
  return props.max !== undefined
    ? followersStore.followers.slice(0, props.max)
    : followersStore.followers
})

const activeMenu = ref<number | null>(null)
const menuRefs = ref<(HTMLElement | null)[]>([])

const setMenuRef = (el: HTMLElement | null, index: number) => {
  menuRefs.value[index] = el
}

const toggleMenu = (index: number) => {
  activeMenu.value = activeMenu.value === index ? null : index
}

const handleClickOutside = (event: MouseEvent) => {
  const clickedInside = menuRefs.value.some(
    (el) => el && el.contains(event.target as Node)
  )
  if (!clickedInside) {
    activeMenu.value = null
  }
}

onMounted(() => {
  window.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
  window.removeEventListener('click', handleClickOutside)
})
</script>
