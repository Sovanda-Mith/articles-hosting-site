<template>
  <div class="flex items-center gap-3">
    <button
      @click="$emit('change', currentPage - 1)"
      :disabled="currentPage === 1"
      class="px-3 py-1 shadow-md rounded disabled:opacity-50"
    >
      ←
    </button>
    <button
      v-for="page in pagesToShow"
      :key="page"
      @click="$emit('change', page)"
      :class="[
        'px-3 py-1 shadow-md rounded',
        page === currentPage ? 'bg-blue-500 text-white' : 'bg-white'
      ]"
    >
      {{ page }}
    </button>
    <button
      @click="$emit('change', currentPage + 1)"
      :disabled="currentPage === totalPages"
      class="px-3 py-1 shadow-md rounded disabled:opacity-50"
    >
      →
    </button>
  </div>
</template>

<script lang="ts" setup>
const props = defineProps<{
  currentPage: number
  totalPages: number
}>()

const pagesToShow = Array.from({ length: props.totalPages }, (_, i) => i + 1)
</script>

