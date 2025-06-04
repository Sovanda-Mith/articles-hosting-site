<template>
  <div
    class="sec2_container w-full pt-24 pb-24 bg-[#222222] flex justify-center items-center sm:pl-64 sm:pr-64"
    :style="{ backgroundColor: bgColor, paddingTop: paddingTop, paddingBottom: paddingBottom }"
  >
    <div
      class="sec2_text flex flex-col justify-center items-center gap-10"
      :style="{ color: textColor }"
    >
      <h2 class="text-center">{{ title }}</h2>
      <p class="text-center">{{ description }}</p>
      <button
        v-if="buttonText"
        class="flex justify-center items-center pb-8 pt-8 pr-6 pl-6 w-[236px] h-[40px] text-whie bg-[#222222] rounded-[40px] border-2 border-white text-white"
      >
        {{ buttonText }}
      </button>
    </div>
  </div>
</template>
<style>
  @media (max-width: 768px) {
    .sec2_container {
      padding: 1rem;
    }
    .sec2_container {
      width: 100%;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    .sec2_text {
      width: 100%;
      padding-left: 1rem;
      padding-right: 1rem;
    }

    .sec2_text {
      font-size: 0.9rem;
    }
    .sec2_text h2 {
      font-size: 1.5rem;
    }

    .sec2_text p {
      font-size: 0.85rem;
    }

    .sec2_text button {
      font-size: 0.8rem;
    }
    sec2_container {
      padding: 1rem;
    }
    .sec2_container {
      width: 100%;
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }
</style>
<script lang="ts">
  export default {
    name: 'Section_2',
    props: {
      title: {
        type: String,
        default: 'Exploring The Space',
      },
      description: {
        type: String,
        default:
          "Dive deeper into a world of ideas with our Explore More Topics section! Whether you're passionate about technology, lifestyle, business, or creativity, you'll find a variety of engaging articles tailored to your interests. Discover trending discussions, insightful guides, and expert opinions—all curated to keep you informed and inspired. Keep exploring, keep learning! 🚀",
      },
      buttonText: {
        type: String,
      },
      bgColor: {
        type: String,
        default: '#222222',
      },
      textColor: {
        type: String,
        default: '#ffffff',
      },
      paddingTop: {
        type: String,
      },
      paddingBottom: {
        type: String,
      },
    },
  };
</script>
