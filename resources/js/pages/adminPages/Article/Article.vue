<template>
  <div class="p-4 h-lvh flex flex-col ">
    <div class="flex justify-between items-center mb-4">
        <div class="flex justify-center items-center gap-3">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
            </span>
            <!-- <span class="text-lg">Sort by: latest</span> -->
        </div>
      
        <div class="flex justify-center items-center border-[1.5px] shadow px-2 rounded border-gray-200">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                </svg>
            </span>
            <div>
            <input
                    type="text"
                    placeholder="Search"
                    v-model="search"
                    class="px-4 py-2 rounded w-64 focus:outline-none focus:ring-0 border-none"
                />
        </div>
    </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 ">
      <PostCard
        v-for="post in filteredPaginatedPosts"
        :key="post.id"
        :post="post"
        @click="openArticleModal(post)"
      />
    </div>

    <div class="mt-auto flex justify-center">
      <Pagination
        :currentPage="currentPage"
        :totalPages="totalPages"
        @change="handlePageChange"
      />
    </div>
  </div>

  <ViewArticleDialog
  :show="showArticleModal"
  :article="selectedArticle"
  @close="showArticleModal = false"
/>
</template>

<script lang="ts" setup>
import { ref, computed, onMounted } from 'vue'
import PostCard from '../__shared__/PostCard/PostCard.vue'
import Pagination from '../__shared__/Pagination/Pagination.vue'
import axios from 'axios'
 import ViewArticleDialog from '../__shared__/dialog/ViewArticleDialog.vue'

const showArticleModal = ref(false)
const selectedArticle = ref<Post | null>(null)

interface Author {
  name: string
  avatar: string
}

interface Post {
  id: number
  title: string
  description: string
  content: string
  image: string
  views: number
  comments: number
  timestamp: string
  author: Author
}

const posts = ref<Post[]>([]
)

const currentPage = ref(1)
const pageSize = 6
const search = ref('')

function openArticleModal(article: Post) {
  selectedArticle.value = article
  showArticleModal.value = true
}

function closeArticleModal() {
  showArticleModal.value = false
  selectedArticle.value = null
}

onMounted(async () => {
    try {
      const jwtToken = localStorage.getItem('auth_token');
      if (!jwtToken) return;

      const response = await axios.get('http://localhost:8000/api/admin/article', {
        headers: {
          Authorization: `Bearer ${jwtToken}`
        }
      })

      // Map your API response to your Report interface structure
      posts.value = response.data.map((r: any) => ({
        id: r.article_id,
        title: r.title,
        description: r.subtitle,
        content: r.content,
        image: r.image,
        views: r.view_count,
        comments: r.comments_count,
        timestamp: r.issued_date,
        author: {
          name: r.username,
          avatar: r.pf_user
        }
      })).sort((a, b) => {
        // Assuming id is numeric string; convert to number for sorting
        return Number(a.id) - Number(b.id);
      })


    } catch (error) {
      console.error('Failed to load report:', error)
    }
  })

const totalPages = computed(() => Math.ceil(filteredPosts.value.length / pageSize))

const filteredPosts = computed(() =>
  posts.value.filter(post =>
    post.title.toLowerCase().includes(search.value.toLowerCase()) ||
    post.description.toLowerCase().includes(search.value.toLowerCase())
  )
)

const filteredPaginatedPosts = computed(() =>
  filteredPosts.value.slice((currentPage.value - 1) * pageSize, currentPage.value * pageSize)
)

function handlePageChange(page: number) {
  currentPage.value = page
}
</script>
