<script setup lang="ts">
  import Comment from 'resources/components/detailarticlePage_comp/Comment.vue';
  import Recommendation from 'resources/components/detailarticlePage_comp/Recommendation.vue';
</script>

<template>
  <div class="max-w-1/2 h-auto flex justify-center flex-col mx-auto mt-5">
    <h1 class="text-6xl font-extrabold pb-5">Soil Health - Recovery From Degradation</h1>
    <h3 class="text-2xl text-gray-500 pb-5 font-medium">
      Once our soil becomes depleted or polluted - what can be done to bring it back to good health
      environment
    </h3>
    <div class="flex gap-2 pb-5">
      <img src="/detailarticlePage_img/image.png" class="w-[60px] h-[60px] rounded-full" />
      <div class="flex flex-col pl-2">
        <div class="flex items-center gap-3">
          <span>Joe Procopeo</span>
          <i class="pi pi-circle-fill" style="font-size: 4px"></i>
          <span>Follow</span>
        </div>
        <div class="flex items-center gap-3">
          <span class="text-gray-500 font-normal text-sm">Published in</span>
          <span class="font-bold text-base">The Environment</span>
          <i class="pi pi-circle-fill" style="font-size: 4px"></i>
          <span class="text-gray-500 font-normal text-sm">10 min read</span>
          <i class="pi pi-circle-fill" style="font-size: 4px"></i>
          <span class="text-gray-500 font-normal text-sm">8 hours ago</span>
        </div>
      </div>
    </div>
    <div class="flex items-center justify-between px-10">
      <div class="flex">
        <div class="">
          <i class="pi pi-heart" style="font-size: 20px"></i>
          <span>100</span>
        </div>
        <div class="">
          <i class="pi pi-comment" style="font-size: 20px"></i>
          <span>40</span>
        </div>
      </div>
      <div class="flex">
        <div>
          <i class="pi pi-bookmark"></i>
        </div>
        <div>
          <i class="pi pi-ellipsis-h"></i>
        </div>
      </div>
    </div>
    <img src="" alt="" />
    <article>
      <p>
        Sheila is a very talented friend of mine. There's this job she wants. And she should get it.
        She'd crush it. She'd literally make the company extra millions of dollars in her first 30
        days there.
      </p>
      <br />
      <p>But she can't get anyone at the company to talk to her.</p>
      <br />
      <p>
        This is a problem. A massive problem. And from my months-long research into the current
        labor quagmire, it's maybe the real reason no one is getting hired.And the ironic thing is
        that it's also the easiest problem to fix.
      </p>
      <br />
      <p>You All Know “Sheila” Already</p>
      <p>I've been talking with and about her for a while now.</p>
    </article>
    <i class="pi pi-ellipsis-v"></i>
    <div>
      <div>
        <img src="/detailarticlePage_img/image.png" alt="" />
      </div>
      <div>
        <span>Written by Joe Procopeo</span>
        <div>
          <span>4.6K Followers</span>
          <i class="pi pi-circle-fill"></i>
          <span>640 Following</span>
        </div>
        <span
          >Helping Scientists Align Their Careers with Impact & Purpose | Founder of Climate Ages.
          Join my Free Newsletter: https://climateages.com/newsletter/</span
        >
      </div>
      <button>Follow</button>
    </div>
    <h2>Response (8)</h2>
    <div>
      <img src="/detailarticlePage_img/image.png" alt="" />
      <span>Mario</span>
    </div>
    <!-- Textarea -->
    <textarea
      rows="4"
      class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-300 resize-none"
      placeholder="What are your thoughts?"
    ></textarea>

    <!-- Actions -->
    <div class="mt-4 flex justify-end space-x-3">
      <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800">
        Cancel
      </button>
      <button
        class="px-4 py-2 text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 disabled:bg-blue-300 disabled:cursor-not-allowed"
      >
        Respond
      </button>
    </div>
    <Comment />
    <Comment />
    <a href="">See all responses</a>
    <div>
      <h2>Recommendation from Bloggist</h2>
      <div>
        <Recommendation />
        <Recommendation />
      </div>
      <a href="">See more recommendations</a>
    </div>
  </div>
</template>
