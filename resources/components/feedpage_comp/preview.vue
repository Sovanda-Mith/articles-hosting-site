<template>
    <div class="w-full py-5 px-4 sm:px-6 border-b-1  border-gray-300 sm:min-w-[600px]">
        <!-- publisher name/Info -->
        <div class="flex items-center">
            <img class="w-8 h-8 rounded-full object-cover" :src="profile_img" alt="Profile picture">
            <p class="pl-2 text-sm">{{ publisherName }}</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex flex-col space-y-4 sm:space-y-6 sm:pr-5 flex-1 min-w-0">
                <!-- title & subtitle  -->
                <div class="pb-2">
                    <p class="text-xl py-1 sm:py-2 font-extrabold">{{ title }}</p>
                    <p class="text-sm text-gray-500">{{ subtitle }}</p>
                </div>

                <!-- icons  -->
                <div class="flex justify-between items-start gap-2 text-sm">
                    <div class="flex items-center space-x-4 text-gray-500">
                        <div class="whitespace-nowrap">{{ pub_date }}</div>
                        <div class="flex items-center space-x-1 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 min-w-[20px]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 1 0-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 0 1 3.15 0v1.5m-3.15 0 .075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 0 1 3.15 0V15M6.9 7.575a1.575 1.575 0 1 0-3.15 0v8.175a6.75 6.75 0 0 0 6.75 6.75h2.018a5.25 5.25 0 0 0 3.712-1.538l1.732-1.732a5.25 5.25 0 0 0 1.538-3.712l.003-2.024a.668.668 0 0 1 .198-.471 1.575 1.575 0 1 0-2.228-2.228 3.818 3.818 0 0 0-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0 1 16.35 15m.002 0h-.002" />
                            </svg>
                            <span>{{ clapNum }}</span>
                        </div>
                        <div class="flex items-center space-x-1 whitespace-nowrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 min-w-[20px]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                            </svg>
                            <span>{{commentNum}}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 min-w-[20px]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 min-w-[20px]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                            </svg>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 min-w-[20px]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- image  -->
            <div class="sm:flex-none sm:w-[30%] w-full">
                <img :src="preview_img" alt="Image" class="w-full h-auto rounded-lg shadow-lg">
            </div>
        </div>
    </div>
</template>
<style>
</style>

<script lang="ts">
export default {
    name: "Preview",
    props: {
        profile_img: {
            type: String,
            default: "/feedpage_img/profile1.jpg"
        },
        publisherName: {
            type: String,
            default: "Sky_blue"
        },
        title: {
            type: String,
            default: "Nature Doesn't Rush, So Why Are You?"
        },
        subtitle: {
            type: String,
            default: "Overworked? Overwhelmed? Maybe You're Moving Too Fast."
        },
        pub_date: {
            type: String,
            default: "Mar 10"
        },
        clapNum: {
            type: String,
            default: "4.4k"
        },
        commentNum: {
            type: String,
            default: "129"
        },
        preview_img: {
            type: String,
            default: "/feedpage_img/img1.jpg"
        }
    }
}

</script>
