<template>
  <div>
    <div class="mb-2 text-sm text-muted-foreground">
      Followers: {{ followersCount }}
    </div>
    <ul class="space-y-2">
      <li
        v-for="follower in displayedFollowers"
        :key="follower.id"
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
          <span class="subtitle-2 text-foreground">{{ follower.name }}</span>
        </div>
        <button class="text-muted-foreground hover:text-foreground">
          <span class="material-icons text-base">more_vert</span>
        </button>
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useFollowersStore } from '@/stores/features/followerList/follower'

interface Props {
  max?: number
}

const props = defineProps<Props>()
const followersStore = useFollowersStore()

const displayedFollowers = computed(() => {
  return props.max !== undefined
    ? followersStore.followers.slice(0, props.max)
    : followersStore.followers
})

const followersCount = computed(() => followersStore.followers.length)
</script>
