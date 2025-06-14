<template>
  <div class="w-full">
    <div
      class="border border-border rounded-xl p-4 bg-card text-foreground shadow-sm hover:shadow-md transition-shadow duration-300"
    >
      <div class="flex items-center gap-3">
        <img
          :src="avatarImage"
          alt="Profile picture"
          class="w-12 h-12 rounded-full object-cover border border-border"
        />
        <div>
          <p class="truncate max-w-[150px] body-2 text-h7">
            {{ UsernameStore.username }}
          </p>
          <p class="subtitle-2 text-muted-foreground">
            Reading lists
          </p>
        </div>
      </div>
      <p class="caption mt-3 text-muted-foreground">
        {{ props.storyCount }} {{ props.storyCount === 1 ? 'story' : 'stories' }}
      </p>
    </div>
  </div>
</template>


<script setup lang="ts">
import { computed } from 'vue'
import profileImg from '../../../public/landingPage_img/profile.png'
import { useUsernameStore } from '../../js/stores/username/userName'

interface Props {
  username: string
  avatarUrl?: string
  storyCount: number
}

const props = defineProps<Props>()
const UsernameStore = useUsernameStore()

const avatarImage = computed(() => props.avatarUrl || profileImg)
</script>
