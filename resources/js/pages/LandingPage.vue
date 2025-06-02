<template>
  <div class="flex flex-col justify-center items-center gap-10 h-full">
    <Section1 button1-text="SHARE YOUR FIRST THOUGHT" button2-text="JOIN THE CONVERSATION" />
    <Section2 button-text="Discover More" />
    <Section2
      :bgColor="'#ffffff'"
      title="Featured Blog"
      text-color="black"
      description="Discover our Featured Blog, a handpicked article that stands out for its insight, depth, and relevance. Whether it’s a thought-provoking opinion piece, a deep dive into trending topics, or an inspiring story, this blog is a must-read. Stay informed, get inspired, and explore the ideas shaping the world today! "
    />
    <div class="w-full h-full flex flex-col justify-center items-center gap-10">
      <Section1
        title="Explore Trending Topics"
        image="/landingPage_img/sec3.png"
        description="Stay ahead with our Featured Topic, where we spotlight the most trending and insightful discussions of the moment. Whether it's the latest in tech, business innovations, or lifestyle trends, this section brings you in-depth analysis, expert opinions, and must-read articles. Don't miss out on what's shaping the conversation—dive in and explore now! "
      />
      <Section1
        title="Explore Trending Bloggers"
        image="/landingPage_img/sec4.png"
        description="Get to know the voices shaping today's conversations in our Explore Trending Bloggers section! From industry experts to creative storytellers, discover influential bloggers who bring fresh perspectives, insightful content, and engaging discussions. Stay updated with their latest posts and be inspired by their unique takes on trending topics!"
      />
    </div>
    <Section2
      title="Discover Feature Blog"
      padding-bottom="70px"
      padding-top="70px"
      description="Discover our Featured Blog, a handpicked article that stands out for its insight, depth, and relevance. Whether it’s a thought-provoking opinion piece, a deep dive into trending topics, or an inspiring story, this blog is a must-read. Stay informed, get inspired, and explore the ideas shaping the world today! "
    />

    <div class="featureCard_container flex gap-12 mt-12 mb-12">
      <FeaturedCard />
      <FeaturedCard
        class="mt-40"
        title="Explore For You Page"
        description="Thing you might like"
        image="/landingPage_img/card2.png"
      />
      <FeaturedCard
        title="Recommended For You"
        description="Trending Blogger"
        image="/landingPage_img/card3.png"
      />
    </div>
  </div>
</template>
<style scoped>
  @media (max-width: 1024px) {
    .featureCard_container {
      flex-direction: column;
      align-items: center;
    }
    .featureCard_container {
      width: 100%;
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }
</style>
<script lang="ts">
  import Section1 from '../../../resources/components/landingPage_comp/Section1.vue';
  import Section2 from '../../../resources/components/landingPage_comp/Section2.vue';
  import FeaturedCard from '../../../resources/components/landingPage_comp/FeaturedCard.vue';

  export default {
    components: {
      Section1,
      Section2,
      FeaturedCard,
    },
  };
</script>
