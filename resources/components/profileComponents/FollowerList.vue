<template>
  <ul class="space-y-2">
    <li
      v-for="follower in displayedFollowers"
      :key="follower.id"
      class="flex items-center justify-between p-2 rounded-lg hover:bg-muted transition"
      @click="router.push(`/viewer/${follower.follower?.id}`)"
    >
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 bg-muted rounded-full flex items-center justify-center overflow-hidden">
          <img
            :src="follower.follower?.avatar || '/logo.png'"
            alt="avatar"
            class="w-6 h-6 object-contain"
          />
        </div>
        <span class="subtitle-2 text-foreground">{{ follower.follower?.name || 'Unknown' }}</span>
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
// import { useFollowingStore } from '@/stores/features/followingList/following'
import { useFollowStore } from '@/stores/features/follows/stores/FollowStore'
import { onMounted } from 'vue'
import { useRouter } from 'vue-router';

const router = useRouter()
const props = defineProps<{
  userId: number,
  max?: number,
}>()

const followStore = useFollowStore()
const getFollowerList = async () => {
  await followStore.fetchFollowers(props.userId)
}

const displayedFollowers = computed(() => {
  return props.max !== undefined
    ? followStore.followers.slice(0, props.max)
    : followStore.followers
})

onMounted(() => {
  getFollowerList()
})
</script>
