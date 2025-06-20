import { defineStore } from 'pinia';
import type { User } from '@/lib/types';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: {
      id: null,
      email: '',
      name: '',
      username: '',
      bio: '',
      avatar: '',
      gender: '',
      role: '',
      token: '',
    } as User,
  }),

  actions: {
    setUserData(user: User) {
      this.user = { ...user };
    },

    clearUserData() {
      this.user = {
        id: null,
        email: '',
        name: '',
        username: '',
        bio: '',
        avatar: '',
        gender: '',
        role: '',
        token: '',
      };
    },

    loadFromLocalStorage() {
      const data = localStorage.getItem('userStore');
      if (data) {
        this.user = JSON.parse(data);
      }
    },

    subscribeToStorage() {
      this.$subscribe((_mutation, state) => {
        localStorage.setItem('userStore', JSON.stringify(state.user));
      });
    },
  },
});
