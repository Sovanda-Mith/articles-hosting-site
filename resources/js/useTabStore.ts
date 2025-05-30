import { defineStore } from 'pinia';

export const useTabStore = defineStore('tab', {
  state: () => ({
    activeTab: 'home',
  }),
  actions: {
    setTab(tab: string) {
      this.activeTab = tab;
    },
  },
});
