<template>
  <div class="flex flex-col h-screen">
    <CreateArticleHeader />
    <Editor />
  </div>
</template>
<script setup lang="ts">
  import CreateArticleHeader from '@/components/article_comp/CreateArticleHeader.vue';
  import Editor from '@/components/article_comp/Editor.vue';
</script>
