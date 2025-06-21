<template>
  <div class="p-4">
    <ReadingList v-if="!selectedListId" @preview-click="handlePreviewClick" />
    <bookmarkLists v-else :listId="selectedListId" @back="handleBack" />
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import ReadingList from '@/components/profileComponents/ReadingList.vue'
import bookmarkLists from '@/components/profileComponents/bookmarkLists.vue'

const selectedListId = ref<number | null>(null)

function handlePreviewClick(id: number) {
  selectedListId.value = id
}

function handleBack() {
  selectedListId.value = null
}
</script>
