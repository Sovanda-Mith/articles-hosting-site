<template>
  <Header />
  <div class="min-h-screen pt-4 bg-white text-white">
    <!-- Grid Layout with Sidebar on Right -->
    <div class="grid md:grid-cols-3 bg-white text-black divide-x divide-gray-200 pt-15">
      <!-- Left: Main Profile Section -->
      <div class="md:col-span-2 p-6">
        <ProfileHeader />
        <TabSwitcher />
        <!-- Mobile Sidebar Open Button -->
        <div class="md:hidden flex justify-end mb-4">
          <button
            v-if="!sidebarOpen"
            @click="sidebarOpen = true"
            class="p-3 rounded-full bg-white text-black shadow-lg hover:bg-gray-100 transition-all duration-300 ease-out focus:outline-none focus:ring-2 focus:ring-gray-300"
            aria-label="Open sidebar"
          >
            <!-- Hamburger Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
        <Home v-if="tabStore.activeTab === 'home'" />
        <About v-if="tabStore.activeTab === 'about'" />
      </div>

      <!-- Desktop Sidebar -->
      <div class="hidden md:block p-4">
        <Sidebar />
      </div>
    </div>

    <!-- Mobile Sidebar Slide-in -->
    <transition name="sidebar-slide">
      <div
        v-if="sidebarOpen"
        class="fixed inset-0 z-50 flex md:hidden justify-end"
        style="background: rgba(0,0,0,0.4);"
        @click.self="sidebarOpen = false"
      >
        <aside
          class="bg-white w-80 max-w-full h-full shadow-lg p-0 text-black relative animate-slide-in overflow-y-auto"
          style="max-height: 100vh;"
        >
          <!-- Close Button -->
          <button
            @click="sidebarOpen = false"
            class="absolute top-4 left-4 z-10 p-2 rounded-full bg-gray-200 text-black"
            aria-label="Close sidebar"
          >
            ✕
          </button>
          <Sidebar />
        </aside>
      </div>
    </transition>

    <Footer />
  </div>
</template>

<script setup lang="ts">
import { ref, watch, onUnmounted } from 'vue'
import { useTabStore } from '../stores/features/useTabStore'

import ProfileHeader from '../../components/profileComponents/ProfileHeader.vue'
import TabSwitcher from '../../components/profileComponents/TabSwitcher.vue'
import Sidebar from '../../components/profileComponents/Sidebar.vue'
import Home from './profile/Home.vue'
import About from './profile/About.vue'
import Footer from '../../components/landingPage_comp/Footer.vue'
import Header from '../../components/landingPage_comp/Header.vue'

const tabStore = useTabStore()
const sidebarOpen = ref(false)

watch(sidebarOpen, (open) => {
  if (open) {
    document.body.classList.add('overflow-hidden')
  } else {
    document.body.classList.remove('overflow-hidden')
  }
})

onUnmounted(() => {
  document.body.classList.remove('overflow-hidden')
})
</script>

<style scoped>
/* Sidebar Slide Animation */
.sidebar-slide-enter-active,
.sidebar-slide-leave-active {
  transition: transform 0.45s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.3s;
}
.sidebar-slide-enter-from {
  transform: translateX(100%);
  opacity: 0;
}
.sidebar-slide-enter-to {
  transform: translateX(0);
  opacity: 1;
}
.sidebar-slide-leave-from {
  transform: translateX(0);
  opacity: 1;
}
.sidebar-slide-leave-to {
  transform: translateX(100%);
  opacity: 0;
}
</style>
