<template>
  <!-- about us description -->
  <Section2
    title="About us"
    bg-color="white"
    text-color="black"
    description="Welcome to our blogging platform—a space where ideas, stories, and creativity come to life.
        We believe in the power of words to inspire, inform, and connect people from all walks of life. Whether you're an experienced writer or just starting your journey, our platform provides the tools and community to help you share your voice with the world."
  />
  <!-- Our Team -->
  <div class="bg-[#222222] w-full pt-5 pb-5 flex flex-col gap-5 pl-2 pr-2">
    <h2 class="w-full text-white text-center">Our Team</h2>
    <div class="w-full h-full flex flex-col gap-10">
      <div class="w-full flex justify-between pr-[20%]">
        <TeamsProfile name="Mith Sovanda" />
        <TeamsProfile name="Nann Koungkea" />
        <TeamsProfile name="Kong Sopheakvortey" />
      </div>
      <div class="w-full flex justify-between pl-[20%]">
        <TeamsProfile name="Ly Kimann" />
        <TeamsProfile name="Korb Daven" />
        <TeamsProfile name="Kham Veasna" />
      </div>
    </div>
  </div>
  <!-- Reviews -->
  <div class="Review_container bg-white w-full pt-5 pb-10 flex flex-col">
    <h2 class="w-full text-center pb-5">Reviews</h2>
    <div class="flex flex-col gap-10 pl-[10%] pr-[10%]">
      <div class="Review-subcontainer flex justify-between">
        <ReviewCard
          title="Amazing Platform!!"
          description='"I love how easy it is to share my thoughts and connect with other writers. The interface is smooth, and the community is super supportive!" – Emily R.'
        />
        <ReviewCard
          title=" Room for Improvement, But Solid"
          description='"I enjoy using this platform, but I’d love to see more customization options. Still, it’s one of the best blogging sites out there!" – Daniel P.'
        />
      </div>
      <div class="Review-subcontainer flex justify-between">
        <ReviewCard
          title="Great for Beginners!"
          description='"As someone new to blogging, this platform made it really simple to start. The writing tools are intuitive, and I’ve learned so much already!" – James L.'
        />
        <ReviewCard
          title="Best Blogging Experience"
          description='"This site has everything I need—great features, a welcoming community, and a seamless way to publish my posts. Highly recommend!" – Sophia M.'
        />
      </div>
    </div>
  </div>
</template>
<style scoped>
  @media (max-width: 1024px) {
    .Review-subcontainer {
      flex-direction: column;
      align-items: center;
      gap: 40px;
    }
  }
</style>
<script lang="ts">
  import TeamsProfile from '../../components/landingPage_comp/TeamsProfile.vue';
  import Section2 from '../../components/landingPage_comp/Section2.vue';
  import ReviewCard from '../../components/landingPage_comp/ReviewCard.vue';

  export default {
    name: 'AboutUsPage',
    components: {
      Section2,
      TeamsProfile,
      ReviewCard,
    },
  };
</script>
