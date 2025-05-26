<template>
    <div class="flex flex-col justify-start gap-5 h-full">
        <div class="flex justify-evenly items-start gap-5">
            <div class="bg-white h-40 rounded-2xl w-1/4 flex flex-col justify-center items-center gap-3 shadow-sm">
                <div class="text-gray-700">Total Users</div>
                <p class="text-lg">1,000</p>
            </div>
            <div class="bg-white h-40 rounded-2xl w-1/4 flex flex-col justify-center items-center gap-3 shadow-sm">
                <div class="text-gray-700">Total Articles</div>
                <p class="text-lg">1,000</p>
            </div>
            <div class="bg-white h-40 rounded-2xl w-1/4 flex flex-col justify-center items-center gap-3 shadow-sm">
                <div class="text-gray-700">Total Reports</div>
                <p class="text-lg">1,000</p>
            </div>
            <div class="bg-white h-40 rounded-2xl w-1/4 flex flex-col justify-center items-center gap-3 shadow-sm">
                <div class="text-gray-700">Total Banned Words</div>
                <p class="text-lg">1,000</p>
            </div>
        </div>
        <div class="flex gap-5 h-full">
            <div class="bg-white w-2/3 rounded-2xl h-full flex flex-col gap-3 p-5">
                <div class="flex justify-between">
                    <div class="font-medium">Article</div>
                    <div class="text-gray-700">This Week</div>
                </div>
                <div class="flex justify-center items-center h-full w-full p-5">
                    <div class="flex items-end w-full">
                        <!-- Y-axis -->
                        <div
                            class="flex flex-col justify-between text-sm text-gray-500 pr-2 border-r border-gray-300"
                            :style="{ height: `${chartHeight}px` }"
                        >
                            <span v-for="tick in ticks" :key="tick" class="relative">
                            <span class="absolute -top-2 right-1">{{ tick }}</span>
                            </span>
                        </div>

                        <!-- Bars -->
                        <div :style="{ height: `${chartHeight}px` }" class="w-full flex items-end justify-evenly  border-b border-gray-300">
                            <div
                            v-for="(value, index) in data"
                            :key="index"
                            class="flex flex-col items-center justify-end w-8"
                            >
                            <!-- Value above bar -->
                            <span class="mb-1 text-sm text-gray-700">{{ value }}</span>

                            <!-- Scaled Bar -->
                            <div
                                class="w-full bg-blue-500 rounded-t"
                                :style="{ height: `${(value / maxValue) * chartHeight}px` }"
                            ></div>

                            <!-- Day label -->
                            <span class="mt-2 text-sm text-gray-700">{{ days[index].slice(0, 3) }}</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="bg-white w-1/3 rounded-2xl flex flex-col h-full p-5">
                <div class="flex justify-between border-b-1 border-gray-300 pb-1">
                    <div class="font-medium">Top Users</div>
                    <div class="p-1 hover:bg-blue-100 cursor-pointer rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                </div>
                <div class="">
                    <table class="min-w-full text-sm text-left rounded-md">
                        <thead class="bg-gray-100 text-gray-600 pt-0.5 pb-0.5">
                            <tr>
                            <th class="px-4 py-2 font-medium">#Rank</th>
                            <th class="px-4 py-2 font-medium">Name</th>
                            <th class="px-4 py-2 font-medium">Articles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                            v-for="(item, index) in rankings"
                            :key="index"
                            class="border-t border-gray-100 hover:bg-gray-200"
                            >
                            <td class="px-4 py-2">{{ index + 1 }}</td>
                            <td class="px-4 py-2">{{ item.name }}</td>
                            <td class="px-4 py-2">{{ item.articles }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>


    </div>
</div>
</template>
<script setup lang="ts">
import { ref } from 'vue'

// Bar
const data = ref([40, 70, 50, 90, 60, 30, 80])
const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']
const maxValue = 100
const chartHeight = 400 // pixels
const ticks = [100, 80, 60, 40, 20, 0]


interface RankEntry {
  name: string
  articles: number
}

// Rank
const rankings = ref<RankEntry[]>([
  { name: 'Merry', articles: 100 },
  { name: 'Johny', articles: 80 },
  { name: 'Noly', articles: 72 },
  { name: 'Sunny', articles: 69 },
  { name: 'Moly', articles: 50 },
  { name: 'Zuzy', articles: 33 },
  { name: 'Merry', articles: 100 },
  { name: 'Johny', articles: 80 },
  { name: 'Noly', articles: 72 },
  { name: 'Sunny', articles: 69 },
  
])

</script>