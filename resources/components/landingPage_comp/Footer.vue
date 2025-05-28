<template>
  <div class="bg-[#222222] w-full flex flex-col justify-center items-center pt-16 pb-8 gap-7">
    <div class="flex gap-44 justify-center items-center">
      <!-- logo -->
      <div class="flex justify-center items-center gap-3">
        <div class="w-[38px] h-[38px] rounded-[8px]">
          <img src="/landingPage_img/logo.webp" alt="" />
        </div>
        <h5 class="text-white">Bloggist</h5>
      </div>
      <!-- info -->
      <div class="grid-container gap-2">
        <div class="header subtitle-2">Help and support</div>
        <div class="header subtitle-2">Product</div>
        <div class="header subtitle-2">About Us</div>
        <div class="header subtitle-2">Community</div>
        <div class="row subtitle-2" v-for="item in row" :key="item.id">{{ item.name }}</div>
      </div>
    </div>
    <!-- additional info -->
    <div class="flex items-center justify-between w-[80%]">
      <div class="flex items-center gap-10 text-white">
        <p class="subtitle-2">@Copyright 2025</p>
        <div class="flex gap-3">
          <p class="subtitle-2">Help</p>
          <p class="subtitle-2">Privacy</p>
          <p class="subtitle-2">Terms</p>
        </div>
      </div>
      <!-- social-->
      <div class="flex items-center gap-10">
        <!-- icons -->
        <div class="flex gap-3">
          <img src="/landingPage_img/facebookIcons.png" alt="" class="icons" />
          <img src="/landingPage_img/twitterIcons.png" alt="" class="icons" />
          <img src="/landingPage_img/igIcons.png" alt="" class="icons" />
        </div>
        <!-- language -->
        <div>
          <!-- <p></p> -->
          <select class="bg-[#222222] text-white border-none subtitle-2">
            <option value="en">English (United States)</option>
            <option value="fr">French</option>
            <option value="es">Khmer</option>
          </select>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
  .grid-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 5 columns */
    grid-template-rows: repeat(6, 1fr); /* 6 rows */
    gap: 20px; /* Adjust the gap between items */
    padding: 20px; /* Optional padding around the grid */
  }
  .header {
    font-weight: bold;
    /* text-align: start; */
    color: #9f9f9f;
  }
  .row {
    color: white;
    font-weight: bold;
  }
  .icons {
    width: 30px;
    height: 30px;
  }
</style>
<script lang="ts">
  export default {
    name: 'Footer',
    data() {
      return {
        row: [
          { id: 1, name: 'Help center' },
          { id: 2, name: 'Pricing' },
          { id: 3, name: 'About' },
          { id: 4, name: 'Agencies' },
          { id: 5, name: 'Contact Us' },
          { id: 6, name: 'Solutions' },
          { id: 7, name: 'Branding' },
          { id: 8, name: 'Freelancers' },
          { id: 9, name: 'Privacy & Terms' },
          { id: 10, name: 'Education' },
          { id: 11, name: 'Newsroom' },
          { id: 12, name: 'Engineers' },
          { id: 13, name: 'Safety information' },
          { id: 14, name: 'Team plans' },
          { id: 15, name: 'Partnerships' },
          { id: 16, name: '' },
          { id: 17, name: 'Sitemap' },
          { id: 18, name: '' },
          { id: 19, name: 'Affiliate' },
          { id: 20, name: '' },
        ],
      };
    },
  };
</script>
