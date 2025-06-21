// types/bookmark.ts
export interface Bookmark {
  id: number
  title: string
  description?: string
  username: string
  avatar?: string
  image?: string
  date: string
  likes?: number
  comments?: number
}
