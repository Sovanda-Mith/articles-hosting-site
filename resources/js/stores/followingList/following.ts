import { defineStore } from 'pinia'

export const useFollowingStore = defineStore('following', {
  state: () => ({
    following: [
      'George Weeks',
      'Dr Cl Yatawara',
      'Emerencio Nvopa',
      'Rachael Braithwaite',
      'Cherie Gilmour',
      'George Weeks',
      'Dr Cl Yatawara',
      'Emerencio Nvopa',
      'Rachael Braithwaite',
      'Cherie Gilmour',
      'George Weeks',
      'Dr Cl Yatawara',
      'Emerencio Nvopa',
      'Rachael Braithwaite',
      'Cherie Gilmour',
      'George Weeks',
      'Dr Cl Yatawara',
      'Emerencio Nvopa',
      'Rachael Braithwaite',
      'Cherie Gilmour',
      'George Weeks',
      'Dr Cl Yatawara',
      'Emerencio Nvopa',
      'Rachael Braithwaite',
      'Cherie Gilmour',
    ] as string[],
  }),
  getters: {
    followingCount: (state) => state.following.length,
  },
})
