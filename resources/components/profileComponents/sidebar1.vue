<template>
  <aside class="p-6 bg-card text-card-foreground rounded-lg shadow-md max-w-sm">
    <!-- Profile Header -->
    <div class="text-center">
      <img
        :src="avatarUrl"
        alt="Profile picture"
        class="mx-auto w-24 h-24 rounded-full border-2 border-border mb-2"
      />
      <p class="font-semibold text-lg">{{ props.user.name || props.user.username || 'Anonymous' }}</p>

      <div class="body-1 mt-1 flex justify-center gap-8 text-muted-foreground select-none">
        <span><strong>{{ followerCount }}</strong> Followers</span>
        <span><strong>{{ followingCount }}</strong> Following</span>
      </div>

      <div class="mt-4 flex justify-center gap-2">
        <Button
          @click="handleFollowClick"
          class="px-6 py-2"
        >
          {{ isFollowing ? 'Followed' : 'Follow' }}
        </Button>
        <Button
          :href="props.user.email ? `mailto:${props.user.email}` : undefined"
          class="px-6 py-2"
          title="Send Email"
          :disabled="!props.user.email"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <rect x="3" y="5" width="18" height="14" rx="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M3 7l9 6 9-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </Button>
      </div>

      <div
        v-if="showUnfollowConfirm"
        class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-lg p-6 max-w-xs w-full text-center z-50"
        style="background-color: white;"
      >
        <p class="mb-4 text-base text-gray-800">Are you sure you want to unfollow this person?</p>
        <div class="flex justify-center gap-4">
          <Button @click="confirmUnfollow" class="px-4 py-2">Yes</Button>
          <Button @click="showUnfollowConfirm = false" class="px-4 py-2" variant="outline">No</Button>
        </div>
      </div>
    </div>
    <!-- Bio + Link -->
    <div class="mt-6 border-t border-border pt-4 body-1 text-foreground">
      <h3 class="text-lg font-semibold mb-3 text-card-foreground">About Me</h3>

      <p class="mb-6 leading-relaxed text-base text-muted-foreground">
        {{ props.user.bio || 'No bio available.' }}
      </p>

      <p
        v-if="props.user.link"
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
          :href="props.user.link"
          target="_blank"
          rel="noopener noreferrer"
          class="underline font-semibold"
        >
          {{ props.user.link }}
        </a>
      </p>

      <!-- Following List -->
      <section class="mt-6">
        <p class="font-semibold text-card-foreground mb-3">Following</p>
        <div class="max-h-[480px] overflow-y-auto border border-border rounded-md p-2 scrollbar-hide">
          <FollowingList :max="showAllFollowing ? undefined : 5" />
        </div>

        <button
          v-if="actualFollowingCount > 5"
          @click="showAllFollowing = !showAllFollowing"
          class="mt-2 text-xs underline cursor-pointer text-primary hover:text-primary-foreground transition"
        >
          {{ showAllFollowing ? 'See less...' : 'See more...' }}
        </button>
      </section>

      <!-- Reading Lists -->
      <section class="mt-6">
        <p class="font-semibold text-card-foreground mb-3">Lists</p>
        <ul class="space-y-3">
          <li
            v-for="(list, index) in lists"
            :key="index"
            class="flex items-center gap-3 body-1"
          >
            <img
              :src="list.image"
              alt="list"
              class="w-10 h-10 rounded object-cover border border-border"
            />
            <div>
              <p class="text-sm font-semibold text-card-foreground">{{ list.title }}</p>
              <p class="text-xs text-muted-foreground">
                {{ list.stories }} stories · {{ list.saves }} save
              </p>
            </div>
          </li>
        </ul>
      </section>
    </div>
  </aside>
</template>


<script setup lang="ts">
defineOptions({ name: 'ProfileSidebar' })
import { ref, computed } from 'vue'
import profileImg from '../../../public/landingPage_img/profile.png'
import { useListStore } from '../../js/stores/features/storyList/listStore'
import FollowingList from './FollowingList.vue'
import { Button } from '@/components/ui/button'
import type { User } from '../../js/lib/types/user'

// Define props
const props = defineProps<{
  user: User
}>()

const listStore = useListStore()
const lists = computed(() => listStore.lists)

const avatarUrl = ref(profileImg)

const isFollowing = ref(false)
const followerCount = ref(0)
const followingCount = ref(0)
const showAllFollowing = ref(false)
const actualFollowingCount = ref(10) // Example value, adjust based on your needs


const showUnfollowConfirm = ref(false)

function handleFollowClick() {
  if (isFollowing.value) {
    showUnfollowConfirm.value = true
  } else {
    isFollowing.value = true
  }
}

function confirmUnfollow() {
  isFollowing.value = false
  showUnfollowConfirm.value = false
}


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
