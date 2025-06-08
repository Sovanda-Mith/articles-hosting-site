<script setup lang="ts">
  import ArticleContent from '@/components/detailarticlePage_comp/ArticleContent.vue';
  import Comment from '@/components/detailarticlePage_comp/Comment.vue';
  import DetailFooter from '@/components/detailarticlePage_comp/DetailFooter.vue';
  import Recommendation from '@/components/detailarticlePage_comp/Recommendation.vue';
  import AuthHeader from '@/components/settingPage_comp/AuthHeader.vue';
</script>

<template>
  <AuthHeader />
  <div class="w-full max-w-4xl h-auto flex flex-col justify-center mx-auto mt-20 pb-5 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold pb-3 sm:pb-5">Soil Health - Recovery From Degradation</h1>
    <h3 class="text-lg sm:text-xl md:text-2xl text-gray-500 pb-3 sm:pb-5 font-medium">
      Once our soil becomes depleted or polluted - what can be done to bring it back to good health environment
    </h3>
    <div class="flex flex-col sm:flex-row gap-2 pb-5">
      <img src="@/assets/detailarticlePage_img/Profile.png" class="w-12 h-12 sm:w-[60px] sm:h-[60px] rounded-full" />
      <div class="flex flex-col pl-0 sm:pl-2">
        <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
          <span>Joe Procopeo</span>
          <i class="pi pi-circle-fill" style="font-size: 3px; color: gray;"></i>
          <span class="hover:underline underline-offset-2">Follow</span>
        </div>
        <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
          <span class="text-gray-500 font-normal text-xs sm:text-sm">Published in</span>
          <span class="font-bold text-sm sm:text-base">The Environment</span>
          <i class="pi pi-circle-fill" style="font-size: 3px; color: gray;"></i>
          <span class="text-gray-500 font-normal text-xs sm:text-sm">10 min read</span>
          <i class="pi pi-circle-fill" style="font-size: 3px; color: gray;"></i>
          <span class="text-gray-500 font-normal text-xs sm:text-sm">8 hours ago</span>
        </div>
      </div>
    </div>
    <div class="flex sm:flex-row items-center justify-between px-0 sm:px-10 py-3 sm:py-5 border-y-2 border-gray-100 pb-3 sm:pb-5 gap-4">
      <div class="flex items-center gap-6 sm:gap-10">
        <div class="flex items-center gap-1 sm:gap-2">
          <i class="pi pi-heart" style="font-size: 20px;"></i>
          <span>1.2K</span>
        </div>
        <div class="flex items-center gap-1 sm:gap-2">
          <i class="pi pi-comment" style="font-size: 20px;"></i>
          <span>8</span>
        </div>
      </div>
      <div class="flex items-center gap-6 sm:gap-15">
        <i class="pi pi-bookmark" style="font-size: 20px;"></i>
        <i class="pi pi-ellipsis-h" style="font-size: 20px;"></i>
      </div>
    </div>
    <figure class="flex flex-col items-center justify-center my-5">
      <img
        src="@/assets/detailarticlePage_img/image.png"
        alt=""
        class="w-full h-auto object-cover rounded-lg"
      />
      <figcaption class="text-gray-500 text-xs sm:text-sm mt-2">
        Image by <a href="">Josephine King</a> on Unsplash
      </figcaption>
    </figure>
    <ArticleContent />
    <div class="flex justify-center my-5"><i class="pi pi-ellipsis-h" style="font-size: 30px; color: gray;"></i></div>
    <div class="flex flex-col md:flex-row items-start justify-between gap-6">
      <div class="flex gap-2 sm:gap-4">
        <img src="@/assets/detailarticlePage_img/Profile.png" alt="" class="w-14 h-14 sm:w-[75px] sm:h-[75px] rounded-full">
        <div class="flex flex-col space-y-1">
          <span class="text-lg sm:text-2xl font-bold">Written by Joe Pricopio - Climage Ages</span>
          <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
            <span class="text-gray-500 text-sm sm:text-lg">1K Followers</span>
            <i class="pi pi-circle-fill" style="font-size: 3px;"></i>
            <span class="text-gray-500 text-sm sm:text-lg">500 Following</span>
          </div>
          <p class="text-xs sm:text-sm">I'm a multi-exit, multi-failure entrepreneur. AI pioneer. Technologist. Innovator. I write at Inc.com and BuiltIn.com. More about me at joeprocopio.com</p>
        </div>
      </div>
      <button class="text-white bg-black font-semibold px-4 sm:px-6 py-2 sm:py-4 rounded-2xl mt-4 md:mt-0 w-full md:w-auto">Follow</button>
    </div>
  </div>
  <div class="border-t-2 border-gray-100 w-full">
    <div class="w-full max-w-4xl h-auto flex flex-col justify-center mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="font-bold text-2xl sm:text-3xl md:text-4xl pl-0 sm:pl-5 my-6 sm:my-10">Response (8)</h2>
      <div class="flex items-center gap-2 sm:gap-4 mb-3 sm:mb-5 pl-0 sm:pl-5">
        <img src="@/assets/detailarticlePage_img/Profile.png" alt="" class="w-10 h-10 sm:w-[60px] sm:h-[60px] rounded-full" />
        <span class="text-lg sm:text-xl font-semibold">Mario</span>
      </div>
      <!-- Textarea -->
      <div class="bg-gray-100 rounded-2xl p-3 sm:p-5 w-full shadow-sm">
        <div class="mb-4 sm:mb-8">
          <textarea
            placeholder="What are your thoughts?"
            class="w-full h-24 sm:h-40 p-0 bg-transparent border-none outline-none resize-none text-gray-500 text-base sm:text-xl placeholder-gray-500 leading-relaxed font-semibold"
          ></textarea>
        </div>
        <div class="flex justify-end items-center gap-3 sm:gap-6">
          <button class="px-3 sm:px-4 py-1 sm:py-2 text-black font-medium text-sm sm:text-base">
            Cancel
          </button>
          <button class="px-3 sm:px-4 py-1 sm:py-2 rounded-full font-medium text-sm sm:text-base bg-gray-400 text-white">
            Respond
          </button>
        </div>
      </div>
      <div class="flex flex-col mt-6 sm:mt-10">
        <Comment />
        <Comment />
      </div>
      <a href="" class="w-fit border border-black rounded-full py-2 sm:py-3 px-4 sm:px-6 my-6 sm:my-10 text-base sm:text-lg font-semibold">See all responses</a>
    </div>
  </div>
  <div class="bg-gray-50 w-full">
    <div class="w-full max-w-4xl h-auto flex flex-col justify-center mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="font-bold text-2xl sm:text-3xl md:text-4xl pl-0 sm:pl-5 my-6 sm:my-10">Recommendation from Bloggist</h2>
      <div class="flex flex-col sm:flex-row items-center justify-between border-b border-gray-200 pb-6 sm:pb-10 gap-4">
        <Recommendation />
        <Recommendation />
      </div>
      <a href="" class="w-fit border border-black rounded-full py-2 sm:py-3 px-4 sm:px-6 my-6 sm:my-10 text-base sm:text-lg font-semibold bg-white">See more recommendations</a>
    </div>
  </div>
  <DetailFooter />
</template>
