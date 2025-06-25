<template>
    <div class="max-w-[800px] mx-auto p-5">
      <div class="flex gap-[10px] mb-5">
        <input 
          class="flex-grow p-2 border border-gray-300 rounded"
          type="text"
          v-model="searchQuery"
          @keyup.enter="performSearch"
          placeholder="Search articles..."
        />
        <select
          class="py-2 px-3 border border-gray-300 rounded"
          v-model="selectedCategory">
          <option value="">All Categories</option>
          <option v-for="category in categories" :key="category" :value="category">
            {{ category }}
          </option>
        </select>
        <button 
          class="py-2 px-4 bg-blue-500 text-white rounded border-0 cursor-pointer hover:bg-blue-600"
          @click="performSearch"
        >
          Search
        </button>
      </div>
      
      <div v-if="searchResults.length > 0" class="results">
        <Search :articles="searchResults" />
        <button 
          v-if="hasMoreResults" 
          @click="loadMoreResults"
          :disabled="isLoading"
        >
          {{ isLoading ? 'Loading...' : 'Load More' }}
        </button>
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { ref, computed, onMounted } from 'vue';
  import { useArticleStore } from '../stores/features/articles/stores/ArticleStore';
  import Search from 'resources/components/feedpage_comp/search.vue'
  
  const articleStore = useArticleStore();
  const searchQuery = ref('');
  const selectedCategory = ref('');
  const currentSearchPage = ref(1);
  const isLoading = ref(false);
  
  // Example categories - you might want to fetch these from your backend
  const categories = ref(['Technology', 'Science', 'Business', 'Health']);
  
  const searchResults = computed(() => articleStore.articles);
  const hasMoreResults = computed(() => articleStore.currentPage < articleStore.lastPage);
  
  const performSearch = async () => {
    currentSearchPage.value = 1;
    await articleStore.searchArticles(
      searchQuery.value, 
      1, 
      selectedCategory.value
    );
  };
  
  const loadMoreResults = async () => {
    currentSearchPage.value++;
    await articleStore.searchArticles(
      searchQuery.value, 
      currentSearchPage.value, 
      selectedCategory.value
    );
  };
  
  onMounted(async () => {
    // Optional: Load initial data
  });
  </script>
  
  <style scoped>
  </style>