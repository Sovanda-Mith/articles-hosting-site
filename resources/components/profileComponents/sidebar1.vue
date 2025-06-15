<template>
  <aside class="p-6 bg-card text-card-foreground rounded-lg shadow-md max-w-sm">
    <!-- Avatar & Username -->
    <div class="text-center">
      <img
        :src="avatarUrl"
        alt="Profile picture"
        class="mx-auto w-24 h-24 rounded-full border-2 border-border mb-2"
      />
      <p class="text-h7">{{ UsernameStore.username }}</p>
      <div class="body-1 mt-1 flex justify-center gap-8 text-muted-foreground select-none">
        <span><strong>{{ followersStore.followerCount }}</strong> Followers</span>
        <span><strong>{{ followingStore.followingCount }}</strong> Following</span>
      </div>

      <!-- Follow Button -->
      <button
        @click="isFollowing = !isFollowing"
        :class="[
          'mt-4 px-6 py-2 rounded-full text-sm font-bold uppercase transition',
          isFollowing
            ? 'bg-primary-foreground text-primary hover:bg-primary/90'
            : 'bg-primary text-primary-foreground hover:bg-primary/80'
        ]"
      >
        {{ isFollowing ? 'FOLLOWED' : 'FOLLOW' }}
      </button>
    </div>

    <!-- Bio + Link -->
    <div class="mt-6 border-t border-border pt-4 body-1 text-foreground">
      <p class="mb-4">{{ bio }}</p>
      <p class="mb-4">
        Writes <span class="font-semibold">The Sophist</span>:
        <a
          :href="link"
          class="text-primary underline hover:text-primary-foreground transition"
          target="_blank"
          rel="noopener noreferrer"
        >
          {{ linkText }}
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
import { useFollowingStore } from '@/stores/followingList/following'
import { useFollowersStore } from '@/stores/followerList/follower'
import { useListStore } from '../../js/stores/storyList/listStore'
import FollowingList from './FollowingList.vue'
import { useUsernameStore } from '../../js/stores/username/userName'

interface Props {
  name: string
  avatarUrl: string
  following: number
  followerCount: string
  bio: string
  link: string
  linkText: string
}

const props = defineProps<Props>()

const avatarUrl = computed(() => props.avatarUrl || profileImg)
const isFollowing = ref(false)
const showAllFollowing = ref(false)

const listStore = useListStore()

const followersStore = useFollowersStore()
const followingStore = useFollowingStore()

const actualFollowingCount = computed(() => followingStore.following.length)
const lists = computed(() => listStore.lists)

const UsernameStore = useUsernameStore()
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
