<<<<<<< HEAD
import type ArticleInterface from '../types/ArticleInterface'
=======
import type ArticleInterface from '../types/ArticleInterface';
import axios from 'axios';
>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106
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
<<<<<<< HEAD
  public static async getArticles(page: number =1, limit: number = 10): Promise<{
=======
  public static async getArticles(
    page: number = 1,
    limit: number = 10
  ): Promise<{
>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106
    articles: ArticleInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
<<<<<<< HEAD
    const response = await fetch(`${ArticleApi.baseUrl}?page=${page}&limit=${limit}`);
    const data = await response.json();
    return {
      articles: data.data,
      current_page: data.meta.current_page,
      last_page: data.meta.last_page,
      total: data.meta.total,
    };
  }


  public static async getFollowingArticles(user_id: number): Promise<ArticleInterface[]> {
    const response = await fetch(`${ArticleApi.baseUrl}/following/${user_id}`);
    const data = await response.json();
    return data;
  }

}
// export const articleApi = new ArticleApi();
// export default articleApi;
=======
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

  public static async getArticleById(
    id: number
  ): Promise<ArticleInterface> {
    const response = await axios.get(`${ArticleApi.baseUrl}/${id}`);
    return response.data;
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
}

>>>>>>> 21616bc23d16258ea22b7eed7c4f2149bc5d7106
export { ArticleApi };
