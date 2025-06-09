import { defineStore } from 'pinia';
<<<<<<< HEAD
import type ArticleInterface from '../types/ArticleInterface'
=======
import type ArticleInterface from '../types/ArticleInterface';
>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106
// import { ArticleStatus } from '../types/ArticleInterface'
import { computed, ref } from 'vue';
import { ArticleApi } from '../api/ArticleApi';

export const useArticleStore = defineStore('article', () => {
  //state
<<<<<<< HEAD
  const articles = ref<ArticleInterface[]>([])
  const currArticle = ref<ArticleInterface | null>(null)
  const currentPage = ref<number>(1)
  const lastPage = ref<number>(1)
  const totalArticles = ref<number>(0)

  //getters
  const getAllArticles = computed(() => articles.value)
  const getFollowingArticles = computed(() => {
    return articles.value.filter(article => article.user_id === 56) ;
  })
  const hasMoreArticles = computed(() => {
    return currentPage.value < lastPage.value;
  })

  //actions
  const fetchArticles = async (page: number=1) => {
    const response = await ArticleApi.getArticles(page);

    if(page===1){
      articles.value = response.articles;
    }else {
=======
  const articles = ref<ArticleInterface[]>([]);
  const currArticle = ref<ArticleInterface | null>(null);
  const currentPage = ref<number>(1);
  const lastPage = ref<number>(1);
  const totalArticles = ref<number>(0);

  //getters
  const getAllArticles = computed(() => articles.value);
  const getFollowingArticles = computed(() => {
    return articles.value.filter((article) => article.user_id === 56);
  });
  const hasMoreArticles = computed(() => {
    return currentPage.value < lastPage.value;
  });

  //actions
  const fetchArticles = async (page: number = 1) => {
    const response = await ArticleApi.getArticles(page);

    if (page === 1) {
      articles.value = response.articles;
    } else {
>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106
      articles.value = [...articles.value, ...response.articles];
    }

    currentPage.value = response.current_page;
    lastPage.value = response.last_page;
    totalArticles.value = response.total;

    return response;
<<<<<<< HEAD
  }
=======
  };
>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106

  const fetchMoreArticles = async (page: number) => {
    const response = await ArticleApi.getArticles(page);

    articles.value = [...articles.value, ...response.articles];

    currentPage.value = response.current_page;
    lastPage.value = response.last_page;
    totalArticles.value = response.total;

    return response;
<<<<<<< HEAD
  }
=======
  };

  const fetchFollowingArticles = async (user_id: number, page: number = 1) => {
    const response = await ArticleApi.getFollowingArticles(user_id, page);

    if (page === 1) {
      articles.value = response.articles;
    } else {
      articles.value = [...articles.value, ...response.articles];
    }

    currentPage.value = response.current_page;
    lastPage.value = response.last_page;
    totalArticles.value = response.total;

    return response;
  };
  const fetchMoreFollowingArticles = async (user_id: number, page: number) => {
    const response = await ArticleApi.getFollowingArticles(user_id, page);

    articles.value = [...articles.value, ...response.articles];

    currentPage.value = response.current_page;
    lastPage.value = response.last_page;
    totalArticles.value = response.total;

    return response;
  };

  const fetchArticleById = async (id: number) => {
    const response = await ArticleApi.getArticleById(id);
    currArticle.value = response;
    return response;
  };

  const fetchTrendingArticles = async (page: number = 1) => {
    const response = await ArticleApi.getTrendingArticles(page);

    if (page === 1) {
      articles.value = response.articles;
    } else {
      articles.value = [...articles.value, ...response.articles];
    }

    currentPage.value = response.current_page;
    lastPage.value = response.last_page;
    totalArticles.value = response.total;

    return response;
  };
>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106

  const resetArticles = () => {
    articles.value = [];
    currentPage.value = 1;
    lastPage.value = 1;
    totalArticles.value = 0;
<<<<<<< HEAD
  }
=======
  };

  const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
    });
  };
>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106

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
    fetchMoreArticles,
    resetArticles,
<<<<<<< HEAD
  }

})
=======
    fetchFollowingArticles,
    fetchMoreFollowingArticles,
    fetchTrendingArticles,
    fetchArticleById,
    formatDate,
  };
});
>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106
