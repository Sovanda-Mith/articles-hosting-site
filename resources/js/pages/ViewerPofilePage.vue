<template>
  <div class="min-h-screen bg-white text-white">
    <div class="grid md:grid-cols-3 bg-white text-black divide-x divide-gray-200">
      <div class="md:col-span-2 p-6">
        <div class="pb-4">
          <ProfileHeader />
        </div>
        <TabSwitcher />
        <Home v-if="tabStore.activeTab === 'home'" />
        <About v-if="tabStore.activeTab === 'about'" />
      </div>
      <sidebar1 />
    </div>
    <Footer />
  </div>
</template>

<script setup lang="ts">
  import { useTabStore } from '../stores/features/useTabStore.ts';
  import ProfileHeader from '../../../resources/components/profileComponents/ProfileHeader.vue';
  import TabSwitcher from '../../../resources/components/profileComponents/TabSwitcher.vue';
  import sidebar1 from '../../../resources/components/profileComponents/sidebar1.vue';
  import Home from '../pages/ViewerProfile/Home.vue';
  import About from '../pages/ViewerProfile/About.vue';
  import Footer from '../../../resources/components/landingPage_comp/Footer.vue';

  const tabStore = useTabStore();
</script>
