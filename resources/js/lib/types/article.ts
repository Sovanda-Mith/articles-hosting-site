export interface Article {
  article_id?: number;
  user_id?: number;
  title: string;
  subtitle?: string;
  content: string;
  view_count?: number;
  likes_count?: number;
  comments_count?: number;
  image?: string;
  status: ArticleStatus;
  created_at?: string;
  updated_at?: string;
}

export enum ArticleStatus {
  DRAFT = 'draft',
  PUBLISHED = 'published',
}
