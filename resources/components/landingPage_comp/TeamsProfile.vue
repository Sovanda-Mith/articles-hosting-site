<template>
  <div class="w-fit flex flex-col gap-3 text-white justify-center items-center">
    <div class="w-[169px] h-[175px] rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
      <img :src="avatar" alt="" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" />
    </div>
    <div class="text-center space-y-2">
      <h3 class="text-xl font-bold text-white tracking-wide">{{ name }}</h3>
      <p class="text-sm text-gray-300 font-medium bg-gray-800/30 px-3 py-1 rounded-full border border-gray-600/50">{{ description }}</p>
    </div>
  </div>
</template>
<style></style>
<script lang="ts">
  import teamAvatar from '../../assets/landingPage_img/teamAvatar.png';
  export default {
    name: 'TeamsProfile',
    props: {
      name: {
        type: String,
        default: 'Team Name',
      },
      description: {
        type: String,
        default: 'Team Description',
      },
    },
    data() {
      return {
        avatar: teamAvatar
      };
    }
  };
</script>
