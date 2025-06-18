import { defineStore } from 'pinia'

interface Following {
  id: number
  name: string
}

export const useFollowingStore = defineStore('following', {
  state: () => ({
    following: [
      { id: 1, name: 'George Weeks' },
      { id: 2, name: 'Dr Cl Yatawara' },
      { id: 3, name: 'Emerencio Nvopa' },
      { id: 4, name: 'Rachael Braithwaite' },
      { id: 5, name: 'Cherie Gilmour' },
      { id: 6, name: 'John Doe' },
      { id: 7, name: 'Jane Smith' },
      { id: 8, name: 'Alice Johnson' },
      { id: 9, name: 'Bob Brown' },
      { id: 10, name: 'Charlie Davis' },
      { id: 11, name: 'Diana Prince' },
      { id: 12, name: 'Ethan Hunt' },
      { id: 13, name: 'Fiona Gallagher' },
      { id: 14, name: 'George Costanza' },
      { id: 15, name: 'Hannah Montana' },
      { id: 16, name: 'Ian Malcolm' },
      { id: 17, name: 'Jack Sparrow' },
      { id: 18, name: 'Katherine Pierce' },
      { id: 19, name: 'Liam Neeson' },
      { id: 20, name: 'Mia Wallace' },
      // ... add more if needed
    ] as Following[],
  }),
  getters: {
    followingCount: (state) => state.following.length,
    followingNames: (state) => state.following.map(f => f.name),
  },
  actions: {
    addFollowing(name: string) {
      const newId = this.following.length
        ? Math.max(...this.following.map(f => f.id)) + 1
        : 1
      this.following.push({ id: newId, name })
    },
    removeFollowing(id: number) {
      this.following = this.following.filter(f => f.id !== id)
    },
    clearFollowing() {
      this.following = []
    },
  },
})
