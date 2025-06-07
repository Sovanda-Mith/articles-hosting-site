import type ArticleInterface from '../types/ArticleInterface'
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
  public static async getArticles(page: number =1, limit: number = 10): Promise<{
    articles: ArticleInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    const response = await fetch(`${ArticleApi.baseUrl}?page=${page}&limit=${limit}`);
    const data = await response.json();
    return {
      articles: data.data,
      current_page: data.meta.current_page,
      last_page: data.meta.last_page,
      total: data.meta.total,
    };
  }


  // public static async getFollowingArticles(user_id: number): Promise<ArticleInterface[]> {
  //   const response = await fetch(`${ArticleApi.baseUrl}/following/${user_id}`);
  //   const data = await response.json();
  //   return data;
  // }

  public static async getFollowingArticles(user_id:number, page: number =1, limit: number = 10): Promise<{
    articles: ArticleInterface[];
    current_page: number;
    last_page: number;
    total: number;
  }> {
    const response = await fetch(`${ArticleApi.baseUrl}/following/${user_id}?page=${page}&limit=${limit}`,{
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
      },
      method: 'GET',
    });
    const data = await response.json();
    return {
      articles: data.data,
      current_page: data.meta.current_page,
      last_page: data.meta.last_page,
      total: data.meta.total,
    };
  }

}
// export const articleApi = new ArticleApi();
// export default articleApi;
export { ArticleApi };
