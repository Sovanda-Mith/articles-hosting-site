<template>
    <div class="grid gap-8 [grid-template-columns:repeat(auto-fill,minmax(300px,1fr))]">      
      <div v-for="article in articles" 
      :key="article.id" 
      class="border border-gray-300 [border-radius:0.5rem] overflow-hidden transition-transform duration-200 ease-in-out hover:-translate-y-1 hover:shadow-md"
      >
        <preview
          :title="article.title"
          :subtitle="article.subtitle || 'No subtitle'"
          :pub-date="formatDate(article.created_at)"
          :clap-num="article.likes_count?.toString() || '0'"
          :comment-num="article.comments_count?.toString() || '0'"
          :publisherName="`User ${article.user_id}`"
          :profile_img="'/feedpage_img/profile1.jpg'"
          :preview_img="article.image || '/feedpage_img/img1.jpg'"
          :viewCount="article.view_count?.toString() || '0'"
          :articleId="article.id"
          />
      </div>
    </div>
  </template>
  
  <script setup lang="ts">
  import { defineProps } from 'vue';
  import preview from '../../../resources/components/feedpage_comp/preview.vue';
  import type ArticleInterface from '../../../resources/js/stores/features/articles/types/ArticleInterface.ts';
  
  const props = defineProps<{
    articles: ArticleInterface[];
  }>();
  
  const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
      month: 'short',
      day: 'numeric',
      year: 'numeric',
    });
  };
  </script>
  
  <style scoped>
  </style>