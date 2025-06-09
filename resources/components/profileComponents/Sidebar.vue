<template>
  <aside class="p-6">
    <div class="text-center">
      <img
        :src="avatarUrl"
        class="mx-auto w-24 h-24 rounded-full border-2 border-gray-300 mb-3"
        alt="Profile picture"
      />
      <h2 class="font-semibold text-xl text-gray-800">{{ name }}</h2>
      <div class="text-sm text-gray-600 mt-1 flex justify-center gap-4">
        <span><strong>{{ actualFollowerCount }}</strong> Followers</span>
        <span><strong>{{ following }}</strong> Following</span>
      </div>
      <button
        class="mt-4 px-5 py-1.5 rounded-full text-sm font-medium border bg-blue-600 text-white hover:bg-blue-700 transition"
        @click="isFollowing = !isFollowing"
      >
        {{ isFollowing ? 'FOLLOWED' : 'FOLLOW' }}
      </button>
    </div>

    <div class="mt-6 border-t pt-4 text-sm text-gray-700">
      <p class="mb-3">{{ bio }}</p>
      <p class="mb-3">
        Writes <span class="font-semibold">The Sophist</span>:
        <a
          :href="link"
          class="text-blue-600 underline hover:text-blue-800 transition"
        >
          {{ linkText }}
        </a>
      </p>
      <div>
        <p class="font-semibold text-gray-800 mb-2">Followers</p>
        <div class="max-h-[480px] overflow-y-auto border rounded-md p-2">
          <FollowerList :max="showAllFollowers ? undefined : Math.min(10, actualFollowerCount)" />
        </div>
        <button
          v-if="actualFollowerCount > 10"
          class="mt-2 text-blue-600 underline hover:text-blue-800 transition text-xs"
          @click="showAllFollowers = !showAllFollowers"
        >
          {{ showAllFollowers ? 'See less...' : 'See more...' }}
        </button>
      </div>
    </div>
  </aside>
</template>

<script setup lang="ts">
import { ref, computed } from 'vue'
import FollowerList from './FollowerList.vue'
import { useFollowersStore } from '@/stores/followerList/follower'
import profileImg from '../../../public/landingPage_img/profile.png'

defineOptions({ name: 'ProfileSidebar' })

interface Props {
  name: string
  avatarUrl: string
  following: number
  bio: string
  link: string
  linkText: string
}

const props = defineProps<Props>()

const avatarUrl = computed(() => props.avatarUrl || profileImg)

const isFollowing = ref(false)
const showAllFollowers = ref(false)

const followersStore = useFollowersStore()

const actualFollowerCount = computed(() => followersStore.names.length)
</script>
