<template>
  <div class="flex flex-col ml-[100px] flex-1 space-y-[10px] w-full">
    <div class="flex justify-between h-[50px] items-center">
      <div class="flex flex-col">
        <p class="font-medium">Notifications on your articles</p>
        <p class="text-gray-500 text-sm">Get notifications for comments, save, etc.</p>
      </div>
      <Checkbox />
    </div>
    <div class="flex justify-between h-[50px] items-center">
      <p class="font-medium">When someone follows you</p>
      <Checkbox />
    </div>
    <div class="flex justify-between h-[50px] items-center">
      <p class="font-medium">New product features from Bloggist</p>
      <Checkbox />
    </div>
  </div>
</template>
<script setup lang="ts">
  import Checkbox from '@/components/ui/checkbox/Checkbox.vue';
</script>
