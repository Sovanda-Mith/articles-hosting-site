<template>
    <div class="w-fit flex flex-col gap-3 text-white justify-center items-center">
        <div class="w-[169px] h-[175px]">
            <img src="/landingPage_img/teamAvatar.png" alt="" class="w-full h-full object-cover">
        </div>
        <h5>{{ name }}</h5>
        <h5>{{ description }}</h5>
    </div>
</template>
<style>
</style>
<script lang="ts">
export default {
    name: 'TeamsProfile',
    props:{
        name:{
            type: String,
            default: 'Team Name'
        },
        description:{
            type: String,
            default: 'Team Description'
        }
    }
}
</script>
