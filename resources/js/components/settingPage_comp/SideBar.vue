<template>
  <div class="flex flex-col relative h-[500px]">
    <!-- Vertical line (static background) -->
    <div class="absolute right-[-75px] top-0 h-full w-[2px] bg-gray-200"></div>

    <!-- Active indicator (dynamic) -->
    <div
      class="absolute right-[-75px] w-[2px] bg-black transition-all duration-300"
      :style="{
        top: `${activeIndicatorPosition}px`,
        height: '50px',
      }"
    ></div>

    <!-- Categories -->
    <RouterLink
      v-for="(category, index) in categories"
      :key="category.id"
      :to="`/settings/${category.id}`"
      class="h-[50px] flex items-center pl-4 cursor-pointer mb-[22px] last:mb-0"
      :class="{
        'font-semibold text-black': $route.path === `/settings/${category.id}`,
        'text-gray-500': $route.path !== `/settings/${category.id}`,
      }"
      @click="activeIndex = index"
    >
      {{ category.name }}
    </RouterLink>
  </div>
</template>

<script setup lang="ts">
  import { ref, computed, watch } from 'vue';
  import { useRoute } from 'vue-router';

  const route = useRoute();

  const categories = [
    { id: '', name: 'Account' },
    { id: 'notifications', name: 'Notifications' },
    { id: 'security', name: 'Security and Privacy' },
  ];

  const activeIndex = ref(0);

  const updateActiveIndex = () => {
    const index = categories.findIndex((category) => `/settings/${category.id}` === route.path);
    if (index !== -1) activeIndex.value = index;
  };

  // Call once on load
  updateActiveIndex();

  // Watch for route changes
  watch(
    () => route.path,
    () => {
      updateActiveIndex();
    }
  );

  const activeIndicatorPosition = computed(() => activeIndex.value * 72);
</script>
