import { defineStore } from 'pinia'

export const useFollowersStore = defineStore('followers', {
  state: () => ({
    followers: [
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
    followerCount: (state) => state.followers.length,
  },
})
