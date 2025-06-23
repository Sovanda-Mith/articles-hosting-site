import { defineStore } from 'pinia'
import type { Bookmark } from '../types/bookmark' // Adjust the import path as necessary
import axios from 'axios'

export const useBookmarkStore = defineStore('bookmarkStore', {
  state: () => ({
    bookmarks: [] as Bookmark[],
  }),

  actions: {
    async loadBookmarks() {
      try {
        const response = await axios.get('/api/bookmarks') // This will hit PHP backend
        this.bookmarks = response.data
      } catch (error) {
        console.error('Failed to load bookmarks:', error)
      }
    },
  },
})
