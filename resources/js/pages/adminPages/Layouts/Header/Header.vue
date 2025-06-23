<template>
    <div class="w-full h-16 pr-5 pl-5 flex justify-between items-center">
        <div class="flex justify-center items-center">
            <img src="../../../../assets/settingsPage_img/logo.webp" alt="" class="w-8 h-8 rounded-lg object-cover border-[1.5px] border-yellow-600">
            <span class="text-lg font-medium ml-2">Bloggist</span>
        </div>
        <div class="flex justify-center items-center">
            <div class="text-lg font-medium mr-2">Hello, {{ name }}</div>
            <router-link to="/admin/account" >
                <img :src="avatar" alt="" class="w-8 h-8 rounded-full object-cover border-[1.5px] border-sky-600" >
            </router-link>
            
        </div>
    </div>
</template>
<script setup lang="ts">
    // const BaseURL = 'http://localhost:3000/'

    import { useUserStore } from '@/stores/features/custom-persistedstate';
    const userStore = useUserStore();

    // Access user data
    console.log("stored user: ", userStore.user);
    const name = userStore.user.name;
    const avatar = userStore.user.avatar;
</script>