<template>
  <div class="flex space-x-8 border-b border-gray-200 mb-6 pl-8">
    <button
      @click="tabStore.setTab('home')"
      :class="tabClass('home')"
      class="text-h6 transition-colors duration-200 px-4 py-2 focus:outline-none"
    >
      HOME
    </button>
    <button
      @click="tabStore.setTab('about')"
      :class="tabClass('about')"
      class="text-h6 transition-colors duration-200 px-4 py-2 focus:outline-none"
    >
      ABOUT
    </button>
  </div>
</template>

<script setup lang="ts">
  import { useTabStore } from '@/stores/features/useTabStore';

  const tabStore = useTabStore();

  const tabClass = (tab: string) => [
    'pb-2 font-semibold',
    tabStore.activeTab === tab ? 'border-b-2 border-black' : 'text-gray-400',
  ];
</script>
