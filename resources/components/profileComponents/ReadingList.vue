<template>
  <div class="relative w-full bg-background pt-4">
    <!-- Loading Overlay -->
    <div
      v-if="showLoading"
      class="fixed inset-0 flex items-center justify-center bg-background/60 z-50"
    >
      <div class="flex flex-col gap-4 w-full items-center justify-center">
        <div class="w-20 h-20 border-4 border-transparent animate-spin flex items-center justify-center border-t-primary rounded-full">
          <div class="w-16 h-16 border-4 border-transparent animate-spin flex items-center justify-center border-t-destructive rounded-full"></div>
        </div>
        <p class="mt-4 text-muted-foreground">Loading bookmarks...</p>
      </div>
    </div>

    <h2 class="text-h4 mb-3 text-card-foreground">Reading Lists</h2>

    <div class="w-full max-w-5xl mx-auto bg-card rounded-2xl border border-border transition">
      <div class="flex flex-col md:flex-row items-center p-6 gap-6">
        <!-- Profile Info -->
        <div class="flex items-center gap-4 flex-1 min-w-0 w-full md:w-auto">
          <img
            :src="avatarImage"
            alt="Profile picture"
            class="w-12 h-12 rounded-full border border-border object-cover shrink-0"
          />
          <div class="truncate">
            <p class="font-semibold text-card-foreground truncate max-w-[160px] body-1">
              {{ username }}
            </p>
            <p class="subtitle-2 text-muted-foreground">Reading lists</p>
            <p class="caption text-muted-foreground mt-1">
              {{ listCount }} {{ storyLabel }}
            </p>
          </div>
        </div>

        <!-- Bookmarks Preview -->
        <div class="flex flex-wrap gap-4 items-center justify-end min-w-[180px]">
          <template v-if="previewBookmarks.length">
            <div
              v-for="bookmark in previewBookmarks"
              :key="bookmark.id"
              class="relative group transition-transform hover:scale-105 cursor-pointer"
              @click="$emit('preview-click', bookmark.id)"
            >
              <img
                :src="bookmark.image || '/feedpage_img/img1.jpg'"
                alt="Bookmark image"
                class="w-16 h-16 rounded-xl object-cover border border-border shadow-md"
              />
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition flex items-end justify-center rounded-xl">
                <span class="text-xs text-white px-2 py-1 bg-black/50 rounded-b-xl w-full text-center truncate">
                  {{ bookmark.title || 'Untitled' }}
                </span>
              </div>
            </div>

            <!-- "More" Preview -->
            <div
              v-if="bookmarks.length > max"
              class="relative group transition-transform hover:scale-105 cursor-pointer flex items-center justify-center w-16 h-16 rounded-xl border border-border shadow-md bg-muted"
              @click="handleMoreClick"
              title="View all bookmarks"
            >
              <span class="text-lg font-semibold text-muted-foreground group-hover:text-primary transition">
                +{{ bookmarks.length - max }}
              </span>
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent opacity-0 group-hover:opacity-100 transition flex items-end justify-center rounded-xl">
                <span class="text-xs text-white px-2 py-1 bg-black/50 rounded-b-xl w-full text-center truncate">
                  more
                </span>
              </div>
            </div>
          </template>

          <!-- Empty State -->
          <template v-else>
            <div class="flex flex-col items-center text-muted-foreground py-8">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 5v14l7-7 7 7V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2z"/>
              </svg>
              <span class="caption">No bookmarks yet.</span>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import profileImg from '../../../public/landingPage_img/profile.png'
import { useUserStore } from '../../js/stores/features/users/user'
import { useBookmarkStore } from '../../js/stores/bookmark/stores/bookmarkStore'

const userStore = useUserStore()
const bookmarkStore = useBookmarkStore()

const props = defineProps({
  max: { type: Number, default: 3 }
})

const emit = defineEmits(['preview-click', 'view-all'])

const showLoading = ref(false)

const bookmarks = computed(() => bookmarkStore.bookmarks)
const previewBookmarks = computed(() => bookmarks.value.slice(0, props.max))

function handleMoreClick() {
  showLoading.value = true
  setTimeout(() => {
    showLoading.value = false
    emit('view-all')
  }, 800)
}

onMounted(() => {
  bookmarkStore.loadBookmarks()
})

const avatarImage = computed(() =>
  userStore.user?.avatar?.trim() ? userStore.user.avatar : profileImg
)
const username = computed(() => userStore.user?.username || 'Unknown User')
const listCount = computed(() => bookmarks.value?.length || 0)
const storyLabel = computed(() => listCount.value === 1 ? 'story' : 'stories')
</script>

<style scoped>
/* Add any component-specific styles here */
</style>
