import { defineStore } from 'pinia'
import type { CardItem } from '@/stores/card/types/card'

export const useCardStore = defineStore('cardStore', {
  state: () => ({
    cards: [] as CardItem[]
  }),
  actions: {
    loadCards() {
      this.cards = [
        {
          id: 1,
          title: 'My Top Story',
          description: 'The best of my stories, according to me.',
          date: 'Mar 12',
          likes: 234,
          comments: 43,
          image: '/feedpage_img/img1.jpg',
        },
        {
          id: 2,
          title: 'Start Here',
          description: 'An index of my Medium Articles',
          date: 'Jan 12',
          likes: 628,
          comments: 280,
          image: '/feedpage_img/img1.jpg',
        },
        {
          id: 3,
          title: 'Sign up for ideas to live by',
          description: 'Get the lessons of history and philosophy for your life and work.',
          date: '',
          likes: 0,
          comments: 0,
          image: '/feedpage_img/img1.jpg',
        },
        {
          id: 4,
          title: 'It happened on Medium: September 2024 roundup',
          description: 'Discussion-sparking subject lines and new publications to follow.',
          date: 'Jan 12',
          likes: 428,
          comments: 280,
          image: '/feedpage_img/img1.jpg',
        },
        {
          id: 5,
          title: 'Fine Art Photography',
          description: 'From Letters to Beer Signs',
          date: 'Jan 12',
          likes: 628,
          comments: 280,
          image: '/feedpage_img/img1.jpg',
        },
        {
          id: 6,
          title: 'The Art of Photography',
          description: 'A collection of fine art photography.',
          date: 'Jan 12',
          likes: 628,
          comments: 280,
          image: '/feedpage_img/img1.jpg',
        },
        {
          id: 7,
          title: 'The Art of Photography',
          description: 'A collection of fine art photography.',
          date: 'Jan 12',
          likes: 628,
          comments: 280,
          image: '/feedpage_img/img1.jpg',
        },

      ]
    }
  }
})
