<template>
  <div>
    <!-- Loading state -->
    <div v-if="isLoading && articles.length === 0" class="text-center py-8">
      <div class="flex-col gap-4 w-full flex items-center justify-center">
        <div
          class="w-20 h-20 border-4 border-transparent text-blue-400 text-4xl animate-spin flex items-center justify-center border-t-blue-400 rounded-full"
        >
          <div
            class="w-16 h-16 border-4 border-transparent text-red-400 text-2xl animate-spin flex items-center justify-center border-t-red-400 rounded-full"
          ></div>
        </div>
      </div>
      <p class="mt-4 text-gray-600">Loading articles...</p>
    </div>

    <!-- Error state -->
    <div v-else-if="error" class="text-center py-8">
      <p class="text-red-600 mb-4">Error loading articles: {{ error }}</p>
      <button
        @click="loadArticles"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
      >
        Retry
      </button>
    </div>

    <!-- Articles from API -->
    <div v-else-if="articles.length > 0">
      <preview
        v-for="article in articles"
        :key="article.id"
        :profile_img="'/feedpage_img/profile1.jpg'"
        :publisherName="`User ${article.user_id}`"
        :title="article.title"
        :subtitle="article.subtitle || 'No subtitle available'"
        :pub_date="formatDate(article.created_at)"
        :clapNum="article.likes_count?.toString() || '0'"
        :commentNum="article.comments_count?.toString() || '0'"
        :preview_img="article.image || '/feedpage_img/img1.jpg'"
        :viewCount="article.view_count?.toString() || '0'"
        :articleId="article.id"
      />
    </div>

    <!-- Load more button -->
    <div v-if="hasMoreArticles" class="text-center py-8">
      <button
        @click="loadMoreArticles"
        :disabled="isLoadingMore"
        class="bg-blue-500 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold py-2 px-4 rounded"
      >
        {{ isLoadingMore ? 'Loading...' : 'Load More' }}
      </button>
    </div>

    <!-- End of articles message -->
    <div v-if="!hasMoreArticles && articles.length > 0" class="text-center py-4">
      <p class="text-gray-500">No more articles to load</p>
    </div>

    <!-- No articles state -->
    <div v-else-if="!isLoading && articles.length === 0" class="text-center py-8">
      <p class="text-gray-600">No articles found</p>
      <button
        @click="loadArticles"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4"
      >
        Load Articles
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
  import { ref, onMounted } from 'vue';
  import { useArticleStore } from '../stores/features/articles/stores/ArticleStore';
  import { storeToRefs } from 'pinia';
  import preview from '../../../resources/components/feedpage_comp/preview.vue';

  // Define component name
  defineOptions({
    name: 'ForYouPage',
  });

  // Use the article store
  const articleStore = useArticleStore();
  const { articles } = storeToRefs(articleStore);

  // Local reactive state
  const isLoading = ref(false);
  const error = ref<string | null>(null);
  const isLoadingMore = ref(false);
  const hasMoreArticles = ref(true);
  const currentPage = ref(1);

  // Load articles function
  const loadArticles = async () => {
    isLoading.value = true;
    error.value = null;
    currentPage.value = 1;
    hasMoreArticles.value = true;
    // try {
    //   await articleStore.fetchArticles();
    //   console.log('Articles loaded successfully:', articles.value);
    // } catch (err) {
    //   error.value = err instanceof Error ? err.message : 'Unknown error occurred';
    //   console.error('Error loading articles:', err);
    // } finally {
    //   isLoading.value = false;
    // }
    try {
      const response = await articleStore.fetchArticles(1, false); // explicitly pass page and append flag
      console.log('Articles loaded successfully:', articles.value);

      // Update hasMoreArticles based on response
      hasMoreArticles.value = response.current_page < response.last_page;
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Unknown error occurred';
      console.error('Error loading articles:', err);
    }
  };

  const loadMoreArticles = async () => {
    // Check local loading state
    if (isLoadingMore.value || !hasMoreArticles.value) return;

    isLoadingMore.value = true;
    error.value = null;

    try {
      const nextPage = currentPage.value + 1;
      const response = await articleStore.fetchArticles(nextPage, true); // append = true

      currentPage.value = response.current_page;
      hasMoreArticles.value = response.current_page < response.last_page;

    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Unknown error occurred';
      console.error('Error loading more articles:', err);
    } finally {
      isLoadingMore.value = false;
    }
  };

  // Format date
  const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
    });
  };

  // Load articles when component mounts
  onMounted(() => {
    loadArticles();
  });
</script>
