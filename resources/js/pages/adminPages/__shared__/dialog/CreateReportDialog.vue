<template>
  <div
    v-if="show"
    class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm backdrop-brightness-75 bg-black/30"
  >
    <div
      class="relative w-full max-w-xl mx-auto bg-white rounded-xl shadow-2xl p-6 animate-fade-in"
    >
      <h2 class="text-2xl font-semibold text-gray-800 mb-6">Create Report</h2>

      <form @submit.prevent="submitForm" class="space-y-4">
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Reporter</label>
          <select
            v-model="form.reporter_id"
            class="w-full border border-gray-300 rounded-md px-4 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
            <option disabled value="">-- Select Reporter --</option>
            <option
              v-for="option in reporterOptions"
              :key="option.id"
              :value="option.id"
            >
              {{ option.name }}
            </option>
          </select>
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Problem</label>
          <textarea
            v-model="form.problem"
            rows="3"
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          ></textarea>
        </div>

        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Article ID</label>
          <input
            v-model="form.articleId"
            type="text"
            class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <div class="flex justify-end gap-3 pt-4">
          <button
            type="button"
            @click="close"
            class="px-4 py-2 rounded-md text-sm bg-gray-100 hover:bg-gray-200 text-gray-700"
          >
            Cancel
          </button>
          <button
            type="submit"
            class="px-4 py-2 rounded-md text-sm bg-blue-600 hover:bg-blue-700 text-white"
            :disabled="!form.reporter_id || !form.problem || !form.articleId"
          >
            Create
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
</template>

<script setup lang="ts">
import { reactive, defineEmits, defineProps, watch } from 'vue'

const emit = defineEmits(['close', 'save'])

const props = defineProps<{
  show: boolean
  reporterOptions: {
    id: number
    name: string
  }[]
}>()

const form = reactive({
  reporter_id: null as number | null,
  problem: '',
  articleId: ''
})

// Clear form when modal opens
watch(
  () => props.show,
  (show) => {
    if (show) {
      form.reporter_id = null
      form.problem = ''
      form.articleId = ''
    }
  }
)

function close() {
  emit('close')
}

function submitForm() {
  emit('save', {
    reporter_id: form.reporter_id,
    problem: form.problem,
    article_id: form.articleId
  })
  close()
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
