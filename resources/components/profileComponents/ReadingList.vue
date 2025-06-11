<template>
  <div class="w-full">
    <div
      class="border rounded-xl p-4 bg-white shadow-sm hover:shadow-md transition-shadow duration-300"
    >
      <div class="flex items-center gap-3">
        <img
          :src="avatarUrl"
          alt="Profile picture"
          class="w-12 h-12 rounded-full object-cover border"
        />
        <div>
          <div class="text-sm font-semibold text-gray-900 truncate max-w-[150px]">
            {{ username }}
          </div>
          <div class="text-xs text-gray-500">Reading lists</div>
        </div>
      </div>
      <p class="text-xs mt-3 text-gray-500">
        {{ storyCount }} {{ storyCount === 1 ? 'story' : 'stories' }}
      </p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import profileImg from '../../../public/landingPage_img/profile.png'

interface Props {
  username: string
  avatarUrl: string
  storyCount: number
}

const props = defineProps<Props>()

const avatarUrl = computed(() => props.avatarUrl || profileImg)
</script>
