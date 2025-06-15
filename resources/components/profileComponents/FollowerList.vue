<template>
  <ul class="space-y-1">
    <li
      v-for="follower in displayedNames"
      :key="follower"
      class="flex justify-between items-center py-2 px-3 rounded-lg transition hover:bg-muted text-foreground"
    >
      <div class="flex items-center gap-2 text-muted-foreground">
        <span class="material-icons text-base">person</span>
        <span class="body-2 font-medium">{{ follower }}</span>
      </div>
      <button class="hover:text-foreground text-muted-foreground">
        <span class="material-icons text-base">more_vert</span>
      </button>
    </li>
  </ul>
</template>


<script setup lang="ts">
import { computed } from 'vue'
import { useFollowersStore } from '@/stores/followerList/follower'

interface Props {
  max?: number
}

const props = defineProps<Props>()

const followersStore = useFollowersStore()

const displayedNames = computed(() => {
  if (props.max !== undefined) {
    return followersStore.followers.slice(0, props.max)
  }
  return followersStore.followers
})
</script>
