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
        :pub_date="articleStore.formatDate(article.created_at)"
        :clapNum="article.likes_count?.toString() || '0'"
        :commentNum="article.comments_count?.toString() || '0'"
        :preview_img="article.image || '/feedpage_img/img1.jpg'"
      />
    </div>

    <!-- Load more button -->
    <div v-if="hasMoreArticles && articles.length > 0" class="text-center py-8">
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

    <!-- need to follow other users to see articles -->
    <div v-if="!isLoading && articles.length === 0 && !error" class="text-center py-8">
      <p class="text-gray-600">Follow users to see their articles</p>
      <button
        @click="loadArticles"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4"
      >
        Load Articles
      </button>
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
  const userId = parseInt(localStorage.getItem('userId'));

  // Load articles function
  const loadArticles = async () => {
    isLoading.value = true;
    error.value = null;
    currentPage.value = 1;
    hasMoreArticles.value = true;
    try {
      // alert('Loading articles for user ID: ' + userId);
      await articleStore.fetchFollowingArticles(userId);
      console.log('Articles loaded successfully:', articles.value);
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Unknown error occurred';
      console.error('Error loading articles:', err);
    } finally {
      isLoading.value = false;
    }
  };

  const loadMoreArticles = async () => {
    if (isLoadingMore.value || !hasMoreArticles.value) return;

    isLoadingMore.value = true;
    error.value = null;

    try {
      currentPage.value += 1;
      const newArticles = await articleStore.fetchMoreFollowingArticles(userId, currentPage.value);

      if (newArticles.current_page < newArticles.last_page) {
        hasMoreArticles.value = true;
      } else {
        hasMoreArticles.value = false;
      }
      console.log('More articles loaded:', newArticles);
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Unknown error occurred';
      console.error('Error loading more articles:', err);
    } finally {
      isLoadingMore.value = false;
    }
  }

  // Load articles when component mounts
  onMounted(() => {
    loadArticles();
  });
</script>
