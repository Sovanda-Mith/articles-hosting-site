<template>
    <div class="min-h-screen bg-white text-white">
      <div class="grid md:grid-cols-3 bg-white text-black divide-x divide-gray-200">
        <div class="md:col-span-2 p-6">
          <ProfileHeader />
          <TabSwitcher />
          <Home v-if="tabStore.activeTab === 'home'" />
          <About v-if="tabStore.activeTab === 'about'" />
        </div>
        <Sidebar />
      </div>
    </div>
  </template>

  <script setup lang="ts">
  import { useTabStore } from '../useTabStore.ts';
  import ProfileHeader from '../../components/profileComponents/ProfileHeader.vue';
  import TabSwitcher from '../../components/profileComponents/TabSwitcher.vue';
  import Sidebar from '../../components/profileComponents/Sidebar.vue';
  import Home from '../pages/profile/Home.vue';
  import About from '../pages/profile/About.vue';

  const tabStore = useTabStore();
  </script>
