<template>
  <div class="space-y-4">
    <Card
      v-for="card in cardStore.cards"
      :key="card.id"
      :id="card.id"
      :title="card.title"
      :description="card.description"
      :date="card.date || '—'"
      :likes="card.likes || 0"
      :comments="card.comments || 0"
      :image="card.image"
    />
  </div>
</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { useCardStore } from '@/stores/card/stores/cardStore'
import Card from './Card.vue'

const cardStore = useCardStore()

onMounted(() => {
  cardStore.loadCards()
})
</script>
