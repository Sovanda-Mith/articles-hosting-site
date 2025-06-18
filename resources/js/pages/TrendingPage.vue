<template>

    <div class="flex flex-row justify-center items-start mx-50  min-w-[400px]">
        <button class="mt-8 pr-4" @click="goBack">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="size-6">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
            </svg>
        </button>

        <div>
            <div class="py-5 space-x-4 border-b-1 border-gray-300 flex flex-col">
                <div class="py-2 text-2xl font-semibold border-black">Trending</div>
                <p class="text-sm text-gray-500 ">Trending stories from across Medium</p>
            </div>
            <div class="bg-blue-50 ">
                <div v-if="idLoading" class="flex items-center justify-center py-8">
                    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
                </div>
                <div v-else-if="error" class="text-red-600 text-center py-8">
                    <p>{{ error }}</p>
                    <button @click="loadTrendingArticles" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
                        Retry
                    </button>
                </div>
                <div v-else-if="articles.length === 0" class="text-gray-500 text-center py-8">
                    <p>No trending articles found.</p>
                </div>
                <preview
                    v-for="article in articles"
                    :key="article.id"
                    :profile_img="'/feedpage_img/profile1.jpg'"
                    :publisherName="`User ${article.user_id}`"
                    :title="article.title"
                    :subtitle="article.subtitle || 'No subtitle available'"
                    :pub_date="articleStore.formatDate(article.created_at)"
                    :clapNum="article.likes_count?.toString() || '0'"
                    :commentNum="article.comments_count?.toString() || '0'"
                    :preview_img="article.image || '/feedpage_img/img1.jpg'"
                    :viewCount="article.view_count?.toString() || '0'"
                    :articleId="article.id"
                />
            </div>
        </div>

    </div>



</template>
<script setup lang="ts">
  import preview from '../../../resources/components/feedpage_comp/preview.vue';
  import { storeToRefs } from 'pinia';
  import { useArticleStore } from '../stores/features/articles/stores/ArticleStore';
  import { ref, onMounted } from 'vue';

  const articleStore = useArticleStore();
  const { articles } = storeToRefs(articleStore);

  const idLoading = ref(false);
  const error = ref<string | null>(null);

  //load trending articles
  const loadTrendingArticles = async () => {
      idLoading.value = true;
      error.value = null;

      try {
          await articleStore.fetchTrendingArticles();
          console.log(articles.value);
      } catch (err) {
          error.value = 'Failed to load trending articles';
          console.error(err);
      } finally {
          idLoading.value = false;
      }
  }

  const goBack = () => {
      window.history.back();
  };


  onMounted(() => {
      loadTrendingArticles();
  });
</script>
