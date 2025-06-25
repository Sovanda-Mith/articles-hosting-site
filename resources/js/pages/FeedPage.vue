 <template>
    <AppHeader />
        <div class="flex flex-row justify-center items-start ml-72 mr-40 mt-20 mb-32 sm:ml-32  ">

            <!-- Left Column (Main Content) -->
            <div class="flex flex-col md:w-[100%] min-w-[400px] lg:pr-8 xl:pr-32 ">

                <div class="sticky top-1/12 bg-white">
                    <div class=" flex items-center justify-between  px-4">
                        <div class=" flex flex-1 justify-center">
                            <div class="py-5 space-x-4 text-xl">
                                <router-link to="/feed/foryou" active-class="active-tab">For You</router-link>
                                <router-link to="/feed/following" active-class="active-tab">Following</router-link>
                            </div>
                        </div>

                        <!-- Search Toggle Button -->
                        <button
                            @click="toggleSearch"
                            class="border p-2 w-10 rounded-sm ml-2"
                            :class="{ 'bg-gray-200': showSearch }"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Search Bar (Conditional) -->
                    <div v-if="showSearch" class="px-4 pb-4">
                        <div class="flex gap-2">
                        <input
                            v-model="searchQuery"
                            @keyup.enter="performSearch"
                            placeholder="Search by title or publisher..."
                            class="flex-1 p-2 border border-gray-300 rounded"
                        />

                        <button
                            @click="performSearch"
                            class="px-4 bg-blue-500 text-white rounded"
                            :disabled="isLoading"
                        >
                            Search
                        </button>
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div>
                    <!-- Show search results when searching -->
                    <template v-if="isSearching && showSearch">
                        <div v-if="articleStore.articles.length > 0">
                            <preview
                                v-for="article in articleStore.articles"
                                :key="article.id"
                                :profile_img="'/feedpage_img/profile1.jpg'"
                                :publisherName="`${article.user?.name || 'Unknown User'}`"
                                :title="article.title"
                                :subtitle="article.subtitle || 'No subtitle available'"
                                :pub_date="articleStore.formatDate(article.created_at)"
                                :clapNum="article.likes_count?.toString() || '0'"
                                :commentNum="article.comments_count?.toString() || '0'"
                                :preview_img="article.image || '/feedpage_img/img1.jpg'"
                                :viewCount="article.view_count?.toString() || '0'"
                                :articleId="article.id"
                            />
                            <button
                                v-if="hasMoreResults && !isLoading"
                                @click="loadMoreResults"
                                class="w-full py-2 my-4 bg-gray-100 hover:bg-gray-200"
                            >
                                Load More
                            </button>
                        </div>
                        <div v-else-if="searchQuery" class="py-10 text-center text-gray-500">
                            No articles found matching your search
                        </div>
                    </template>

                    <!-- Show regular feed when not searching -->
                    <router-view></router-view>
                </div>
            </div>

            <div class="hide md:flex md:flex-col md:w-[40%] sticky top-1/12 min-w-[300px] xl:min-w-[400px] lg:min-w-[300px]">
                <div class="py-5 space-x-4 border-b-1 border-gray-300 ">
                    <div class="py-2 text-xl font-semibold border-black">Trending</div>
                </div>

                <div>
                    <!-- Loading state for trending -->
                    <div v-if="isTrendingLoading" class="flex items-center justify-center py-4">
                        <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-blue-500"></div>
                    </div>

                    <!-- Trending articles -->
                    <div v-else-if="trendingArticles.length > 0">
                        <trending_preview
                            v-for="article in trendingArticles"
                            :key="article.id"
                            :profile_img="'/feedpage_img/profile1.jpg'"
                            :publisherName="`${article.user?.name || 'Unknown User'}`"
                            :title="article.title"
                            :pub_date="articleStore.formatDate(article.created_at)"
                            :clapNum="article.likes_count?.toString() || '0'"
                            :commentNum="article.comments_count?.toString() || '0'"
                            :preview_img="article.image || '/feedpage_img/img1.jpg'"
                            :viewCount="article.view_count?.toString() || '0'"
                            :articleId="article.id"
                        />
                        <router-link to="/feed/trending" active-class="active-tab" class="text-sm text-gray-500 hover:underline">See the full list</router-link>
                    </div>

                    <!-- No trending articles -->
                    <div v-else class="py-4 text-center text-gray-500">
                        <p>No trending articles available</p>
                    </div>
                </div>
            </div>
        </div>
</template>

<script setup lang="ts">
  import AppHeader from '../../components/landingPage_comp/Header.vue';
  import preview from "../../../resources/components/feedpage_comp/preview.vue";
  import trending_preview from "../../../resources/components/feedpage_comp/trending_preview.vue";
  import { useArticleStore } from '../stores/features/articles/stores/ArticleStore';
  import { storeToRefs } from 'pinia';
  import { ref, onMounted, computed } from 'vue';

  const articleStore = useArticleStore();
  const { trendingArticles, currentPage, lastPage, isTrendingLoading } = storeToRefs(articleStore);

  const idLoading = ref(false);
  const error = ref<string | null>(null);

    // Search state
  const showSearch = ref(false);
  const searchQuery = ref('');
  const isSearching = ref(false);
  const isLoading = ref(false);
  const hasMoreResults = computed(() => currentPage.value < lastPage.value);

  //load trending articles
  const loadTrendingArticles = async () => {
      console.log('Loading trending articles...');
      idLoading.value = true;
      error.value = null;

      try {
          await articleStore.fetchTrendingArticles();
          console.log('Trending articles loaded:', trendingArticles.value.length);
      } catch (err) {
          error.value = 'Failed to load trending articles';
          console.error(err);
      } finally {
          idLoading.value = false;
      }
  }

   // Search functions
   const performSearch = async () => {
    if (!searchQuery.value.trim()) return;

    isLoading.value = true;
    isSearching.value = true;
    try {
        await articleStore.searchArticles(searchQuery.value, 1);
    } catch (error) {
        console.error('Search failed:', error);
    } finally {
        isLoading.value = false;
    }
  };

  const loadMoreResults = async () => {
    if (isLoading.value) return;

    isLoading.value = true;
    try {
        await articleStore.searchArticles(
            searchQuery.value,
            currentPage.value + 1
        );
    } catch (error) {
        console.error('Failed to load more results:', error);
    } finally {
        isLoading.value = false;
    }
 };

  const toggleSearch = () => {
    showSearch.value = !showSearch.value;
    if (!showSearch.value) {
      isSearching.value = false;
      searchQuery.value = '';
      articleStore.resetArticles();
    }
  };

  onMounted(() => {
      loadTrendingArticles();
  });
</script>

<style scoped>
.active-tab {
  font-weight: bold;
  border-bottom: 2px solid black;
}

@media (max-width: 1200px) {
  .hide {
    display: none;
  }
}

</style>

