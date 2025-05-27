<template>
    <div class="flex flex-row h-lvh">
        <div class="w-1/6 bg-gray-800 h-full">
            <Menu></Menu>
        </div>
        <div class="w-5/6 flex flex-col h-full justify-start">
            <div class="h-16 border-b-1 w-full">
                <Header></Header>
            </div>
            <div class="p-5 bg-blue-50 h-full">
                <router-view />
            </div>
            
        </div>
    </div>
</template>
<script setup lang="ts">
import Header from './Header/Header.vue'; 
import Menu from './Menu/Menu.vue'; 


</script>