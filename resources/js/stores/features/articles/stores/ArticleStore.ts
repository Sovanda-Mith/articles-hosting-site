import { defineStore } from 'pinia';
import type ArticleInterface from '../types/ArticleInterface'
// import { ArticleStatus } from '../types/ArticleInterface'
import { computed, ref } from 'vue';
import { ArticleApi } from '../api/ArticleApi';

export const useArticleStore = defineStore('article', () => {
  //state
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
      articles.value = [...articles.value, ...response.articles];
    }

    currentPage.value = response.current_page;
    lastPage.value = response.last_page;
    totalArticles.value = response.total;

    return response;
  }

  const fetchMoreArticles = async (page: number) => {
    const response = await ArticleApi.getArticles(page);

    articles.value = [...articles.value, ...response.articles];

    currentPage.value = response.current_page;
    lastPage.value = response.last_page;
    totalArticles.value = response.total;

    return response;
  }

  const resetArticles = () => {
    articles.value = [];
    currentPage.value = 1;
    lastPage.value = 1;
    totalArticles.value = 0;
  }

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
  }

})
