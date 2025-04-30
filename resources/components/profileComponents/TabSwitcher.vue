<template>
    <div class="flex space-x-6 border-b mb-4">
      <button @click="tabStore.setTab('home')" :class="tabClass('home')">HOME</button>
      <button @click="tabStore.setTab('about')" :class="tabClass('about')">ABOUT</button>
    </div>
  </template>

  <script setup lang="ts">
  import { useTabStore } from '@/js/useTabStore';

  const tabStore = useTabStore();

  const tabClass = (tab: string) => [
    'pb-2 font-semibold',
    tabStore.activeTab === tab ? 'border-b-2 border-black' : 'text-gray-400'
  ];
  </script>
