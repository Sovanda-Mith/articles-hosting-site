<template>
  <div class="p-4">
    <ReadingList v-if="!selectedListId" @view-all="handleViewAll" />
    <BookmarkLists v-else @back="handleBack" />
    <myArticle class="mt-8" />
  </div>
</template>

<script setup lang="ts">
defineOptions({ name: 'ProfileHome' })
import { ref } from 'vue'
import ReadingList from '../../../../resources/components/profileComponents/ReadingList.vue'
import BookmarkLists from '../../../../resources/components/profileComponents/bookmarkLists.vue'
import myArticle from '../../../../resources/components/profileComponents/myArticle.vue'

const selectedListId = ref<number | null>(null)

function handleViewAll() {
  selectedListId.value = 1 // or set to the appropriate list id if you have multiple lists
}

function handleBack() {
  selectedListId.value = null
}
</script>

