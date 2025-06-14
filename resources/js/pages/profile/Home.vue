<template>
    <ReadingList
        :username="'yourUsername'"
        :avatarUrl="'/path/to/avatar.jpg'"
        :storyCount="0"
    />
</template>

<script setup lang="ts">
import { defineOptions } from 'vue'
import ReadingList from '../../../../resources/components/profileComponents/ReadingList.vue';

defineOptions({
  name: 'ProfileHome'
});
</script>
