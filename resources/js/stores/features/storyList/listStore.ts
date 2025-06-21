import { defineStore } from 'pinia'

export const useListStore = defineStore('listStore', {
  state: () => ({
    lists: [
      {
        title: 'Philosophy',
        stories: 17,
        saves: 1,
        image: '/images/list1.jpg',
      },
      {
        title: 'Philosophy',
        stories: 17,
        saves: 1,
        image: '/images/list2.jpg',
      },
      {
        title: 'Philosophy',
        stories: 17,
        saves: 1,
        image: '/images/list3.jpg',
      },
    ],
  }),
})
