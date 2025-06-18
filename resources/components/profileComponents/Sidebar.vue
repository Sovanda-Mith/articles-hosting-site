<template>
  <aside class="p-6 bg-card text-card-foreground rounded-lg shadow-md max-w-sm">
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

      <Button @click="$emit('settings')" class="mt-4 px-6 py-2">
        Settings
      </Button>
    </div>

    <div class="mt-6 border-t border-border pt-4 body-1 text-foreground">
      <p class="text-h7 mb-3 text-card-foreground">About Me</p>

      <p class="mb-6 leading-relaxed text-base text-muted-foreground">
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

      <section class="mt-6">
        <p class="font-semibold text-card-foreground mb-3">Following</p>
        <div class="max-h-[480px] overflow-y-auto border border-border rounded-md p-2 scrollbar-hide">
          <FollowingList :max="showAllFollowing ? undefined : 5" :following="followingList" />
        </div>

        <button
          v-if="actualFollowingCount > 5"
          @click="toggleShowAllFollowing"
          class="mt-2 text-xs underline text-primary hover:text-primary-foreground transition"
        >
          {{ showAllFollowing ? 'See less...' : 'See more...' }}
        </button>
      </section>
    </div>
  </aside>
</template>

<script setup lang="ts">
defineOptions({ name: 'ProfileSidebar' })
import { ref, computed } from 'vue'
import profileImg from '../../../public/landingPage_img/profile.png'
import { useFollowingStore } from '@/stores/followingList/following'
import { useFollowersStore } from '@/stores/followerList/follower'
import FollowingList from '../../components/profileComponents/FollowingList.vue'
import { useUserStore } from '@/stores/features/user'
import { Button } from '../../js/components/ui/button'

const userStore = useUserStore()
const user = computed(() => userStore.user || {})

const avatarUrl = computed(() => user.value.avatar || profileImg)
const displayName = computed(() => user.value.name || user.value.username || 'Anonymous')
const aboutMe = computed(() => user.value.bio || 'No bio available.')
const userLink = computed(() => user.value.link || '')

const showAllFollowing = ref(false)
function toggleShowAllFollowing() {
  showAllFollowing.value = !showAllFollowing.value
}

const followersStore = useFollowersStore()
const followingStore = useFollowingStore()

const followerCount = computed(() => followersStore.followerCount)
const followingCount = computed(() => followingStore.followingCount)
const actualFollowingCount = computed(() => followingStore.following.length)
const followingList = computed(() => followingStore.following)
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
