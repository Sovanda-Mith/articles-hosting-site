<template>
  <aside class="p-6 bg-card text-card-foreground rounded-lg shadow-md max-w-sm relative">
    <!-- Avatar & Username -->
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
      <div class="flex justify-center gap-3 mt-4">
        <Button
          v-if="!isOwner"
          @click="handleFollowClick"
          variant="outline"
          class="px-4 py-2 flex items-center gap-2"
          title="Follow"
        >
          {{ isFollowing ? 'Following' : 'Follow' }}
        </Button>
        <Button
          :as="user?.email ? 'a' : 'button'"
          :href="props.user?.email ? `mailto:${props.user.email}` : undefined"
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
          <FollowingList :userId="props.user.id" :max="showAllFollowing ? undefined : 5" />
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
import { ref, computed, onMounted, watch } from 'vue'
import axios from 'axios'
import profileImg from '../../../public/landingPage_img/profile.png'
// import { useListStore } from '../../js/stores/features/storyList/listStore'
import FollowingList from './FollowingList.vue'
import { Button } from '@/components/ui/button'
import { useUserStore } from '../../js/stores/features/users/user'
import type { User } from '../../js/lib/types/user'
import { useFollowStore } from '@/stores/features/follows/stores/FollowStore'
import { useBookmarkStore } from '../../js/stores/bookmark/stores/bookmarkStore'
import type { Bookmark } from '../../js/stores/bookmark/types/bookmark'

// Define props
const props = defineProps<{
  user: User
}>()

// const listStore = useListStore()
const userStore = useUserStore()
const followStore = useFollowStore()
// const lists = computed(() => listStore.lists)
const showPopup = ref(false)

const avatarUrl = computed(() => props.user.avatar || profileImg)

const isFollowing = ref(false)
const followerCount = ref(props.user.followers_count || 0)
const followingCount = ref(props.user.following_count || 0)

const showAllFollowing = ref(false)
const actualFollowingCount = ref(10) // Example value, adjust based on your needs
const followId = ref(null)

const showUnfollowConfirm = ref(false)
const toggleShowAllFollowing = () => (showAllFollowing.value = !showAllFollowing.value)
const showAllFollower = ref(false)
const toggleShowAllFollower = () => (showAllFollower.value = !showAllFollower.value)
const actualFollowerCount = computed(() => followStore.followers.length)
const followerList = computed(() => followStore.followers)

const isOwner = computed(() => userStore.user?.id === props.user?.id);

const checkIfFollowing = async () => {
  const authToken = userStore.user?.token || localStorage.getItem("auth_token");

  if (!authToken || !props.user?.id) {
    // console.log('No auth token or user ID for follow check');
    return;
  }

  try {
    // console.log('Checking if following user:', props.user.id);
    const response = await axios.post(
      `/api/follows/checkIfFollowing`,
      {
        following_id: props.user.id,
      },
      {
        headers: {
          Authorization: `Bearer ${authToken}`,
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      }
    );
    if (response.status === 200) {
      // console.log('Follow check response:', response.data);
      isFollowing.value = response.data.following || false;
      followId.value = response.data.follow_id || null;
    }
  } catch (error) {
    console.error('Error checking follow status:', error);
    // Reset to default values on error
    isFollowing.value = false;
    followId.value = null;
  }
};

const toggleFollowUser = async () => {
  if (isFollowing.value) {
    await unfollowUser();
    return;
  }

  const authToken = userStore.user?.token || localStorage.getItem("auth_token");
  if (!authToken) {
    console.error('No auth token available for follow action');
    return;
  }

  try {
    console.log('Following user:', props.user.id);
    const response = await axios.post(
      `/api/follows`,
      {
        following_id: props.user.id,
      },
      {
        headers: {
          Authorization: `Bearer ${authToken}`,
          "Content-Type": "application/json",
          Accept: "application/json",
        },
      }
    );
    if (response.status === 201) {
      // console.log('Follow response:', response.data);
      isFollowing.value = true;
      followId.value = response.data.id;
      followerCount.value += 1;
    }
  } catch (error) {
    console.error('Error following user:', error);
  }
};

const unfollowUser = async () => {
  const authToken = userStore.user?.token || localStorage.getItem("auth_token");
  if (!authToken || !followId.value) {
    console.error('No auth token or follow ID available for unfollow action');
    return;
  }

  try {
    console.log('Unfollowing user, follow ID:', followId.value);
    const response = await axios.delete(`/api/follows/${followId.value}`, {
      headers: {
        Authorization: `Bearer ${authToken}`,
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    });
    if (response.status === 204) {
      console.log('Unfollow successful');
      isFollowing.value = false;
      followId.value = null;
      followerCount.value -= 1;
    }
  } catch (error) {
    console.error('Error unfollowing user:', error);
  }
};

const getFollowersCount = async () => {
  await new Promise(resolve => setTimeout(resolve, 500));
  if (!props.user?.id) {
    console.log('No user ID provided for followers count');
    return;
  }
  try {
    // console.log('Fetching followers count via followStore:', props.user.id);

    const followerResult = await followStore.fetchCountFollowers(props.user.id);

    if (followerResult !== undefined && followerResult !== null) {
      followerCount.value = followerResult;
      // console.log('Using follower count from store:', followerResult);
      return;
    }
  } catch (error) {
    console.error('Error fetching followers count from store:', error);
  }
};

const getFollowingCount = async () => {
  if (!props.user?.id) {
    console.log('No user ID provided for following count');
    return;
  }

  try {
    // console.log('Fetching following count via followStore:', props.user.id);

    const followingResult = await followStore.fetchCountFollowing(props.user.id);

    if (followingResult !== undefined && followingResult !== null) {
      followingCount.value = followingResult;
      actualFollowingCount.value = followingResult;
      // console.log('Using following count from store:', followingResult);
      return;
    }
  } catch (error) {
    console.error('Error fetching following count from store:', error);
  }
};

const handleFollowClick = () => {
  if (isFollowing.value) {
    showPopup.value = true
  } else {
    toggleFollowUser()
  }
}

function confirmUnfollow() {
  unfollowUser()
  showUnfollowConfirm.value = false
}

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

onMounted(async () => {
  // Fetch follow counts
  await getFollowersCount();
  await getFollowingCount();
  bookmarkStore.loadBookmarks();

  // Only check if following when viewing someone else's profile and user is authenticated
  if (!isOwner.value && (userStore.user?.token || localStorage.getItem("auth_token"))) {
    await checkIfFollowing();
  }
  });

  // Watch for changes in the user prop to refresh follow status
  watch(() => props.user.id, async (newUserId, oldUserId) => {
    if (newUserId && newUserId !== oldUserId) {
      // Reset follow status
      isFollowing.value = false;
      followId.value = null;

      // Update initial counts from props
      followerCount.value = props.user.followers_count || 0;
      followingCount.value = props.user.following_count || 0;

      // Fetch updated counts
      await getFollowersCount();
      await getFollowingCount();

      if (!isOwner.value && (userStore.user?.token || localStorage.getItem("auth_token"))) {
        await checkIfFollowing();
      }
    }
});

// Watch for changes in user prop counts
watch(() => [props.user.followers_count, props.user.following_count], ([newFollowers, newFollowing]) => {
  if (newFollowers !== undefined) followerCount.value = newFollowers;
  if (newFollowing !== undefined) followingCount.value = newFollowing;
});


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
