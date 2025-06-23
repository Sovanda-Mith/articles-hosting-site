import { defineStore } from 'pinia'
import type { CardItem } from '@/stores/card/types/card'
import { useArticleStore } from '@/stores/features/articles/stores/ArticleStore'
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const ArticleStore = useArticleStore()
const route = useRoute()

onMounted(async () => {
    const userId = route.params.userid || route.query.userId
    if (userId) {
      await ArticleStore.fetchArticleByUserId(Number(userId))
    }
})

