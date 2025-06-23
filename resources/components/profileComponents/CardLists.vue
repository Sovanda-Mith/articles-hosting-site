<template>
  <div
    class="space-y-6"
    :class="scrollableClass"
  >
    <div
      v-for="card in articles"
      :key="card.id"
      @click="navigateToArticle(card.id)"
      class="flex flex-col gap-5 p-6 pl-12 rounded-xl bg-card text-card-foreground border-b border-border cursor-pointer hover:bg-muted/50 transition-colors duration-200"
    >
      <!-- Card Header -->
      <div class="flex items-center gap-3 text-base font-semibold">
        <img
          :src="card.image || '/feedpage_img/profile1.jpg'"
          alt="Avatar"
          class="w-8 h-8 rounded-full object-cover"
        />
        <span>{{ card.title || 'Untitled' }}</span>
      </div>

      <div class="flex flex-col md:flex-row justify-between gap-6">
        <div class="flex-1">
          <h3 class="text-h5 font-bold leading-snug">{{ card.title || 'Untitled' }}</h3>

          <p v-if="card.subtitle" class="body-1 text-muted-foreground mb-3">
            {{ card.subtitle }}
          </p>
          <p v-else class="body-1 text-muted-foreground mb-3 italic">
            No description provided.
          </p>
          <div class="flex items-center text-sm text-muted-foreground space-x-6">
            <span>{{ formatDate(card.created_at) }}</span>
            <span class="flex items-center gap-2">
              <i class="ri-hand-heart-line"></i> {{ card.likes_count ?? 0 }}
            </span>
            <span class="flex items-center gap-2">
              <i class="ri-chat-3-line"></i> {{ card.comments_count ?? 0 }}
            </span>
          </div>
        </div>
        <div>
          <img
            :src="card.image || '/feedpage_img/img1.jpg'"
            alt="Card image"
            class="w-48 h-32 rounded-lg object-cover transition-transform duration-300 hover:scale-105 hover:shadow-lg"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted, computed } from 'vue'
import { useArticleStore } from '@/stores/features/articles/stores/ArticleStore'
import { storeToRefs } from 'pinia'
import { useRoute, useRouter } from 'vue-router'

const articleStore = useArticleStore()
const router = useRouter()

const { articles } = storeToRefs(articleStore)

const scrollableClass = computed(() =>
  articles.value.length > 5
    ? 'max-h-[40rem] overflow-y-auto pr-2 scrollbar-hide'
    : ''
)

const ArticleStore = useArticleStore()
const route = useRoute()

onMounted(async () => {
    const userId = route.params.userid || route.query.userId
    if (userId) {
      await ArticleStore.fetchArticleByUserId(Number(userId))
    }
})

function formatDate(dateStr: string | undefined): string {
  if (!dateStr) return '—'
  const d = new Date(dateStr)
  return isNaN(d.getTime()) ? '—' : d.toLocaleDateString()
}

function navigateToArticle(articleId: number) {
  router.push(`/article/${articleId}`)
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
