<template>
  <div class="w-full min-h-screen bg-background pt-4">
    <h2 class="text-h4 mb-2 text-card-foreground">My Article</h2>
    <div :class="['space-y-6 max-w-5xl mx-auto', scrollableClass]">
      <div
        v-for="article in articleStore.articles"
        :key="article.id"
        class="flex flex-col gap-5 p-6 pl-12 border-b border-border last:border-b-0 bg-card text-card-foreground"
        @click="router.push(`/article/${article.id}`)"
      >
        <!-- Author Info -->
        <div class="flex items-center gap-3 text-base font-semibold">
          <img
            :src="article.image || '/feedpage_img/profile1.jpg'"
            alt="Avatar"
            class="w-8 h-8 rounded-full object-cover"
          />
          <span>{{ article.user?.name || 'Unknown User' }}</span>
        </div>

        <!-- Article Content -->
        <div class="flex flex-col md:flex-row justify-between gap-6">
          <div class="flex-1">
            <h3 class="text-h5 leading-snug">
              {{ article.title || 'Untitled' }}
            </h3>
            <p class="body-1 text-muted-foreground mb-3" :class="{ italic: !article.subtitle }">
              {{ article.subtitle || 'No description provided.' }}
            </p>
            <div class="flex items-center text-sm text-muted-foreground space-x-6">
              <span>{{ formatDate(article.created_at) }}</span>
              <span class="flex items-center gap-2">
                <i class="ri-hand-heart-line"></i> {{ article.likes_count || 0 }}
              </span>
              <span class="flex items-center gap-2">
                <i class="ri-chat-3-line"></i> {{ article.comments_count || 0 }}
              </span>
            </div>
          </div>
          <!-- Article Image -->
          <div>
            <img
              :src="article.image || '/feedpage_img/img1.jpg'"
              alt="Article image"
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
import { useArticleStore } from '../../js/stores/features/articles/stores/ArticleStore'
import { useRouter } from 'vue-router'

const articleStore = useArticleStore()
const router = useRouter()

const scrollableClass = computed(() =>
  articleStore.articles.length > 5
    ? 'max-h-[80vh] overflow-y-auto pr-2 scrollbar-hide'
    : ''
)

onMounted(async () => {
  const userId = localStorage.getItem('userId')
    if (userId) {
      await articleStore.fetchArticleByUserId(Number(userId))
    }
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
