<template>
  <aside class="p-6 bg-card text-card-foreground rounded-lg shadow-md max-w-sm relative">
    <!-- Avatar & Username -->
    <div class="text-center">
      <img
        :src="avatarUrl"
        alt="Profile picture"
        class="mx-auto w-24 h-24 rounded-full border-2 border-border mb-2"
      />
      <p class="text-h5">{{ displayName }}</p>
      <div class="body-1 mt-1 flex justify-center gap-8 text-muted-foreground select-none">
        <span><strong>{{ followerCount }}</strong> Followers</span>
        <span><strong>{{ followingCount }}</strong> Following</span>
      </div>
      <div class="flex justify-center gap-3 mt-4">
        <Button
          @click="goToSettings"
          variant="outline"
          class="px-4 py-2 flex items-center gap-2"
          title="Settings"
        >
          Settings
        </Button>
      </div>
    </div>

    <!-- About Me -->
    <div class="mt-6 border-t border-border pt-4">
      <p class="text-h6 mb-3 text-card-foreground">About Me</p>
      <p class="body-1 mb-6 leading-relaxed text-muted-foreground">
        {{ aboutMe }}
      </p>
      <p
        v-if="userLink"
        class="mb-4 flex items-center gap-2 text-primary hover:text-primary-foreground transition cursor-pointer"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 shrink-0"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M13.828 10.172a4 4 0 010 5.656l-3.536 3.536a4 4 0 01-5.656-5.656l1.414-1.414m6.364-2.828a4 4 0 015.656 5.656l-1.414 1.414m-4.242-4.242L9.172 9.172"
          />
        </svg>
        <a
          :href="userLink"
          target="_blank"
          rel="noopener noreferrer"
          class="underline font-semibold"
        >
          {{ userLink }}
        </a>
      </p>

      <!-- Following List -->
      <section class="mt-6">
        <p class="font-semibold text-card-foreground mb-3">Following</p>
        <div class="max-h-[480px] overflow-y-auto border border-border rounded-md p-2 scrollbar-hide">
          <FollowingList :list="followingList" :max="showAllFollowing ? undefined : 5" />
        </div>
        <button
          v-if="actualFollowingCount > 5"
          @click="toggleShowAllFollowing"
          class="mt-2 text-xs underline text-primary hover:text-primary-foreground transition"
        >
          {{ showAllFollowing ? 'See less...' : 'See more...' }}
        </button>
      </section>

      <!-- Follower List -->
      <section class="mt-6">
        <p class="font-semibold text-card-foreground mb-3">Follower</p>
        <div class="max-h-[480px] overflow-y-auto border border-border rounded-md p-2 scrollbar-hide">
          <FollowerList :list="followerList" :max="showAllFollower ? undefined : 5" />
        </div>
        <button
          v-if="actualFollowerCount > 5"
          @click="toggleShowAllFollower"
          class="mt-2 text-xs underline text-primary hover:text-primary-foreground transition"
        >
          {{ showAllFollower ? 'See less...' : 'See more...' }}
        </button>
      </section>
    </div>
  </aside>
</template>

<script setup lang="ts">
defineOptions({ name: 'ProfileSidebar' })

import { ref, computed, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import type { User } from '../../js/lib/types/user'
import profileImg from '../../../public/landingPage_img/profile.png'
import { useUserStore } from '../../js/stores/features/users/user'
import { useFollowStore } from '../../js/stores/features/follows/stores/FollowStore'
import { Button } from '../../js/components/ui/button'

const router = useRouter()
const userStore = useUserStore()
const followStore = useFollowStore()

const user = computed(() => userStore.user as User | null)
const avatarUrl = computed(() => user.value?.avatar || profileImg)
const displayName = computed(() => user.value?.name || user.value?.username || 'Anonymous')
const aboutMe = computed(() => user.value?.bio || 'No bio available.')
const userLink = computed(() => user.value?.link || '')

const showAllFollower = ref(false)
const showAllFollowing = ref(false)

const followerList = computed(() => followStore.followers)
const followingList = computed(() => followStore.following)

const followerCount = computed(() => followStore.followers.length)
const followingCount = computed(() => followStore.following.length)

const actualFollowerCount = computed(() => followStore.followers.length)
const actualFollowingCount = computed(() => followStore.following.length)

function goToSettings() {
  router.push('/settings')
}
function toggleShowAllFollowing() {
  showAllFollowing.value = !showAllFollowing.value
}
function toggleShowAllFollower() {
  showAllFollower.value = !showAllFollower.value
}

onMounted(async () => {
  if (user.value?.id) {
    await followStore.fetchFollowers(user.value.id)
    await followStore.fetchFollowing(user.value.id)
  }
})
</script>

<style scoped>
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
