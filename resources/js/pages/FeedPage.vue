 <template>
    <AppHeader />
        <div class="flex flex-row justify-center items-start ml-72 mr-40 mt-20 mb-32 sm:ml-32  ">

            <div class="flex flex-col md:w-[100%]  lg:pr-8 xl:pr-32 ">

                <div class="sticky top-1/12 bg-white">
                    <div class=" flex items-center justify-between  px-4">
                        <div class=" flex flex-1 justify-center">
                            <div class="py-5 space-x-4 text-xl ">
                                <router-link to="/feed/foryou" active-class="active-tab">For You</router-link>
                                <router-link to="/feed/following" active-class="active-tab">Following</router-link>
                            </div>
                        </div>

                        <button class="border p-2 w-10 rounded-sm ml-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>

                    </div>
                </div>
                <div>
                    <router-view></router-view>
                </div>
            </div>

            <div class="hidden md:flex md:flex-col md:w-[40%] sticky top-1/12 min-w-[400px] xl:min-w-[400px] lg:min-w-[300px]">
                <div class="py-5 space-x-4 border-b-1 border-gray-300 ">
                    <div class="py-2 text-xl font-semibold border-black">Trending</div>
                </div>

                <div>
                    <trending_preview
                        v-for="article in articles"
                        :key="article.id"
                        :profile_img="'/feedpage_img/profile1.jpg'"
                        :publisherName="`User ${article.user_id}`"
                        :title="article.title"
                        :pub_date="articleStore.formatDate(article.created_at)"
                        :clapNum="article.likes_count?.toString() || '0'"
                        :commentNum="article.comments_count?.toString() || '0'"
                        :preview_img="article.image || '/feedpage_img/img1.jpg'"
                        :viewCount="article.view_count?.toString() || '0'"
                        :articleId="article.id"
                    />
                    <router-link to="/feed/trending" active-class="active-tab" class="text-sm text-gray-500 hover:underline  ">See the full list</router-link>
                </div>
            </div>
        </div>
</template>

<script setup lang="ts">
  import AppHeader from '../../components/landingPage_comp/Header.vue';
  // import preview from "../../../resources/components/feedpage_comp/preview.vue";
  import trending_preview from "../../../resources/components/feedpage_comp/trending_preview.vue";
  import { useArticleStore } from '../stores/features/articles/stores/ArticleStore';
  import { storeToRefs } from 'pinia';
  import { ref, onMounted } from 'vue';

  const articleStore = useArticleStore();
  const { articles } = storeToRefs(articleStore);

  const idLoading = ref(false);
  const error = ref<string | null>(null);

  //load trending articles
  const loadTrendingArticles = async () => {
      idLoading.value = true;
      error.value = null;

      try {
          await articleStore.fetchTrendingArticles();
      } catch (err) {
          error.value = 'Failed to load trending articles';
          console.error(err);
      } finally {
          idLoading.value = false;
      }
  }

  onMounted(() => {
      loadTrendingArticles();
  });
</script>

<style scoped>
.active-tab {
  font-weight: bold;
  border-bottom: 2px solid black;
}
</style>

