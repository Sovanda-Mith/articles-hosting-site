<template>

    <div>
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
</template>

<script lang="ts">
import preview from "../../../resources/components/feedpage_comp/preview.vue";
import trending_preview from "../../../resources/components/feedpage_comp/trending_preview.vue";

export default {
    components: {
        preview,
        trending_preview,
    }
} 
</script>