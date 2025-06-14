<template>
  <div class="flex justify-between gap-4 p-4 rounded-lg border bg-white shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex-1">
      <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ title }}</h3>
      <p class="text-sm text-gray-600 mb-2">{{ description }}</p>
      <div class="flex items-center text-xs text-gray-500 space-x-3">
        <span>{{ date || '—' }}</span>
        <span class="flex items-center gap-1"><i class="ri-heart-line"></i> {{ likes || 0 }}</span>
        <span class="flex items-center gap-1"><i class="ri-chat-3-line"></i> {{ comments || 0 }}</span>
      </div>
    </div>
    <div>
      <img :src="image" alt="preview" class="w-24 h-24 rounded-md object-cover" />
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineOptions } from 'vue'
import type { CardItem } from '@/stores/card/types/card'

defineOptions({ name: 'ProfileCard' })

defineProps<CardItem>()
</script>

<style scoped>
@import 'https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css';
</style>
