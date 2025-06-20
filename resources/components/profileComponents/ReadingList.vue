<template>
  <div class="w-full max-w-2xl bg-white rounded-2xl shadow-lg overflow-hidden border border-border transition">
    <div class="flex justify-between items-center p-6 gap-6">
      <!-- Left: Profile Info -->
      <div class="flex items-center gap-4 flex-1 min-w-0">
        <img
          :src="avatarImage"
          alt="Profile picture"
          class="w-12 h-12 rounded-full border border-gray-300 object-cover shrink-0"
        />
        <div class="truncate">
          <p class="font-semibold text-gray-800 truncate max-w-[160px] text-base">
            {{ username }}
          </p>
          <p class="text-sm text-gray-500">Reading lists</p>
          <p class="text-xs text-gray-400 mt-1">
            {{ listCount }} {{ storyLabel }}
          </p>
        </div>
      </div>

      <!-- Right: Story Previews -->
      <div class="flex gap-3 shrink-0">
        <img
          v-for="(list, index) in previewLists"
          :key="list.id || index"
          :src="list.image"
          alt="Story preview"
          class="w-16 h-16 object-cover rounded-lg border border-gray-200 transition-transform duration-200 hover:scale-105 hover:shadow-lg cursor-pointer"
        />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import profileImg from '../../../public/landingPage_img/profile.png'
import { useUserStore } from '../../js/stores/features/users/user'
import { useListStore } from '../../js/stores/features/storyList/listStore'

const userStore = useUserStore()
const listStore = useListStore()

const avatarImage = computed(() => userStore.avatarUrl?.trim() ? userStore.avatarUrl : profileImg)
const username = computed(() => userStore.user?.username || 'Unknown User')
const listCount = computed(() => listStore.lists?.length || 0)
const storyLabel = computed(() => listCount.value === 1 ? 'story' : 'stories')
const previewLists = computed(() => (listStore.lists || []).slice(0, 3))
</script>
