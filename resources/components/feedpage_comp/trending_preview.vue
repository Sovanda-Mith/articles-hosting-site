<template>
    <div class=" border-b border-gray-300 py-2 pl-3 mt-3">
        <div class="flex items-center py-1">
            <img class="w-8 h-8 rounded-full object-cover" :src="profile_img" alt="Profile picture">
            <p class="pl-2 text-sm">{{ publisherName }}</p>
        </div>

        <RouterLink :to="`/article/${articleId}`">
          <p class="text-md font-extrabold font-['Poppins'] pb-3">
            {{title}}
          </p>
        </RouterLink>
        <div class="flex justify-between items-center space-x-4 ">
            <div class="text-xs">{{ pub_date }}</div>

        <!-- view count -->
        <div class="flex items-center gap-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-5 min-w-[20px]"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                />
              </svg>
            <p class="text-xs text-gray-500">{{ viewCount }} views</p>
        </div>

      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="size-6 text-xl"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
        />
      </svg>
    </div>
  </div>
</template>

<script lang="ts">
  export default {
    name: 'TrendingPreview',
    props: {
      profile_img: {
        type: String,
        default: '/feedpage_img/profile1.jpg',
      },
      publisherName: {
        type: String,
        default: 'Sky_blue',
      },
      title: {
        type: String,
        default: "Nature Doesn't Rush, So Why Are You?",
      },
      pub_date: {
        type: String,
        default: 'Mar 10',
      },
      viewCount: {
        type: String,
        default: '1.2K views',
      },
      articleId: {
        type: Number,
        required: true,
      },
    },
  };
</script>
