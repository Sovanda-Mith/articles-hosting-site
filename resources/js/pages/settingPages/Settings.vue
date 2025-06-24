<template>
  <div>
    <Header />
    <div class="flex pt-[100px] flex-col px-[50px] space-y-[80px]">
      <h3>Settings</h3>
      <div class="flex">
        <SideBar />
        <RouterView />
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
  import Header from '../../../components/landingPage_comp/Header.vue';
  import SideBar from '@/components/settingPage_comp/SideBar.vue';
</script>
