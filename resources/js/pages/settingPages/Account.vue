<template>
    <div class="flex flex-col ml-[100px] flex-1 space-y-[10px] w-full">
        <div class="flex justify-between h-[50px] items-center">
            <p class="font-medium">Email Address</p>
            <p class="text-gray-500 cursor-pointer">{{ email }}</p>
        </div>
        <div class="flex justify-between h-[50px] items-center">
            <div class="flex flex-col">
                <p class="font-medium">Profile Information</p>
                <p class="text-gray-500 text-sm">
                    Edit your photo, name, short bio, etc.
                </p>
            </div>
            <div class="flex gap-[20px] items-center cursor-pointer">
                <p class="text-gray-500">{{ name }}</p>
                <img
                    src="@/assets/settingsPage_img/placeholderPf.png"
                    alt="Profile"
                    title="Profile"
                    class="w-[35px] h-[35px]"
                />
            </div>
        </div>
        <!-- Horizontal line (static background) -->
        <div class="h-[2px] bg-gray-100 w-3/4 flex self-center my-[30px]"></div>

        <div class="flex flex-col">
            <p class="font-medium h-[50px] cursor-pointer flex items-center">
                Muted Writers
            </p>
            <p class="font-medium h-[50px] cursor-pointer flex items-center">
                Blocked Users
            </p>
        </div>

        <!-- Horizontal line (static background) -->
        <div class="h-[2px] bg-gray-100 w-3/4 flex self-center my-[30px]"></div>

        <div class="flex flex-col cursor-pointer">
            <p class="text-[#ff0000]">Delete account</p>
            <p class="text-gray-500 text-sm">
                Permanently delete your account and all of your artcles
            </p>
        </div>
    </div>
</template>
<script setup lang="ts">
import { ref } from "vue";

const name = ref<string>("John Doe");
const email = ref<string>("john.die@gmail.com");
</script>
