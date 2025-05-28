<template>
  <div class="p-6 bg-white rounded shadow text-sm h-full overflow-y-auto">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold">Reports ({{ reports.length }})</h2>
      <div class="flex items-center gap-4">
        <div class="flex justify-center items-center border-[1.5px] shadow px-2 rounded border-gray-200">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                </svg>
            </span>
            <div>
            <input
                    type="text"
                    placeholder="Search"
                    class="px-4 py-2 rounded w-64 focus:outline-none focus:ring-0 border-none"
                />
            </div>
        </div>
        <button class="text-blue-600 cursor-pointer">Create</button>
        <button class="text-blue-600 cursor-pointer">Delete</button>
        <button class="text-gray-500 hover:text-blue-600 cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
           <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
          </svg>
        </button>
        <button class="text-gray-500 hover:text-blue-600 cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
          </svg>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto ">
      <table class="min-w-full text-left border-t border-b border-gray-200">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="p-2"><input type="checkbox" v-model="selectAll" /></th>
            <th class="p-2">Report ID.</th>
            <th class="p-2">Reporter</th>
            <th class="p-2">Problem</th>
            <th class="p-2">Article ID</th>
            <th class="p-2">Issued Date</th>
            <th class="p-2"></th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(report, index) in reports"
            :key="index"
            class="hover:bg-gray-100 border-t border-gray-200"
          >
            <td class="p-2"><input 
                type="checkbox" 
                v-model="report.selected"
                @change="checkSelectAll"
                /></td>
            <td class="p-2 text-blue-600 cursor-pointer">
              {{ report.id }}
            </td>
            <td class="p-2">{{ report.reporter }}</td>
            <td class="p-2">{{ report.problem }}</td>
            <td class="p-2">{{ report.articleId }}</td>
            <td class="p-2">{{ report.issued }}</td>
            <td class="p-2">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 text-gray-500 hover:text-blue-600 cursor-pointer"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 5l7 7-7 7"
                />
              </svg>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</template>

<script lang="ts" setup>
import { ref, watch } from 'vue'
interface Report {
  id: string
  reporter: string
  problem: string
  articleId: string
  issued: string
  selected: boolean
}

const selectAll = ref(false)

const reports = ref<Report[]>(
  Array.from({ length: 15 }, () => ({
    id: '500009086',
    reporter: 'Sony',
    problem: 'Harmful Content',
    articleId: '1000112233',
    issued: '1 hour ago',
    selected: false,
  }))
)

// Watch "selectAll" and update all reports
watch(selectAll, (val) => {
  reports.value.forEach((report) => {
    report.selected = val
  })
})

// Update "selectAll" when any individual checkbox is changed
function checkSelectAll() {
  selectAll.value = reports.value.every((report) => report.selected)
}
</script>
