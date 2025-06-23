import ArticleInterface from '../../features/articles/types/ArticleInterface'

export interface CardItem extends Omit<ArticleInterface, 'content' | 'created_at' | 'likes_count' | 'comments_count'> {
  description: string // replaces content
  date: string // replaces created_at
  likes: number // replaces likes_count
  comments: number // replaces comments_count
}
