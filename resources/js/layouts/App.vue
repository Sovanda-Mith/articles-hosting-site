<template>
    <div lang="ts">
        <h1>Does it work?</h1>
        <h2 v-if="isTesting">Yes</h2>
    </div>
</template>
<script setup lang="ts">
import { ref } from "vue";

const isTesting = ref<boolean>(true);
</script>
