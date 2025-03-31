<template>
    <div lang="ts">
        <h1>Does it work?</h1>
        <h2 v-if="isTesting">Yes</h2>
    </div>
    <main>
        <RouterView />
    </main>
</template>
<!-- <style scoped>
    h1 {
        color: red;
    }
    h2 {
        color: green;
    }
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100px;
        background-color: #333;
    }

</style> -->
<script setup lang="ts">
import { RouterView } from "vue-router";
import { ref, onMounted } from "vue";

const isTesting = ref<boolean>(true);

onMounted(() => {
    console.log('App.vue component mounted');
});
</script>

