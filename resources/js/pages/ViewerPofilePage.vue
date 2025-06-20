<template>
  <Header />
  <div class="min-h-screen pt-4 bg-white text-white">
    <div class="grid md:grid-cols-3 bg-white text-black divide-x divide-gray-200 pt-16">
      <div class="md:col-span-2 p-6">
        <ProfileHeader />
        <TabSwitcher />
        <Home v-if="tabStore.activeTab === 'home'" />
        <About v-if="tabStore.activeTab === 'about'" />
      </div>
      <Sidebar1 />
    </div>
    <Footer />
  </div>
</template>

<script setup lang="ts">
  import { useTabStore } from '../stores/features/useTabStore'
  import ProfileHeader from '../../../resources/components/profileComponents/ProfileHeader.vue'
  import TabSwitcher from '../../../resources/components/profileComponents/TabSwitcher.vue'
  import Sidebar1 from '../../../resources/components/profileComponents/sidebar1.vue'
  import Home from '../pages/ViewerProfile/Home.vue'
  import About from '../pages/ViewerProfile/About.vue'
  import Footer from '../../../resources/components/landingPage_comp/Footer.vue'
  import Header from '../../../resources/components/landingPage_comp/Header.vue'

  const tabStore = useTabStore()
</script>
