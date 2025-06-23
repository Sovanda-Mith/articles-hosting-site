<template>
  <ul class="space-y-2">
    <li
      v-for="following in displayedFollowing"
      :key="following.id"
      class="flex items-center justify-between p-2 rounded-lg hover:bg-muted transition"
      @click="router.push(`/viewer/${following.following?.id}`)"
    >
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-muted rounded-full flex items-center justify-center overflow-hidden">
          <img
            :src="following.following?.avatar || '/logo.png'"
            alt="avatar"
            class="w-6 h-6 object-contain"
          />
        </div>
        <span class="subtitle-2 text-foreground">{{ following.following?.name }}</span>
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
import router from '@/routes';
import { useFollowStore } from '@/stores/features/follows/stores/FollowStore'
import { onMounted, watch, computed } from 'vue'

interface Props {
  userId?: number
  max?: number
}

const props = withDefaults(defineProps<Props>(), {
  userId: () => Number(localStorage.getItem('userId')) || 0,
  max: undefined
})

const followStore = useFollowStore()

const displayedFollowing = computed(() => {
  return props.max !== undefined
    ? followStore.following.slice(0, props.max)
    : followStore.following
})

const getFollowingList = async () => {
  if (props.userId) {
    await followStore.fetchFollowing(props.userId)
  }
}

onMounted(() => {
  getFollowingList()
})

// Watch for changes in userId prop
watch(() => props.userId, (newUserId) => {
  if (newUserId) {
    getFollowingList()
  }
})
</script>
