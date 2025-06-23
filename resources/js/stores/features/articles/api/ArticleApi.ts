import type ArticleInterface from '../types/ArticleInterface';
import axios from 'axios';
// import { ArticleStatus } from '../types/ArticleInterface'

class ArticleApi {
  private static baseUrl = '/api/articles';

  // //only get first 10 articles
  // public static async getArticles(): Promise<ArticleInterface[]> {
  //   const response = await fetch(ArticleApi.baseUrl);
  //   const data = await response.json();
  //   return data;
  // }

  //get all articles
  public static async getArticles(
    page: number = 1,
    limit: number = 10
  ): Promise<{
    articles: ArticleInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    const response = await axios.get(`/api/foryou?page=${page}&limit=${limit}`,
      {
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      }
    );
    const mappedArticles = response.data.data.map((article: any) => ({
      ...article,
      id: article.article_id 
    }));
    return {
      articles: mappedArticles,
      current_page: response.data.meta.current_page,
      last_page: response.data.meta.last_page,
      total: response.data.meta.total,
    };
  }

  public static async getFollowingArticles(
    user_id: number,
    page: number = 1,
    limit: number = 10
  ): Promise<{
    articles: ArticleInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    const response = await axios.get(
      `${ArticleApi.baseUrl}/following/${user_id}?page=${page}&limit=${limit}`,
      {
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      }
    );
    return {
      articles: response.data.data,
      current_page: response.data.meta.current_page,
      last_page: response.data.meta.last_page,
      total: response.data.meta.total,
    };
  }

  public static async getArticleById(
    id: number
  ): Promise<ArticleInterface> {
    const response = await axios.get(`${ArticleApi.baseUrl}/${id}`);
    return response.data;
  }

  public static async getArticleByUserId(
    userId: number,
    page: number = 1,
    limit: number = 10
  ): Promise<{
    articles: ArticleInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    const response = await axios.get(`${ArticleApi.baseUrl}/user/${userId}?page=${page}&limit=${limit}`);
    return {
      articles: response.data.data,
      current_page: response.data.meta.current_page,
      last_page: response.data.meta.last_page,
      total: response.data.meta.total,
    };
  }

  public static async getTrendingArticles(
    page: number = 1,
    limit: number = 10
  ): Promise<{
    articles: ArticleInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    const response = await axios.get(`${ArticleApi.baseUrl}/trending?page=${page}&limit=${limit}`);
    return {
      articles: response.data.data,
      current_page: response.data.meta.current_page,
      last_page: response.data.meta.last_page,
      total: response.data.meta.total,
    };
  }

  // public static async searchArticles(
  //   query: string,
  //   page: number = 1,
  //   limit: number = 10,
  // ): Promise<{
  //   articles: ArticleInterface[];
  //   current_page: number;
  //   last_page: number;
  //   total: number;
  // }> {
  //   const response = await axios.get(`/articles/search`, {
  //     params: {
  //         q: query,
  //         page,
  //         limit
  //     },
  //     headers: {
  //         'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
  //     }
  //   });

  //   console.log('API Response Structure:', response.data);
  //     return {
  //         articles: response.data.data || response.data.articles,
  //         current_page: response.data.meta.current_page,
  //         last_page: response.data.meta.last_page,
  //         total: response.data.meta.total
  //     };
  // }
  public static async searchArticles(
    query: string,
    page: number = 1,
    limit: number = 10,
  ): Promise<{
    articles: ArticleInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    try {
      const response = await axios.get(`/api/articles/search`, {
      // // const response = await axios.get(`${ArticleApi.baseUrl}/search`, {  
      params: {
          q: query,
          page,
          limit
        },
        headers: {
          'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
        }
      });

      // console.log('Full API Response:', {
      //   status: response.status,
      //   data: response.data,
      //   headers: response.headers
      // });

      return {
        articles: response.data.data,
        current_page: response.data.meta.current_page,
        last_page: response.data.meta.last_page,
        total: response.data.meta.total
      };
    } catch (error) {
      console.error('Search API Error:', error);
      return {
        articles: [],
        current_page: page,
        last_page: 1,
        total: 0
      };
    }
  }
}

export { ArticleApi };
