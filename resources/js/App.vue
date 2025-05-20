<template>
  <main>
    <!-- 
        <div class="flex flex-col justify-center items-center">

            <div class="flex pl-72">
                <div class="flex flex-col ">

                    <div class="flex items-center justify-between">
                        <div class="flex flex-1 justify-center">
                            <div class="py-5 space-x-4 ">
                                <button class="py-2 px-4 text-xl font-semibold border-b-2 border-black">For You</button>
                                <button class="py-2 px-4 text-xl text-gray-500 hover:text-black">Following</button>
                            </div>
                        </div>
                        <div class="border p-2 rounded-sm  ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <preview/>
                        <preview/>
                    </div>


                </div>

                <div class="flex flex-col w-[80%] pl-28 pr-72 ">
                    <div class="py-5 space-x-4 border-b-1 ">
                        <button class="py-2 text-xl font-semibold border-black">Trending</button>
                    </div>


                    <div>
                        <trending_preview/>
                        <trending_preview/>
                    </div>


                </div>
            </div>
        </div> -->

    <RouterView />
  </main>
</template>
<script setup lang="ts">
  import { RouterView } from 'vue-router';
  import { ref, onMounted } from 'vue';
  import Header from '../components/landingPage_comp/Header.vue';
  import Footer from '../components/landingPage_comp/Footer.vue';
</script>
