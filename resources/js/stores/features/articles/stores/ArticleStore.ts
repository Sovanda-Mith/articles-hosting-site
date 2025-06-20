import { defineStore } from 'pinia';
import type ArticleInterface from '../types/ArticleInterface';
// import { ArticleStatus } from '../types/ArticleInterface'
import { computed, ref } from 'vue';
import { ArticleApi } from '../api/ArticleApi';
import { nextTick } from 'vue';

export const useArticleStore = defineStore('article', () => {
  //state
  const articles = ref<ArticleInterface[]>([]);
  const currArticle = ref<ArticleInterface | null>(null);
  const currentPage = ref<number>(1);
  const lastPage = ref<number>(1);
  const totalArticles = ref<number>(0);
  const isLoading = ref(false);
  const isLoadingMore = ref(false);
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  let currentRequest: Promise<any> | null = null;

  //getters
  const getAllArticles = computed(() => articles.value);
  const getFollowingArticles = computed(() => {
    return articles.value.filter((article) => article.user_id === 56);
  });
  const hasMoreArticles = computed(() => {
    return currentPage.value < lastPage.value;
  });

  //actions
  const fetchArticles = async (page: number = 1, append: boolean = false) => {
    // Prevent multiple simultaneous requests
    if (isLoading.value && page === 1) return;
    if (isLoadingMore.value && page > 1) return;

    // Set loading states
    if (page === 1) {
      isLoading.value = true;
    } else {
      isLoadingMore.value = true;
    }

    try {
      // Cancel previous request if it exists
      if (currentRequest) {
        // You might want to implement request cancellation here
      }

      currentRequest = ArticleApi.getArticles(page);
      const response = await currentRequest;

      console.log('fetchArticles', response, 'page:', page);

      // Use nextTick to ensure DOM updates are processed
      await nextTick(() => {
        if (page === 1 && !append) {
          articles.value = response.articles;
        } else {
          // Prevent duplicates by checking IDs
          const existingIds = new Set(articles.value.map(article => article.id));
          const newArticles = response.articles.filter(article => !existingIds.has(article.id));
          articles.value = [...articles.value, ...newArticles];
        }

        currentPage.value = response.current_page;
        lastPage.value = response.last_page;
        totalArticles.value = response.total;
      });

      return response;
    } finally {
      currentRequest = null;
      isLoading.value = false;
      isLoadingMore.value = false;
    }
  };

  // Simplified - remove fetchMoreArticles since fetchArticles handles both cases
  const fetchFollowingArticles = async (user_id: number, page: number = 1, append: boolean = false) => {
    if (isLoading.value && page === 1) return;
    if (isLoadingMore.value && page > 1) return;

    if (page === 1) {
      isLoading.value = true;
    } else {
      isLoadingMore.value = true;
    }

    try {
      const response = await ArticleApi.getFollowingArticles(user_id, page);

      await nextTick(() => {
        if (page === 1 && !append) {
          articles.value = response.articles;
        } else {
          const existingIds = new Set(articles.value.map(article => article.id));
          const newArticles = response.articles.filter(article => !existingIds.has(article.id));
          articles.value = [...articles.value, ...newArticles];
        }

        currentPage.value = response.current_page;
        lastPage.value = response.last_page;
        totalArticles.value = response.total;
      });

      return response;
    } finally {
      isLoading.value = false;
      isLoadingMore.value = false;
    }
  };

  const fetchTrendingArticles = async (page: number = 1, append: boolean = false) => {
    if (isLoading.value && page === 1) return;
    if (isLoadingMore.value && page > 1) return;

    if (page === 1) {
      isLoading.value = true;
    } else {
      isLoadingMore.value = true;
    }

    try {
      const response = await ArticleApi.getTrendingArticles(page);

      console.log('fetchTrendingArticles', response, 'page:', page);

      await nextTick(() => {
        if (page === 1 && !append) {
          articles.value = response.articles;
        } else {
          const existingIds = new Set(articles.value.map(article => article.id));
          const newArticles = response.articles.filter(article => !existingIds.has(article.id));
          articles.value = [...articles.value, ...newArticles];
        }

        currentPage.value = response.current_page;
        lastPage.value = response.last_page;
        totalArticles.value = response.total;
      });

      return response;
    } finally {
      isLoading.value = false;
      isLoadingMore.value = false;
    }
  };
  const fetchArticleById = async (id: number) => {
    const response = await ArticleApi.getArticleById(id);
    currArticle.value = response;
    return response;
  };

  const resetArticles = () => {
    articles.value = [];
    currentPage.value = 1;
    lastPage.value = 1;
    totalArticles.value = 0;
  };

  const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
    });
  };

  return {
    articles,
    currArticle,
    currentPage,
    lastPage,
    totalArticles,
    getAllArticles,
    getFollowingArticles,
    hasMoreArticles,
    fetchArticles,
    // fetchMoreArticles,
    resetArticles,
    fetchFollowingArticles,
    // fetchMoreFollowingArticles,
    fetchTrendingArticles,
    fetchArticleById,
    formatDate,
  };
});
