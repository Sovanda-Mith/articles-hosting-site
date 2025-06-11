<script setup lang="ts">
  import { nextTick, onMounted, ref, computed } from 'vue';
  import axios from 'axios';
  import ArticleContent from '@/components/detailarticlePage_comp/ArticleContent.vue';
  import Comment from '@/components/detailarticlePage_comp/Comment.vue';
  import DetailFooter from '@/components/detailarticlePage_comp/DetailFooter.vue';
  import Recommendation from '@/components/detailarticlePage_comp/Recommendation.vue';
  import AuthHeader from '@/components/settingPage_comp/AuthHeader.vue';
  import { type Category, type Article, type User } from '@/lib/types';
  import dayjs from 'dayjs';
  import relativeTime from 'dayjs/plugin/relativeTime';
  import { useUserStore } from '@/stores/features/user';

  const showAll = ref(false);

  const displayedComments = computed(() =>
    showAll.value ? comments.value : comments.value.slice(0, 3)
  );

  const toggleShow = () => {
    showAll.value = !showAll.value;
  };

  const userStore = useUserStore();

  const props = defineProps({
    id: String,
  });

  const article = ref<Article>();

  const categories = ref<Category[]>([]);

  const author = ref<User>();

  const comments = ref([]);

  const commentContent = ref('');

  const addComment = async () => {
    try {
      const response = await axios.post(
        `/api/article/${props.id}/comment`,
        {
          content: commentContent.value,
        },
        {
          headers: {
            Authorization: `Bearer ${userStore.user.token}`,
          },
        }
      );
      if (response.status === 201) {
        commentContent.value = '';
        comments.value.push(response.data.comment);
        article.value.comments_count += 1;

        nextTick(() => {
          newComment.value?.scrollIntoView({ behavior: 'smooth', block: 'end' });
        });
      }
    } catch (error) {
      console.error(error);
    }
  };

  const isFollowing = ref(false);

  const checkIfFollowing = async () => {
    try {
      const response = await axios.post(
        `/api/follows/checkIfFollowing`,
        {
          following_id: author.value.id,
        },
        {
          headers: {
            Authorization: `Bearer ${userStore.user.token}`,
          },
        }
      );
      if (response.status === 200) {
        isFollowing.value = response.data.following;
        followId.value = response.data.follow_id;
      }
    } catch (error) {
      console.error(error);
    }
  };

  const followId = ref();

  const toggleFollowAuthor = async () => {
    if (isFollowing.value) {
      await unfollowAuthor();
      return;
    }
    try {
      const response = await axios.post(
        `/api/follows`,
        {
          following_id: author.value.id,
        },
        {
          headers: {
            Authorization: `Bearer ${userStore.user.token}`,
          },
        }
      );
      if (response.status === 201) {
        isFollowing.value = true;
        followId.value = response.data.id;
        author.value.followers_count += 1;
      }
    } catch (error) {
      console.error(error);
    }
  };

  const unfollowAuthor = async () => {
    try {
      const response = await axios.delete(`/api/follows/${followId.value}`, {
        headers: {
          Authorization: `Bearer ${userStore.user.token}`,
        },
      });
      if (response.status === 204) {
        isFollowing.value = false;
        followId.value = null;
        author.value.followers_count -= 1;
      }
    } catch (error) {
      console.error(error);
    }
  };

  const writeComment = ref(null);

  const scrollToComments = () => {
    if (writeComment.value) {
      writeComment.value.scrollIntoView({ behavior: 'smooth' });
    }
  };

  const newComment = ref(null);

  dayjs.extend(relativeTime);

  let timeAgo = ref('');

  const isLiked = ref(false);

  const getArticleAndItsCategories = async () => {
    try {
      const response = await axios.get(`/api/articles/${props.id}`);
      if (response.status === 200) {
        article.value = {
          article_id: response.data.id,
          user_id: response.data.user_id,
          title: response.data.title,
          subtitle: response.data.subtitle,
          content: response.data.content,
          image: response.data.image,
          status: response.data.status,
          view_count: response.data.view_count,
          likes_count: response.data.likes_count,
          comments_count: response.data.comments_count,
          created_at: response.data.created_at,
          updated_at: response.data.updated_at,
        };

        isLiked.value = article.value.likes_count > 0;

        timeAgo = dayjs(article?.value.created_at).fromNow();

        try {
          const categoryResponse = await axios.get(`/api/articleCategory/${props.id}`);
          if (categoryResponse.status === 200) {
            categoryResponse.data.map((category) => {
              categories.value.push({
                category_id: category.category_id,
                name: category.name,
                description: category.description,
              });
            });
          }
        } catch (error) {
          console.error('Error fetching article categories:', error);
        }

        try {
          const userResponse = await axios.get('/api/users/' + article.value.user_id);
          if (userResponse.status === 200) {
            author.value = {
              id: userResponse.data.data.id,
              email: userResponse.data.data.email,
              name: userResponse.data.data.name,
              username: userResponse.data.data.username,
              bio: userResponse.data.data.bio,
              avatar: userResponse.data.data.avatar,
              gender: userResponse.data.data.gender,
              role: userResponse.data.data.role,
            };
          }
        } catch (error) {
          console.error('Error fetching user:', error);
        }

        try {
          const likeResponse = await axios.get(`/api/article/${props.id}/likes`, {
            headers: {
              Authorization: `Bearer ${userStore.user.token}`,
            },
          });

          if (likeResponse.status === 200) {
            article.value.likes_count = likeResponse.data.likes_count;
          }
        } catch (error) {
          console.error('Error fetching likes:', error);
        }

        try {
          const commentResponse = await axios.get(`/api/article/${props.id}/comments`, {
            headers: {
              Authorization: `Bearer ${userStore.user.token}`,
            },
          });

          if (commentResponse.status === 200) {
            article.value.comments_count = commentResponse.data.comments_count;
            comments.value = commentResponse.data.comments;
          }
        } catch (error) {
          console.error('Error fetching comments:', error);
        }

        try {
          const followersResponse = await axios.get(
            `/api/follows/getFollowers/${author.value.id}`,
            {
              headers: {
                Authorization: `Bearer ${userStore.user.token}`,
              },
            }
          );

          if (followersResponse.status === 200) {
            author.value.followers_count = followersResponse.data.length;
          }
        } catch (error) {
          console.error('Error fetching followers:', error);
        }

        try {
          const followingResponse = await axios.get(
            `/api/follows/getFollowing/${author.value.id}`,
            {
              headers: {
                Authorization: `Bearer ${userStore.user.token}`,
              },
            }
          );

          if (followingResponse.status === 200) {
            author.value.following_count = followingResponse.data.length;
          }
        } catch (error) {
          console.error('Error fetching following:', error);
        }
      }
    } catch (error) {
      console.error('Error fetching article:', error);
    }
  };

  const toggleLike = async () => {
    try {
      const response = await axios.post(`/api/article/${props.id}/like`, null, {
        headers: {
          Authorization: `Bearer ${userStore.user.token}`,
        },
      });
      if (response.status === 200) {
        isLiked.value = response.data.is_liked;
        article.value.likes_count = response.data.likes_count;
      }
    } catch (error) {
      console.error('Error liking article:', error);
    }
  };

  onMounted(async () => {
    await getArticleAndItsCategories();
    await checkIfFollowing();
  });
</script>

<template>
  <AuthHeader />
  <div
    class="w-full max-w-4xl h-auto flex flex-col justify-center mx-auto mt-20 pb-5 px-4 sm:px-6 lg:px-8"
  >
    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold pb-3 sm:pb-5">
      {{ article?.title }}
    </h1>
    <h3 class="text-lg sm:text-xl md:text-2xl text-gray-500 pb-3 sm:pb-5 font-medium">
      {{ article?.subtitle }}
    </h3>
    <div class="flex flex-col sm:flex-row gap-2 pb-5">
      <img :src="author?.avatar" class="w-12 h-12 sm:w-[60px] sm:h-[60px] rounded-full" />
      <div class="flex flex-col pl-0 sm:pl-2">
        <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
          <span>{{ author?.name }}</span>
          <i class="pi pi-circle-fill" style="font-size: 3px; color: gray"></i>
          <span
            class="hover:underline underline-offset-2 cursor-pointer"
            @click="toggleFollowAuthor"
            >{{ isFollowing ? 'Following' : 'Follow' }}</span
          >
        </div>
        <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
          <span class="text-gray-500 font-normal text-xs sm:text-sm">Published in</span>
          <span class="font-bold text-sm sm:text-base">{{ author?.name }}</span>
          <i class="pi pi-circle-fill" style="font-size: 3px; color: gray"></i>
          <span class="text-gray-500 font-normal text-xs sm:text-sm">10 min read</span>
          <i class="pi pi-circle-fill" style="font-size: 3px; color: gray"></i>
          <span class="text-gray-500 font-normal text-xs sm:text-sm">{{ timeAgo }}</span>
        </div>
      </div>
    </div>
    <div
      class="flex flex-col sm:flex-row items-center justify-between px-0 sm:px-10 py-3 sm:py-5 border-y-2 border-gray-100 pb-3 sm:pb-5 gap-4"
    >
      <div class="flex items-center gap-6 sm:gap-10">
        <div class="flex items-center gap-1 sm:gap-2">
          <i
            class="pi"
            :class="isLiked ? 'pi-heart-fill text-red-500' : 'pi-heart'"
            style="font-size: 20px; cursor: pointer"
            @click="toggleLike"
          ></i>
          <span>{{ article?.likes_count }}</span>
        </div>
        <div class="flex items-center gap-1 sm:gap-2">
          <i
            class="pi pi-comment cursor-pointer"
            style="font-size: 20px"
            @click="scrollToComments"
          ></i>
          <span>{{ article?.comments_count }}</span>
        </div>
      </div>
      <div class="flex items-center gap-6 sm:gap-15">
        <i class="pi pi-bookmark" style="font-size: 20px"></i>
        <i class="pi pi-ellipsis-h" style="font-size: 20px"></i>
      </div>
    </div>
    <figure class="flex flex-col items-center justify-center my-5">
      <img :src="article?.image" alt="" class="w-full h-auto object-cover rounded-lg" />
      <!--
      <figcaption class="text-gray-500 text-xs sm:text-sm mt-2">
        Image by <a href="">Josephine King</a> on Unsplash
      </figcaption>
      -->
    </figure>
    <ArticleContent :content="article?.content" />
    <div class="mt-6 sm:mt-10 flex flex-wrap gap-2">
      <span
        v-for="category in categories"
        :key="category.category_id"
        class="text-sm sm:text-base px-3 py-1 bg-gray-100 text-gray-600 rounded-full"
      >
        {{ category.name }}
      </span>
    </div>
    <div class="flex justify-center my-5">
      <i class="pi pi-ellipsis-h" style="font-size: 30px; color: gray"></i>
    </div>
    <div class="flex flex-col md:flex-row items-start justify-between gap-6">
      <div class="flex gap-2 sm:gap-4">
        <img :src="author?.avatar" alt="" class="w-14 h-14 sm:w-[75px] sm:h-[75px] rounded-full" />
        <div class="flex flex-col space-y-1">
          <span class="text-lg sm:text-2xl font-bold">{{ author?.name }}</span>
          <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
            <span class="text-gray-500 text-sm sm:text-lg"
              >{{ author?.followers_count }} Followers</span
            >
            <i class="pi pi-circle-fill" style="font-size: 3px"></i>
            <span class="text-gray-500 text-sm sm:text-lg"
              >{{ author?.following_count }} Following</span
            >
          </div>
          <p class="text-xs sm:text-sm">
            {{ author?.bio }}
          </p>
        </div>
      </div>
      <button
        class="text-white bg-black font-semibold px-4 sm:px-6 py-2 sm:py-4 rounded-2xl mt-4 md:mt-0 w-full md:w-auto cursor-pointer"
        @click="toggleFollowAuthor"
      >
        {{ isFollowing ? 'Following' : 'Follow' }}
      </button>
    </div>
  </div>
  <div class="border-t-2 border-gray-100 w-full">
    <div
      ref="writeComment"
      class="w-full max-w-4xl h-auto flex flex-col justify-center mx-auto px-4 sm:px-6 lg:px-8"
    >
      <h2 class="font-bold text-2xl sm:text-3xl md:text-4xl pl-0 sm:pl-5 my-6 sm:my-10">
        Response ({{ article?.comments_count }})
      </h2>
      <div class="flex items-center gap-2 sm:gap-4 mb-3 sm:mb-5 pl-0 sm:pl-5">
        <img
          :src="userStore.user.avatar"
          alt=""
          class="w-10 h-10 sm:w-[60px] sm:h-[60px] rounded-full"
        />
        <span class="text-lg sm:text-xl font-semibold">{{ userStore.user.name }}</span>
      </div>
      <!-- Textarea -->
      <div class="bg-gray-100 rounded-2xl p-3 sm:p-5 w-full shadow-sm">
        <div class="mb-4 sm:mb-8">
          <textarea
            v-model="commentContent"
            placeholder="What are your thoughts?"
            class="w-full h-24 sm:h-40 p-0 bg-transparent border-none outline-none resize-none text-gray-500 text-base sm:text-xl placeholder-gray-500 leading-relaxed font-semibold"
          ></textarea>
        </div>
        <div class="flex justify-end items-center gap-3 sm:gap-6">
          <button
            class="px-3 sm:px-4 py-1 sm:py-2 text-black font-medium text-sm sm:text-base cursor-pointer"
            @click="commentContent = ''"
          >
            Cancel
          </button>
          <button
            class="px-3 sm:px-4 py-1 sm:py-2 rounded-full font-medium text-sm sm:text-base bg-gray-400 text-white hover:bg-gray-500 cursor-pointer"
            @click="addComment"
          >
            Respond
          </button>
        </div>
      </div>
      <div ref="newComment" class="flex flex-col mt-6 sm:mt-10">
        <Comment
          v-for="comment in displayedComments"
          :key="comment.comment_id"
          :id="comment.comment_id"
          :user_id="comment.user_id"
          :name="comment.user.name"
          :avatar="comment.user.avatar"
          :content="comment.content"
          :timeAgo="dayjs(comment.created_at).fromNow()"
        />
      </div>
      <a
        v-if="comments.length > 3"
        @click="toggleShow"
        class="w-fit border border-black rounded-full py-2 sm:py-3 px-4 sm:px-6 my-6 sm:my-10 text-base sm:text-lg font-semibold"
        >{{ showAll ? 'Show Less' : 'See all responses' }}</a
      >
    </div>
  </div>
  <div class="bg-gray-50 w-full">
    <div class="w-full max-w-4xl h-auto flex flex-col justify-center mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="font-bold text-2xl sm:text-3xl md:text-4xl pl-0 sm:pl-5 my-6 sm:my-10">
        Recommendation from Bloggist
      </h2>
      <div
        class="flex flex-col sm:flex-row items-center justify-between border-b border-gray-200 pb-6 sm:pb-10 gap-4"
      >
        <Recommendation />
        <Recommendation />
      </div>
      <a
        href=""
        class="w-fit border border-black rounded-full py-2 sm:py-3 px-4 sm:px-6 my-6 sm:my-10 text-base sm:text-lg font-semibold bg-white"
        >See more recommendations</a
      >
    </div>
  </div>
  <DetailFooter />
</template>
