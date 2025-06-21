<template>
  <div>
    <!-- Back Button -->
    <button
      @click="$emit('back')"
      class="mb-6 flex items-center gap-2 px-4 py-2 rounded bg-muted hover:bg-muted/80 text-muted-foreground transition"
    >
      <i class="ri-arrow-left-line text-lg"></i>
      Back
    </button>

    <div :class="['space-y-6', scrollableClass]">
      <div
        v-for="bookmark in bookmarkStore.bookmarks"
        :key="bookmark.id"
        class="flex flex-col gap-5 p-6 pl-12 rounded-xl bg-card text-card-foreground border-b border-border"
      >
        <!-- User Info -->
        <div class="flex items-center gap-3 text-base font-semibold">
          <img
            :src="bookmark.avatar || '/feedpage_img/profile1.jpg'"
            alt="Avatar"
            class="w-8 h-8 rounded-full object-cover"
          />
          <span>{{ bookmark.username || 'Unknown User' }}</span>
        </div>

        <!-- Bookmark Content -->
        <div class="flex flex-col md:flex-row justify-between gap-6">
          <div class="flex-1">
            <h3 class="text-h5 leading-snug">
              {{ bookmark.title || 'Untitled' }}
            </h3>
            <p class="body-1 text-muted-foreground mb-3" :class="{ italic: !bookmark.description }">
              {{ bookmark.description || 'No description provided.' }}
            </p>
            <div class="flex items-center text-sm text-muted-foreground space-x-6">
              <span>{{ formatDate(bookmark.date) }}</span>
              <span class="flex items-center gap-2">
                <i class="ri-bookmark-line"></i> Bookmarked
              </span>
              <span class="flex items-center gap-2">
                <i class="ri-hand-heart-line"></i> {{ bookmark.likes ?? 0 }}
              </span>
              <span class="flex items-center gap-2">
                <i class="ri-chat-3-line"></i> {{ bookmark.comments ?? 0 }}
              </span>
            </div>
          </div>
          <!-- Bookmark Image -->
          <div>
            <img
              :src="bookmark.image || '/feedpage_img/img1.jpg'"
              alt="Bookmark image"
              class="w-48 h-32 rounded-lg object-cover transition-transform duration-300 hover:scale-105 hover:shadow-lg"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted, computed } from 'vue'
import { useBookmarkStore } from '@/stores/bookmark/stores/bookmarkStore'

const bookmarkStore = useBookmarkStore()

const scrollableClass = computed(() =>
  bookmarkStore.bookmarks.length > 5
    ? 'max-h-[40rem] overflow-y-auto pr-2 scrollbar-hide'
    : ''
)

onMounted(() => {
  bookmarkStore.loadBookmarks()
})

function formatDate(dateStr?: string): string {
  if (!dateStr) return '—'
  const d = new Date(dateStr)
  return isNaN(d.getTime()) ? '—' : d.toLocaleDateString()
}
</script>

<style scoped>
@import 'https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css';

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
