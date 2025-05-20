<template>
  <div class="sec1_container w-full sm:pl-20 sm:pr-20 h-full pt-20 pb-20 flex">
    <div class="sec1_subcontainer w-full h-full flex gap-14 items-center justify-center">
      <div class="sec1_text w-[50%] flex flex-col justify-center items-start gap-7">
        <h2 class="">{{ title }}</h2>
        <p class="subtitle-2">{{ description }}</p>
        <div class="flex gap-[31px] items-center">
          <button
            v-if="button1Text"
            class="text-center bg-black text-[#ffffff] pl-[12px] pr-[12px] pt-[17px] pb-[17px] rounded-[15px] primary-btn-animation"
            ref="button1Element"
          >
            {{ button1Text }}
          </button>
          <p v-if="button1Text && button2Text" class="subtitle-2">OR</p>
          <button
            v-if="button2Text"
            class="text-center text-black bg-[#ffffff] pl-[12px] pr-[12px] pt-[17px] pb-[17px] rounded-[15px] shadow-xl border-[1px] border-[#000000] secondary-btn-animation"
            ref="button2Element"
          >
            {{ button2Text }}
          </button>
        </div>
      </div>
      <div class="w-[50%] flex justify-end">
        <img ref="imageElement" :src="image" alt="" class="sec1_img w-[500px] slide-in-right" />
      </div>
    </div>
  </div>
</template>
<style>
  .slide-in-right {
    opacity: 0;
    transform: translateX(100px);
    transition:
      opacity 0.8s ease-out,
      transform 0.8s ease-out;
  }

  .slide-in-right.visible {
    opacity: 1;
    transform: translateX(0);
  }

  .primary-btn-animation {
    opacity: 0;
    transform: translateY(20px);
    transition:
      opacity 0.6s ease-out,
      transform 0.6s ease-out,
      background-color 0.3s ease;
  }

  .primary-btn-animation.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .primary-btn-animation:hover {
    background-color: #333;
    transform: scale(1.05);
  }

  .secondary-btn-animation {
    opacity: 0;
    transform: translateY(20px);
    transition:
      opacity 0.6s ease-out 0.2s,
      transform 0.6s ease-out 0.2s,
      box-shadow 0.3s ease;
  }

  .secondary-btn-animation.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .secondary-btn-animation:hover {
    box-shadow:
      0 10px 15px -3px rgba(0, 0, 0, 0.1),
      0 4px 6px -2px rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
  }

  @media (max-width: 1024px) {
    .sec1_subcontainer {
      flex-direction: column;
    }
    .sec1_img {
      width: 80%;
      height: auto;
    }
    .w-\[50\%\] {
      width: 100%;
    }
  }

  @media (max-width: 768px) {
    sec1_container {
      padding: 1rem;
    }
    .sec1_container {
      width: 100%;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    .sec1_subcontainer {
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    .sec1_subcontainer {
      width: 100%;
      height: auto;
    }

    .sec1_text {
      font-size: 0.9rem;
    }
    .sec1_text h2 {
      font-size: 1.5rem;
    }

    .sec1_text p,
    .sec1_text .subtitle-2 {
      font-size: 0.85rem;
    }

    .sec1_text button {
      font-size: 0.8rem;
    }

    .sec1_img {
      width: 100%;
    }
    .flex.gap-\[31px\] {
      flex-direction: column;
      align-items: flex-start;
      gap: 15px;
    }
    button {
      width: 100%;
    }
  }
</style>

<script lang="ts">
  export default {
    name: 'Section1',
    mounted() {
      // Use nextTick to ensure the DOM is fully rendered before setting up the observer
      this.$nextTick(() => {
        this.setupScrollAnimation();
      });
    },
    methods: {
      setupScrollAnimation() {
        const observer = new IntersectionObserver(
          (entries) => {
            entries.forEach((entry) => {
              if (entry.isIntersecting) {
                // TypeScript safe way to access classList
                const element = entry.target as HTMLElement;
                element.classList.add('visible');
                // Once the animation has played, we can stop observing
                observer.unobserve(element);
              }
            });
          },
          { threshold: 0.2 }
        ); // Trigger when 20% of the element is visible

        // Start observing the image element
        if (this.$refs.imageElement) {
          observer.observe(this.$refs.imageElement as HTMLElement);
        }

        // Start observing the button elements
        if (this.$refs.button1Element) {
          observer.observe(this.$refs.button1Element as HTMLElement);
        }

        if (this.$refs.button2Element) {
          observer.observe(this.$refs.button2Element as HTMLElement);
        }
      },
    },
    props: {
      title: {
        type: String,
        default: 'Read Learn Connect with people around the world!!',
      },
      description: {
        type: String,
        default:
          'Say HELLO to our Blogging page created by GIC I4-B3!! Main purpose of our website is connect YOU to the world and community of all sorts where you can share your thought FOR COMPLETELY FREE OF CHARGE',
      },
      button1Text: {
        type: String,
        default: '',
      },
      button2Text: {
        type: String,
        default: '',
      },
      image: {
        type: String,
        default: '/landingPage_img/sec1.png',
      },
    },
  };
</script>
