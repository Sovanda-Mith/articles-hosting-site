<template>
    <div class="flex flex-col relative h-[500px]">
        <!-- Vertical line (static background) -->
        <div
            class="absolute right-[-75px] top-0 h-full w-[2px] bg-gray-200"
        ></div>

        <!-- Active indicator (dynamic) -->
        <div
            class="absolute right-[-75px] w-[2px] bg-black transition-all duration-300"
            :style="{
                top: `${activeIndex * 72}px`,
                height: '50px',
            }"
        ></div>

        <!-- Categories -->
        <RouterLink
            v-for="(category, index) in categories"
            :to="`/settings/${category.id}`"
            :key="category.id"
            class="h-[50px] flex items-center pl-4 cursor-pointer mb-[22px] last:mb-0"
            :class="{
                'font-semibold text-black': activeIndex === index,
                'text-gray-500': activeIndex !== index,
            }"
            @click="activeIndex = index"
        >
            {{ category.name }}
        </RouterLink>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

const categories = [
    { id: "account", name: "Account" },
    { id: "notifications", name: "Notifications" },
    { id: "security", name: "Security and Privacy" },
];

const activeIndex = ref(0);
</script>
