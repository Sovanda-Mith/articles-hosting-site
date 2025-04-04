<template>
    <!-- about us description -->
    <Section2 title="About us" bg-color="white" text-color="black"
        description="Welcome to our blogging platform—a space where ideas, stories, and creativity come to life.
        We believe in the power of words to inspire, inform, and connect people from all walks of life. Whether you're an experienced writer or just starting your journey, our platform provides the tools and community to help you share your voice with the world." />
    <!-- Our Team -->
    <div class="bg-[#222222] w-full  pt-5 pb-5 flex flex-col gap-5 pl-2 pr-2">
        <h2 class="w-full text-white text-center">Our Team</h2>
        <div class="w-full h-full flex flex-col gap-10">
            <div class="w-full flex justify-between pr-[20%]">
                <TeamsProfile name="Mith Sovanda"/>
                <TeamsProfile name="Nann Koungkea"/>
                <TeamsProfile name="Kong Sopheakvortey"/>
            </div>
            <div class="w-full flex justify-between pl-[20%]">
                <TeamsProfile name="Ly Kimann"/>
                <TeamsProfile name="Korb Daven"/>
                <TeamsProfile name="Kham Veasna"/>
            </div>

        </div>
    </div>
    <!-- Reviews -->
    <div class="bg-white w-full h-[600px] pt-5 pb-5 flex flex-col">
        <h2 class="w-full text-center">Reviews</h2>
        <div class="flex flex-col gap-10">
            <ReviewCard />
        </div>
    </div>
</template>
<style scoped>
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
        

    }
}


</script>
