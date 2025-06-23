<template>
  <Header />
  <div class="min-h-screen pt-4 bg-white text-white">
    <div class="grid md:grid-cols-3 bg-white text-black divide-x divide-gray-200 pt-16">
      <div class="md:col-span-2 p-6">
        <ProfileHeader viewType="viewer" :name="currentUser.name" />
        <TabSwitcher />
        <Home v-if="tabStore.activeTab === 'home'" />
        <About :aboutMe="currentUser.bio" :email="currentUser.email" v-if="tabStore.activeTab === 'about'" />
      </div>
      <Sidebar1 :user="currentUser" />
    </div>
  </div>
</template>

<script setup lang="ts">
  import { useTabStore } from '../stores/features/useTabStore'
  import ProfileHeader from '../../../resources/components/profileComponents/ProfileHeader.vue'
  import TabSwitcher from '../../../resources/components/profileComponents/TabSwitcher.vue'
  import Sidebar1 from '../../../resources/components/profileComponents/sidebar1.vue'
  import Home from '../pages/ViewerProfile/Home.vue'
  import About from '../pages/ViewerProfile/About.vue'
  import Header from '../../../resources/components/landingPage_comp/Header.vue'
  import axios from 'axios'
  import { useRoute } from 'vue-router'
  import { ref, computed } from 'vue'
  import { onMounted } from 'vue'

  const tabStore = useTabStore()

  const route = useRoute()
  const userData = ref(null)

  // Computed property to get the current user data
  const currentUser = computed(() => {
    return userData.value || user
  })

  const user = {
    id: 0,
    name: 'Not Found 404',
    username: 'Not Found 404',
    bio: 'No bio available.',
    followers_count: 0,
    following_count: 0,
    avatar: 'https://example.com/avatar.jpg',
    gender: 'female',
    role: 'viewer',
    email: 'jane.doe@example.com',
    link: 'https://example.com/janedoe',
  }

  // Fetch user data from the API
  async function fetchUserData(userId: string) {
    try {
      const response = await axios.get(`/api/users/${userId}`)
      const apiUser = response.data.data

      // Transform API response to match User interface
      return {
        id: apiUser.id,
        email: apiUser.email,
        name: apiUser.name,
        username: apiUser.username,
        bio: apiUser.bio,
        avatar: apiUser.avatar,
        gender: apiUser.gender,
        role: apiUser.role,
        // followers_count: apiUser.followers_count,
        // following_count: apiUser.following_count,
        link: undefined
      }
    } catch (error) {
      console.error('Error fetching user data:', error)
      return null
    }
  }


  onMounted(async () => {
    const userId = route.params.userid || route.query.userId
    if (userId) {
      const data = await fetchUserData(String(userId))
      if (data) {
        userData.value = data
      }
    }
    console.log('User ID from route:', userId)
    console.log('User data:', userData.value)
  })

</script>
