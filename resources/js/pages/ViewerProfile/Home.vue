<template>
    <div class="p-6">
      <CardLists />
    </div>
  </template>

  <script setup>
  import { defineOptions } from 'vue'
  import CardLists from '../../../components/profileComponents/CardLists.vue';

  defineOptions({
    name: 'ViewerProfileHome'
  });
  </script>
