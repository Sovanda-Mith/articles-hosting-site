<template>
  <div class="min-h-screen bg-white text-white">
    <Header />
    <div class="grid md:grid-cols-3 bg-white text-black divide-x divide-gray-200 pt-15">
      <div class="md:col-span-2 p-6">
        <ProfileHeader />
        <TabSwitcher />
        <Home v-if="tabStore.activeTab === 'home'" />
        <About v-if="tabStore.activeTab === 'about'" />
      </div>
      <Sidebar
        name="John Doe"
        avatarUrl=""
        :following="100"
        bio="Web developer and tech enthusiast"
        link="https://example.com"
        linkText="My Website"
      />
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
  import Header from '../../components/landingPage_comp/Header.vue';

  const tabStore = useTabStore();
</script>
