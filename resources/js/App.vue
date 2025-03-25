<template>
    <div lang="ts">
        <h1>Does it work?</h1>
        <h2 v-if="isTesting">Yes</h2>
    </div>
    <main>
        <RouterView />
    </main>
</template>
<script setup lang="ts">
import { RouterView } from "vue-router";
import { ref, onMounted } from "vue";

const isTesting = ref<boolean>(true);

onMounted(() => {
    console.log('App.vue component mounted');
});
</script>
