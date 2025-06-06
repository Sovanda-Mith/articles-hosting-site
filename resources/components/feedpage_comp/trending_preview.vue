<template>

    <div class=" border-b border-gray-300 py-2 pl-3 mt-3">
        <div class="flex items-center py-1">
            <img class="w-8 h-8 rounded-full object-cover" :src="profile_img" alt="Profile picture">
            <p class="pl-2 text-sm">{{ publisherName }}</p>
        </div>

        <div>
            <p class="text-xl font-extrabold font-['Poppins'] pb-3">
                {{title}}
            </p>
        </div>

        <div class="flex justify-between items-center space-x-4 ">
            <div class="text-xs">{{ pub_date }}</div>

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
    },
  };
</script>
