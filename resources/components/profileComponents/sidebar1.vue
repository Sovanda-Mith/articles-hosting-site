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
          @click="handleFollowClick"
          variant="outline"
          class="px-4 py-2 flex items-center gap-2"
          title="Follow"
        >
          {{ isFollowed ? 'Unfollow' : 'Follow' }}
        </Button>
        <Button
          :as="user?.email ? 'a' : 'button'"
          :href="user?.email ? `mailto:${user.email}` : undefined"
          variant="ghost"
          class="px-4 py-2 flex items-center gap-2"
          :disabled="!user?.email"
          title="Send Email"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <rect x="3" y="5" width="18" height="14" rx="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M3 7l9 6 9-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Email
        </Button>
      </div>
    </div>

    <!-- Unfollow Confirmation Popup -->
    <div v-if="showPopup" class="fixed inset-0 flex items-center justify-center bg-black/20 backdrop-blur-sm z-50">
      <div class="bg-card text-card-foreground rounded-lg shadow-lg p-6 w-full max-w-sm">
        <p class="text-h5 mb-6">Are you sure you want to unfollow?</p>
        <div class="flex justify-end gap-2">
          <button
            @click="showPopup = false"
            class="px-4 py-2 rounded bg-muted hover:bg-muted/80 text-muted-foreground"
          >
            Cancel
          </button>
          <button
            @click="confirmUnfollow"
            class="text-white px-4 py-2 rounded bg-destructive hover:opacity-90"
          >
            Unfollow
          </button>
        </div>
      </div>
    </div>

    <!-- About Me Section -->
    <div class="mt-6 border-t border-border pt-4 body-1 text-foreground">
      <p class="text-h6 mb-3 text-card-foreground">About Me</p>
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

      <!-- Following List -->
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
      <section class="mt-6">
          <p class="font-semibold text-card-foreground mb-3">Followers</p>
          <div class="max-h-[480px] overflow-y-auto border border-border rounded-md p-2 scrollbar-hide">
            <FollowerList :max="showAllFollower ? undefined : 5" :followers="followerList" />
          </div>
          <button
            v-if="actualFollowerCount > 5"
            @click="toggleShowAllFollower"
            class="mt-2 text-xs underline text-primary hover:text-primary-foreground transition"
          >
            {{ showAllFollower ? 'See less...' : 'See more...' }}
          </button>
        </section>

      <!-- Bookmarks Section -->
      <section class="mt-6">
        <p class="font-semibold text-card-foreground mb-3">Bookmarks</p>
        <div
          :class="[
            'space-y-3 border border-border rounded-md p-2',
            bookmarks.length > 10 ? 'max-h-96 overflow-y-auto scrollbar-hide' : ''
          ]"
        >
          <div
            v-for="bookmark in displayedBookmarks"
            :key="bookmark.id"
            class="flex items-center gap-3 body-1"
          >
            <img
              :src="bookmark.image || '/feedpage_img/img1.jpg'"
              alt="bookmark"
              class="w-10 h-10 rounded object-cover border border-border"
            />
            <div class="truncate">
              <p class="text-sm font-semibold text-card-foreground truncate">
                {{ bookmark.title }}
              </p>
              <p class="text-xs text-muted-foreground truncate">
                {{ bookmark.description || 'No description.' }}
              </p>
            </div>
          </div>
        </div>
        <button
          v-if="bookmarks.length > 5 && !showAllBookmarks"
          @click="showAllBookmarks = true"
          class="mt-2 text-xs underline text-primary hover:text-primary-foreground transition"
        >
          See more...
        </button>
        <button
          v-if="bookmarks.length > 5 && showAllBookmarks"
          @click="showAllBookmarks = false"
          class="mt-2 text-xs underline text-primary hover:text-primary-foreground transition"
        >
          See less...
        </button>
      </section>
    </div>
  </aside>
</template>

<script setup lang="ts">
defineOptions({ name: 'ProfileSidebar' })

import { ref, computed, onMounted } from 'vue'
import type { User } from '../../js/lib/types/user'
import profileImg from '../../../public/landingPage_img/profile.png'
import { useUserStore } from '../../js/stores/features/users/user'
import { Button } from '../../js/components/ui/button'
import { useFollowStore } from '../../js/stores/features/follows/stores/FollowStore'
import { useBookmarkStore } from '../../js/stores/bookmark/stores/bookmarkStore'
import type { Bookmark } from '../../js/stores/bookmark/types/bookmark'

const userStore = useUserStore()
const user = computed(() => userStore.user as User | null)

const isFollowed = ref(false)
const showPopup = ref(false)

const avatarUrl = computed(() => user.value?.avatar || profileImg)
const displayName = computed(() => user.value?.name || user.value?.username || 'Anonymous')
const aboutMe = computed(() => user.value?.bio || 'No bio available.')
const userLink = computed(() => user.value?.link || '')

const showAllFollowing = ref(false)
const toggleShowAllFollowing = () => (showAllFollowing.value = !showAllFollowing.value)

const followStore = useFollowStore()
const followerCount = computed(() => followStore.followers.length)
const followingCount = computed(() => followStore.following.length)
const actualFollowingCount = computed(() => followStore.following.length)
const followingList = computed(() => followStore.following)

const showAllFollower = ref(false)
const toggleShowAllFollower = () => (showAllFollower.value = !showAllFollower.value)
const actualFollowerCount = computed(() => followStore.followers.length)
const followerList = computed(() => followStore.followers)

const handleFollowClick = () => {
  if (isFollowed.value) {
    showPopup.value = true
  } else {
    isFollowed.value = true
  }
}

const confirmUnfollow = () => {
  isFollowed.value = false
  showPopup.value = false
}

onMounted(async () => {
  if (user.value?.id) {
    await followStore.fetchFollowers(user.value.id)
    await followStore.fetchFollowing(user.value.id)
  }
})

// --- Bookmarks Section ---
const bookmarkStore = useBookmarkStore()
const bookmarks = computed<Bookmark[]>(() => bookmarkStore.bookmarks)
const showAllBookmarks = ref(false)

const displayedBookmarks = computed(() => {
  if (showAllBookmarks.value || bookmarks.value.length <= 10) {
    return bookmarks.value
  }
  return bookmarks.value.slice(0, 5)
})

onMounted(() => {
  bookmarkStore.loadBookmarks()
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
