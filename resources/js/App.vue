<template>
    <main>

        <RouterView />
        
    </main>
</template>
<script setup lang="ts">
import { RouterView } from "vue-router";
import { ref, onMounted } from "vue";
import Header from "../components/landingPage_comp/Header.vue";
import Footer from "../components/landingPage_comp/Footer.vue";


</script>

