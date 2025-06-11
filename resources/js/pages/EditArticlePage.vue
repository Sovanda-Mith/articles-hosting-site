<template>
  <div class="flex flex-col">
    <EditArticleHeader @update="onUpdate" />
    <EditEditor ref="editorRef" />
    <!-- Category Modal -->
    <div
      v-if="showCategoryModal"
      class="fixed inset-0 bg-white bg-opacity-50 flex flex-col items-start z-50 md:px-10 md:pt-10 md:pb-20 lg:px-50 lg:pb-40 lg:pt-20 overflow-auto"
    >
      <div class="w-full flex justify-end">
        <button @click="showCategoryModal = false" class="p-2 hover:bg-gray-100 rounded-lg">
          <X class="w-10 h-10 text-gray-500" />
        </button>
      </div>
      <div class="rounded-md w-full mt-5">
        <h2 class="text-xl font-bold mb-4 text-[#212529]">Article Preview</h2>
        <div class="flex flex-col w-full">
          <!-- Uploaded Image Preview (Optional, outside the editor) -->
          <div v-if="editorRef.uploadedImages.length" class="mt-4">
            <div class="flex flex-wrap gap-4">
              <div
                v-for="(img, index) in editorRef.uploadedImages"
                :key="index"
                class="relative md:max-h-[500px] lg:max-h-[800px] max-w-full"
              >
                <img
                  :src="img.src"
                  :alt="img.name"
                  class="object-cover w-full h-full rounded-md shadow"
                />
              </div>
            </div>
          </div>
          <div v-else class="w-full h-[500px]">
            <label for="image-upload" class="btn w-full h-full" title="Add Image">
              <span class="text-xs font-serif text-[#868e96] flex justify-center"
                >Add Cover Image</span
              >
            </label>

            <input
              type="file"
              accept="image/*"
              id="image-upload"
              class="hidden"
              @change="editorRef.handleImageSelect"
            />
          </div>
        </div>

        <!-- Title input -->
        <div class="mt-8 w-full">
          <input
            type="text"
            v-model="editorRef.title"
            placeholder="Write a title"
            class="font-bold w-full border-b border-gray-300 focus:border-gray-500 focus:outline-none text-lg text-[#212529] placeholder-gray-400"
          />
        </div>

        <!-- Subtitle input -->
        <div class="mt-8 w-full">
          <input
            type="text"
            v-model="editorRef.subtitle"
            placeholder="Write a subtitle"
            class="font-semibold w-full border-b border-gray-300 focus:border-gray-500 focus:outline-none text-base text-[#495057] placeholder-gray-400"
          />
        </div>
      </div>

      <div class="mt-10 rounded-md w-full">
        <h2 class="text-xl font-bold mb-2 text-[#212529]">Select Categories</h2>
        <p class="text-sm text-[#495057] mb-4">
          Select up to 3 categories so readers know what your article is about.
        </p>

        <!-- Responsive grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mb-6">
          <label
            v-for="category in categories"
            :key="category.category_id"
            class="flex items-center gap-2 text-[#212529] text-sm"
          >
            <input
              type="checkbox"
              :value="category.category_id"
              v-model="editorRef.selectedCategoryIds"
              :disabled="isDisabled(category)"
              class="accent-black w-4 h-4 disabled:opacity-50"
            />
            {{ category.name }}
          </label>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-2">
          <button
            @click="submitArticle(ArticleStatus.PUBLISHED)"
            class="bg-green-500 px-5 py-3 rounded-xl text-white cursor-pointer hover:bg-green-700"
          >
            Publish Update
          </button>
          <button
            @click="submitArticle(ArticleStatus.DRAFT)"
            class="px-5 py-3 text-gray-400 cursor-pointer hover:text-gray-600"
          >
            Save as Draft
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
  import { onMounted, ref } from 'vue';
  import axios from 'axios';
  import type { Category, Article } from '@/lib/types';
  import { ArticleStatus } from '@/lib/types';
  import router from '@/routes';
  import { X } from 'lucide-vue-next';
  import EditArticleHeader from '@/components/article_comp/EditArticleHeader.vue';
  import EditEditor from '@/components/article_comp/EditEditor.vue';
  // Modal state
  const showCategoryModal = ref(false);

  const categories = ref<Category[]>([]);

  const editorRef = ref();

  const token = localStorage.getItem('auth_token');

  // When "Publish" is clicked
  const onUpdate = () => {
    showCategoryModal.value = true;
  };

  const getCategories = async () => {
    try {
      const response = await axios.get('/api/category');

      if (response.status === 200) {
        categories.value = response.data.categories;
      }
    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  };

  // Final submit with categories
  const submitArticle = async (status: ArticleStatus) => {
    const article: Article = {
      title: editorRef.value?.title,
      subtitle: editorRef.value?.subtitle,
      content: editorRef.value?.editor.getHTML(),
      image: editorRef.value?.uploadedImages[0]?.src || '',
      status: status,
    };

    try {
      const response = await axios.post(
        '/api/articles',
        {
          title: article.title,
          subtitle: article.subtitle,
          content: article.content,
          image: article.image,
          status: article.status,
        },
        {
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            Authorization: `Bearer ${token}`,
          },
        }
      );

      if (response.status === 201) {
        const articleId = response.data.id;

        const categoryResponse = await axios.post('/api/articleCategory', {
          article_id: articleId,
          category_ids: editorRef.value.selectedCategoryIds,
        });

        if (categoryResponse.status === 200) {
          showCategoryModal.value = false;
          router.push(categoryResponse.data.redirect);
        }
      }
    } catch (error) {
      console.error('Error submitting article:', error);
    }
  };

  const isDisabled = (category: Category) => {
    return (
      editorRef.value.selectedCategoryIds.length >= 3 &&
      !editorRef.value.selectedCategoryIds.includes(category.category_id)
    );
  };

  onMounted(() => {
    getCategories();
  });
</script>
