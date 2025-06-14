<template>
  <ul class="space-y-1">
    <li
      v-for="name in displayedNames"
      :key="name"
      class="flex justify-between items-center py-2 px-3 rounded-lg hover:bg-gray-100 transition"
    >
      <div class="flex items-center gap-2 text-gray-700">
        <span class="material-icons text-base text-gray-500">person</span>
        <span class="text-sm font-medium">{{ name }}</span>
      </div>
      <button class="text-gray-500 hover:text-gray-700">
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
    return followersStore.names.slice(0, props.max)
  }
  return followersStore.names
})
</script>

<style scoped>
@import url('https://fonts.googleapis.com/icon?family=Material+Icons');
</style>
