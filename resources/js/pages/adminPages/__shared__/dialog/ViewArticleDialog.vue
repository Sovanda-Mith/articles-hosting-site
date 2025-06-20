<!-- <template>
  <div
    v-if="show"
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm backdrop-brightness-75 bg-black/30"
  >
    <div
      class="relative w-full max-w-xl mx-auto bg-white rounded-xl shadow-2xl p-6 animate-fade-in"
    >
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">View Article</h2>

      <form class="space-y-4">
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Author</label>
          <input
            :value="article?.author.name || ''"
            type="text"
            readonly
            class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed"
          />
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Title</label>
          <input
            :value="article?.title || ''"
            type="text"
            readonly
            class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed"
          />
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Description</label>
          <textarea
            :value="article?.description || ''"
            rows="3"
            readonly
            class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed resize-none"
          ></textarea>
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Description</label>
          <textarea
            :value="article?.content || ''"
            rows="3"
            readonly
            class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed resize-none"
          ></textarea>
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Article ID</label>
          <input
            :value="article?.id ?? ''"
            type="text"
            readonly
            class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed"
          />
        </div>

        <div class="flex justify-end gap-3 pt-4">
          <button
            type="button"
            @click="close"
            class="px-4 py-2 rounded-md text-sm bg-gray-100 hover:bg-gray-200 text-gray-700"
          >
            Close
          </button>
        </div>
      </form>

      <button
        @click="close"
        class="absolute top-3 right-3 text-gray-400 hover:text-gray-800 text-xl"
        aria-label="Close"
      >
        &times;
      </button>
    </div>
  </div>
</template> -->

<template>
  <div
    v-if="show"
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm backdrop-brightness-75 bg-black/30"
  >
    <div
      class="relative w-full max-w-4xl max-h-[90vh] mx-auto bg-white rounded-xl shadow-2xl p-6 animate-fade-in flex flex-col"
    >
      <h2 class="text-3xl font-semibold text-gray-800 mb-6">View Article</h2>

      <!-- Scrollable content wrapper -->
      <div class="overflow-y-auto flex-1 pr-2">
        <form class="space-y-6">
          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Author</label>
            <input
              :value="article?.author.name || ''"
              type="text"
              readonly
              class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Title</label>
            <input
              :value="article?.title || ''"
              type="text"
              readonly
              class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Description</label>
            <textarea
              :value="article?.description || ''"
              rows="4"
              readonly
              class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed resize-none"
            ></textarea>
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Article Image</label>
            <img
                :src="article?.image || ''"
                alt="Article Image"
                class="w-full max-h-64 object-contain rounded-lg"
            />
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Content</label>
            <textarea
              :value="article?.content || ''"
              rows="12"
              readonly
              class="w-full border border-gray-300 rounded-md px-4 py-2 bg-gray-100 cursor-not-allowed resize-none"
            ></textarea>
          </div>

          
        </form>
      </div>

      <div class="flex justify-end gap-3 pt-4">
        <button
          type="button"
          @click="close"
          class="px-6 py-2 rounded-md text-sm bg-gray-100 hover:bg-gray-200 text-gray-700"
        >
          Close
        </button>
      </div>

      <button
        @click="close"
        class="absolute top-3 right-3 text-gray-400 hover:text-gray-800 text-3xl font-bold"
        aria-label="Close"
      >
        &times;
      </button>
    </div>
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, watch, reactive } from 'vue'

interface Author {
  name: string
  avatar: string
}

interface Post {
  id: number
  title: string
  description: string
  content: string
  image: string
  views: number
  comments: number
  timestamp: string
  author: Author
}

const props = defineProps<{
  show: boolean
  article: Post | null
}>()

const emit = defineEmits(['close'])

const form = reactive({
  authorName: '',
  title: '',
  description: '',
  content: '',
  articleId: ''
})

watch(
  () => props.article,
  (article) => {
    if (article) {
      form.authorName = article.author.name
      form.title = article.title
      form.description = article.description
      form.content = article.content,
      form.articleId = String(article.id)
    } else {
      form.authorName = ''
      form.title = ''
      form.description = ''
      form.content = ''
      form.articleId = ''
    }
  },
  { immediate: true }
)

function close() {
  emit('close')
}
</script>

<style scoped>
@keyframes fade-in {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.animate-fade-in {
  animation: fade-in 0.2s ease-out forwards;
}
</style>
