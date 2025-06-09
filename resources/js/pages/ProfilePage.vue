<template>
  <div class="min-h-screen bg-white text-white">
    <div class="grid md:grid-cols-3 bg-white text-black divide-x divide-gray-200">
      <div class="md:col-span-2 p-6">
        <header />
        <ProfileHeader />
        <TabSwitcher />
        <Home v-if="tabStore.activeTab === 'home'" />
        <About v-if="tabStore.activeTab === 'about'" />
      </div>
      <Sidebar />
    </div>
    <Footer />
  </div>
</template>

<script setup lang="ts">
  import { useTabStore } from '../stores/features/useTabStore.ts';
  import ProfileHeader from '../../components/profileComponents/ProfileHeader.vue';
  import TabSwitcher from '../../components/profileComponents/TabSwitcher.vue';
  import Sidebar from '../../components/profileComponents/Sidebar.vue';
  import Home from '../pages/profile/Home.vue';
  import About from '../pages/profile/About.vue';
  import Footer from '../../components/landingPage_comp/Footer.vue';

  const tabStore = useTabStore();
</script>
