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
    const response = await axios.get(`${ArticleApi.baseUrl}?page=${page}&limit=${limit}`);
    return {
      articles: response.data.data,
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
}

export { ArticleApi };
