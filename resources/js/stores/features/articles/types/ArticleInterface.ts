export default interface ArticleInterface {
  id: number;
  title: string;
  subtitle?: string;
  content: string;
  user_id: number;
  view_count: number;
  status: ArticleStatus;
  image?: string;
  likes_count?: number;
  comments_count?: number;
  created_at: string;
  updated_at: string;
}

export enum ArticleStatus {
  DRAFT = 'draft',
  PUBLISHED = 'published',
}
