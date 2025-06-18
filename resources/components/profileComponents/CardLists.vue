<template>
  <div
    class="space-y-6"
    :class="scrollableClass"
  >
    <div
      v-for="card in cardStore.cards"
      :key="card.id"
      class="flex flex-col gap-5 p-6 pl-12 rounded-xl bg-card text-card-foreground border-b border-border"
    >
      <div class="flex items-center gap-3 text-base font-semibold">
        <img
          :src="card.avatar || '/feedpage_img/profile1.jpg'"
          alt="Avatar"
          class="w-8 h-8 rounded-full object-cover"
        />
        <span>{{ card.username || 'Unknown User' }}</span>
      </div>


      <div class="flex flex-col md:flex-row justify-between gap-6">
        <div class="flex-1">

          <h3 class="text-h5 font-bold leading-snug">{{ card.title || 'Untitled' }}</h3>

          <p v-if="card.description" class="body-1 text-muted-foreground mb-3">
            {{ card.description }}
          </p>
          <p v-else class="body-1 text-muted-foreground mb-3 italic">
            No description provided.
          </p>

          <div class="flex items-center text-sm text-muted-foreground space-x-6">
            <span>{{ formatDate(card.date) }}</span>
            <span class="flex items-center gap-2">
              <i class="ri-hand-heart-line"></i> {{ card.likes ?? 0 }}
            </span>
            <span class="flex items-center gap-2">
              <i class="ri-chat-3-line"></i> {{ card.comments ?? 0 }}
            </span>
          </div>
        </div>

        <div>
          <img
            :src="card.image || '/feedpage_img/img1.jpg'"
            alt="Card image"
            class="w-48 h-32 rounded-lg object-cover transition-transform duration-300 hover:scale-105 hover:shadow-lg"
          />
        </div>
      </div>
    </div>
  </div>
</template>


<script setup lang="ts">
import { onMounted, computed } from 'vue'
import { useCardStore } from '@/stores/card/stores/cardStore'

const cardStore = useCardStore()

const scrollableClass = computed(() =>
  cardStore.cards.length > 5
    ? 'max-h-[40rem] overflow-y-auto pr-2 scrollbar-hide'
    : ''
)

onMounted(() => {
  cardStore.loadCards()
})

function formatDate(dateStr: string | undefined): string {
  if (!dateStr) return '—'
  const d = new Date(dateStr)
  return isNaN(d.getTime()) ? '—' : d.toLocaleDateString()
}
</script>

<style scoped>
@import 'https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css';

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
