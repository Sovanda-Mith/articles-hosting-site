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
import { ref } from "vue";

const isTesting = ref<boolean>(true);
</script>
