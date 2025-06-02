<template>
    <div class="w-full h-full flex flex-col items-center">
        <div class=" h-16 flex justify-center items-center">
            <div class="text-2xl font-medium text-white">Admin</div>
        </div>
        <div class="flex flex-col w-full items-center">
            <router-link to="/admin" class="w-full">
                <div class="w-full h-12 flex justify-center items-center text-gray-300 hover:bg-gray-500 hover:text-white cursor-pointer">
                    <div>Dashboard</div>
                </div>
            </router-link>
            <router-link to="/admin/user" class="w-full">
                <div class="w-full h-12 flex justify-center items-center text-gray-300 hover:bg-gray-500 hover:text-white cursor-pointer">
                    <div>User</div>
                </div>
            </router-link>
            <router-link to="/admin/article" class="w-full">
                <div class="w-full h-12 flex justify-center items-center text-gray-300 hover:bg-gray-500 hover:text-white cursor-pointer">
                    <div>Article</div>
                </div>
            </router-link>
            <router-link to="/admin/report" class="w-full">
                <div class="w-full h-12 flex justify-center items-center text-gray-300 hover:bg-gray-500 hover:text-white cursor-pointer">
                    <div>Report</div>
                </div>
            </router-link>
            <router-link to="/admin/account" class="w-full">
                <div class="w-full h-12 flex justify-center items-center text-gray-300 hover:bg-gray-500 hover:text-white cursor-pointer">
                    <div>Account</div>
                </div>
            </router-link>
        </div>

    </div>
</template>
<script setup lang="ts"></script>