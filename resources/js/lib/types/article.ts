export interface Article {
  article_id?: number;
  title: string;
  subtitle?: string;
  content: string;
  view_count?: number;
  image?: string;
  status: ArticleStatus;
}

export enum ArticleStatus {
  DRAFT = 'draft',
  PUBLISHED = 'published',
}
