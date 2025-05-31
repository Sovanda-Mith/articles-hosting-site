<template>
  <div class="bg-white shadow rounded-lg overflow-hidden">
    <img :src="post.image" class="w-full max-h-48 object-cover" />
    <div class="p-4">
      <h3 class="font-bold text-lg mb-2">{{ post.title }}</h3>
      <p class="text-gray-600 mb-2">{{ post.description }}</p>
      <div class="flex items-center text-sm text-gray-500 gap-4 mb-3">
        <div class="flex justify-center items-center">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </span> 
            {{ post.views }}</div>
        <div class="flex justify-center items-center">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 0 1 1.037-.443 48.282 48.282 0 0 0 5.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>
            </span>
            {{ post.comments }}</div>
        <div class="flex justify-center items-center">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </span> 
            {{ post.timestamp }}</div>
      </div>
      <div class="flex items-center gap-2">
        <img :src="post.author.avatar" class="w-10 h-10 rounded-full" />
        <span class="text-md font-medium">{{ post.author.name }}</span>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
defineProps<{
  post: {
    id: number
    title: string
    description: string
    image: string
    views: number
    comments: number
    timestamp: string
    author: {
      name: string
      avatar: string
    }
  }
}>()
</script>
