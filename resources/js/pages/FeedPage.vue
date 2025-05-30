<template>
  <Header></Header>
  <div class="flex flex-col justify-center items-center">
    <div class="flex pl-72">
      <div class="flex flex-col">
        <div class="flex items-center justify-between">
          <div class="flex flex-1 justify-center">
            <div class="py-5 space-x-4">
              <button class="py-2 px-4 text-xl font-semibold border-b-2 border-black">
                For You
              </button>
              <button class="py-2 px-4 text-xl text-gray-500 hover:text-black">Following</button>
            </div>
          </div>
          <div class="border p-2 rounded-sm">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-6"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"
              />
            </svg>
          </div>
        </div>

        <div>
          <preview
            profile_img="/feedpage_img/profile1.jpg"
            publisherName="Sky_blue"
            title="Nature Doesn't Rush, So Why Are You?"
            subtitle="Overworked? Overwhelmed? Maybe You're Moving Too Fast."
            pub_date="Mar 10"
            clapNum="4.4k"
            commentNum="129"
            preview_img="/feedpage_img/img1.jpg"
          />
        </div>
      </div>

      <div class="flex flex-col w-[80%] pl-28 pr-72">
        <div class="py-5 space-x-4 border-b-1">
          <button class="py-2 text-xl font-semibold border-black">Trending</button>
        </div>

        <div>
          <trending_preview
            profile_img="/feedpage_img/profile1.jpg"
            publisherName="Sky_blue"
            title="Nature Doesn't Rush, So Why Are You?"
            pub_date="Mar 10"
          />
        </div>
      </div>
    </div>
  </div>
  <Footer></Footer>
</template>

<script lang="ts">
  import Header from '../../components/landingPage_comp/Header.vue';
  import Footer from '../../components/landingPage_comp/Footer.vue';
  import preview from '../../../resources/components/feedpage_comp/preview.vue';
  import trending_preview from '../../../resources/components/feedpage_comp/trending_preview.vue';

  export default {
    components: {
      preview,
      trending_preview,
    },
  };
</script>

<style scoped></style>
