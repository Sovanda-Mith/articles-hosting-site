<template>

    <div class="flex flex-row justify-center items-start mx-50  min-w-[400px]">
        <button class="mt-8 pr-4" @click="goBack"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="size-6">
                <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
            </svg>
        </button>

        <div>
            <div class="py-5 space-x-4 border-b-1 border-gray-300 flex flex-col">
                <div class="py-2 text-2xl font-semibold border-black">Trending</div>
                <p class="text-sm text-gray-500 ">Trending stories from across Medium</p>
            </div>
            <div class="bg-blue-50 ">
                <preview
                    profile_img = "/feedpage_img/profile1.jpg"
                    publisherName = "Sky_blue"
                    title = "Nature Doesn't Rush, So Why Are You?"
                    subtitle= "Overworked? Overwhelmed? Maybe You're Moving Too Fast."
                    pub_date = "Mar 10"
                    clapNum = "4.4k"
                    commentNum = "129"
                    preview_img =  "/feedpage_img/img1.jpg" 
                />
                <preview
                    profile_img = "/feedpage_img/profile1.jpg"
                    publisherName = "Sky_blue"
                    title = "Nature Doesn't Rush, So Why Are You?"
                    subtitle= "Overworked? Overwhelmed? Maybe You're Moving Too Fast."
                    pub_date = "Mar 10"
                    clapNum = "4.4k"
                    commentNum = "129"
                    preview_img =  "/feedpage_img/img1.jpg" 
                />
                <preview
                    profile_img = "/feedpage_img/profile1.jpg"
                    publisherName = "Sky_blue"
                    title = "Nature Doesn't Rush, So Why Are You?"
                    subtitle= "Overworked? Overwhelmed? Maybe You're Moving Too Fast."
                    pub_date = "Mar 10"
                    clapNum = "4.4k"
                    commentNum = "129"
                    preview_img =  "/feedpage_img/img1.jpg" 
                />
                <preview
                    profile_img = "/feedpage_img/profile1.jpg"
                    publisherName = "Sky_blue"
                    title = "Nature Doesn't Rush, So Why Are You?"
                    subtitle= "Overworked? Overwhelmed? Maybe You're Moving Too Fast."
                    pub_date = "Mar 10"
                    clapNum = "4.4k"
                    commentNum = "129"
                    preview_img =  "/feedpage_img/img1.jpg" 
                />
                <preview
                    profile_img = "/feedpage_img/profile1.jpg"
                    publisherName = "Sky_blue"
                    title = "Nature Doesn't Rush, So Why Are You?"
                    subtitle= "Overworked? Overwhelmed? Maybe You're Moving Too Fast."
                    pub_date = "Mar 10"
                    clapNum = "4.4k"
                    commentNum = "129"
                    preview_img =  "/feedpage_img/img1.jpg" 
                />
            </div>
        </div>

    </div>



</template> 

<script lang="ts">
import preview from "../../../resources/components/feedpage_comp/preview.vue";
import trending_preview from "../../../resources/components/feedpage_comp/trending_preview.vue";

export default {
    components: {
        preview,
        trending_preview,
    },
    methods:{
        goBack() {
            this.$router.go(-1);
        }
    }
}
</script>