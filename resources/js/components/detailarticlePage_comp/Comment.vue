<script setup lang="ts">
  defineProps({
    id: String,
    user_id: String,
    name: String,
    avatar: String,
    content: String,
    timeAgo: String,
    likesCount: {
      type: Number,
      default: 0,
    },
    commentsCount: {
      type: Number,
      default: 0,
    },
  });
</script>

<template>
  <div class="border-b border-t-2 border-gray-100 w-full py-5 px-5">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-3">
        <img :src="avatar" alt="" class="w-[60px] h-[60px] rounded-full" />
        <div class="flex flex-col">
          <span>{{ name }}</span>
          <span>{{ timeAgo }}</span>
        </div>
      </div>
      <i class="pi pi-ellipsis-h" style="font-size: 25px"></i>
    </div>
    <div class="py-5">
      <span>{{ content }}</span>
    </div>
    <div class="flex items-center gap-10 pl-5">
      <div class="flex items-center gap-2">
        <i class="pi pi-heart" style="font-size: 20px"></i>
        <span>{{ likesCount }}</span>
      </div>
      <div class="flex items-center gap-2">
        <i class="pi pi-comment" style="font-size: 20px"></i>
        <span>{{ commentsCount }}</span>
      </div>
      <span class="underline hover:cursor-pointer hover:text-[#212121]">Reply</span>
    </div>
  </div>
</template>
