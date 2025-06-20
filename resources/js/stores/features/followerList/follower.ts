import { defineStore } from 'pinia'

interface Follower {
  id: number
  name: string
}

export const useFollowersStore = defineStore('followers', {
  state: () => ({
    followers: [
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
      { id: 12, name: 'Bruce Wayne' },
      { id: 13, name: 'Clark Kent' },
      { id: 14, name: 'Peter Parker' },
      { id: 15, name: 'Tony Stark' },
      // ... add more if needed
    ] as Follower[],
  }),
  getters: {
    followerCount: (state) => state.followers.length,
    followerNames: (state) => state.followers.map(f => f.name),
  },
  actions: {
    addFollower(name: string) {
      const newId = this.followers.length
        ? Math.max(...this.followers.map(f => f.id)) + 1
        : 1
      this.followers.push({ id: newId, name })
    },
    removeFollower(id: number) {
      this.followers = this.followers.filter(f => f.id !== id)
    },
    clearFollowers() {
      this.followers = []
    },
  },
})
