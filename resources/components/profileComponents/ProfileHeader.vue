<template>
  <p class="text-h2">{{ UsernameStore.username }}</p>
</template>

<script setup lang="ts">
import { useUsernameStore } from '../../js/stores/username/userName'
const UsernameStore = useUsernameStore()
</script>
