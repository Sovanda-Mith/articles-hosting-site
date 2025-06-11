<script setup lang="ts">
  import { useUserStore } from '@/stores/features/user';
  import { computed } from 'vue';
  import { DropdownMenuRoot, DropdownMenuTrigger, DropdownMenuContent } from 'reka-ui';

  const userStore = useUserStore();

  const props = defineProps<{
    id: string;
    user_id: number;
    name: string;
    avatar: string;
    content: string;
    timeAgo: string;
    likesCount?: number;
    commentsCount?: number;
  }>();

  const likesCount = computed(() => props.likesCount ?? 0);

  const commentsCount = computed(() => props.commentsCount ?? 0);

  const isOwnerOfTheComment = computed(() => userStore.user.id === props.user_id);
</script>

<template>
  <div class="border-b border-t-2 border-gray-100 w-full py-5 px-5">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-3">
        <img :src="avatar" alt="" class="w-[60px] h-[60px] rounded-full" />
        <div class="flex flex-col">
          <span>{{ props.name }}</span>
          <span>{{ props.timeAgo }}</span>
        </div>
      </div>
      <DropdownMenuRoot>
        <DropdownMenuTrigger>
          <i
            class="pi pi-ellipsis-h cursor-pointer"
            style="font-size: 25px"
            v-if="isOwnerOfTheComment"
          ></i>
        </DropdownMenuTrigger>
        <DropdownMenuContent>
          <div>Hello</div>
        </DropdownMenuContent>
      </DropdownMenuRoot>
    </div>
    <div class="py-5">
      <span>{{ props.content }}</span>
    </div>
    <div class="flex items-center gap-10 pl-5">
      <div class="flex items-center gap-2">
        <i class="pi pi-heart" style="font-size: 20px"></i>
        <span>{{ likesCount }}</span>
      </div>
      <div class="flex items-center gap-2">
        <i class="pi pi-comment" style="font-size: 20px"></i>
        <span>{{ commentsCount }}</span>
      </div>
      <span class="underline hover:cursor-pointer hover:text-[#212121]">Reply</span>
    </div>
  </div>
</template>
