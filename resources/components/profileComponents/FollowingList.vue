<template>
  <ul class="space-y-2">
    <li
      v-for="following in displayedFollowing"
      :key="following.id"
      class="flex items-center justify-between p-2 rounded-lg hover:bg-muted transition"
    >
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-muted rounded-full flex items-center justify-center overflow-hidden">
          <img
            src="/logo.png"
            alt="avatar"
            class="w-6 h-6 object-contain"
          />
        </div>
        <span class="subtitle-2 text-foreground">{{ following.name }}</span>
      </div>
      <button class="text-muted-foreground hover:text-foreground transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <circle cx="5" cy="12" r="2"/>
            <circle cx="12" cy="12" r="2"/>
            <circle cx="19" cy="12" r="2"/>
          </svg>
      </button>
    </li>
  </ul>
</template>


<script setup lang="ts">
import { computed } from 'vue'
import { useFollowingStore } from '@/stores/followingList/following'

interface Props {
  max?: number
}

const props = defineProps<Props>()
const followingStore = useFollowingStore()

const displayedFollowing = computed(() => {
  return props.max !== undefined
    ? followingStore.following.slice(0, props.max)
    : followingStore.following
})
</script>
