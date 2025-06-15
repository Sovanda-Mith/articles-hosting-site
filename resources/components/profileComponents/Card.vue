<template>
  <div
    class="flex justify-between gap-4 p-4 rounded-lg border bg-color-card shadow-sm hover:shadow-md transition-shadow duration-300"
    style="border-color: var(--color-border); background-color: var(--color-card);"
  >
    <div class="flex-1">
      <h3 class="text-h5 font-bold mb-1" style="color: var(--color-foreground)">{{ title }}</h3>
      <p class="body-2 mb-2" style="color: var(--color-muted-foreground)">{{ description }}</p>
      <div class="flex items-center caption space-x-3" style="color: var(--color-muted-foreground)">
        <span>{{ date || '—' }}</span>
        <span class="flex items-center gap-1">
          <i class="ri-heart-line"></i> {{ likes || 0 }}
        </span>
        <span class="flex items-center gap-1">
          <i class="ri-chat-3-line"></i> {{ comments || 0 }}
        </span>
      </div>
    </div>
    <div>
      <img
        :src="image"
        alt="preview"
        class="w-24 h-24 rounded-md object-cover border"
        style="border-color: var(--color-border)"
      />
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
