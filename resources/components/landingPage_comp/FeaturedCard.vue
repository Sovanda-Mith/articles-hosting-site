<template>
  <div class="flip-card w-full sm:w-80 perspective-1000">
    <!-- Card inner container with 3D perspective -->
    <div
      class="flip-card-inner relative w-full h-[30rem] sm:h-[40rem] md:h-[663px] transition-transform duration-700 transform-style-preserve-3d hover:rotate-y-180"
    >
      <!-- Front of card -->
      <div
        class="flip-card-front absolute w-full h-full backface-hidden rounded-2xl overflow-hidden border border-gray-200 shadow-md"
      >
        <!-- Image section (80%) -->
        <div class="h-[80%] overflow-hidden">
          <img :src="image" alt="Featured article image" class="w-full h-full object-cover" />
        </div>
        <!-- Text section (20%) -->
        <div
          class="h-[20%] w-full flex flex-col justify-center items-center px-2 py-2 sm:px-4 sm:py-3 md:px-6 gap-1 sm:gap-2 overflow-hidden"
        >
          <h5 class="text-center text-base sm:text-lg">{{ title }}</h5>
          <p class="body-big text-center text-sm sm:text-base">{{ description }}</p>
        </div>
      </div>

      <!-- Back of card -->
      <div
        class="flip-card-back absolute w-full h-full backface-hidden rounded-2xl overflow-hidden border border-gray-200 shadow-md bg-white rotate-y-180 p-3 sm:p-4 md:p-6"
      >
        <div class="flex flex-col h-full justify-between">
          <div>
            <h4 class="text-base sm:text-lg font-semibold mb-1 sm:mb-2">{{ title }}</h4>
            <p class="text-xs sm:text-sm mb-2 sm:mb-4">{{ description }}</p>
            <p class="text-xs sm:text-sm mb-1 sm:mb-2">{{ detailInfo }}</p>
          </div>
          <div class="mt-auto">
            <p class="text-xs text-gray-500">{{ publishDate }}</p>
            <p
              class="text-xs sm:text-sm font-medium text-cyan-600 mt-1 sm:mt-2 cursor-pointer hover:underline"
            >
              Read more
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
  .perspective-1000 {
    perspective: 1000px;
  }

  .transform-style-preserve-3d {
    transform-style: preserve-3d;
  }

  .backface-hidden {
    backface-visibility: hidden;
  }

  .rotate-y-180 {
    transform: rotateY(180deg);
  }
</style>
<script lang="ts">
  export default {
    name: 'FeaturedCard',
    props: {
      title: {
        type: String,
        default: 'Recommended For You',
      },
      description: {
        type: String,
        default: 'Trending Topic',
      },
      image: {
        type: String,
        default: '/landingPage_img/card1.png',
      },
      detailInfo: {
        type: String,
        default:
          'This article covers the latest trends and insights on this topic. Discover new perspectives and stay informed with our curated content.',
      },
      publishDate: {
        type: String,
        default: 'Published: April 3, 2025',
      },
    },
  };
</script>
