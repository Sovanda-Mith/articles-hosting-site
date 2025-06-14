<script setup lang="ts">
  import { useUserStore } from '@/stores/features/user';
  import { computed } from 'vue';
  import {
    DropdownMenuRoot,
    DropdownMenuTrigger,
    DropdownMenuContent,
    DropdownMenuItem,
  } from 'reka-ui';

  const userStore = useUserStore();

  const props = defineProps<{
    comment_id: number;
    user_id: number;
    name: string;
    avatar: string;
    content: string;
    timeAgo: string;
    likesCount?: number;
    commentsCount?: number;
  }>();

  const emit = defineEmits(['edit', 'delete']);

  const onEdit = () => {
    emit('edit', props.comment_id, props.content);
  };

  const onDelete = () => {
    emit('delete', props.comment_id);
  };

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
            class="pi pi-ellipsis-h text-gray-500 hover:text-gray-700 transition cursor-pointer"
            style="font-size: 24px"
            v-if="isOwnerOfTheComment"
          ></i>
        </DropdownMenuTrigger>

        <DropdownMenuContent class="w-44 bg-white border border-gray-200 rounded-xl shadow-lg p-1">
          <DropdownMenuItem
            class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-blue-50 text-gray-700 hover:text-blue-600 transition-all cursor-pointer text-sm"
            @click="onEdit"
          >
            <i class="pi pi-pencil text-blue-500"></i>
            <span>Edit</span>
          </DropdownMenuItem>

          <DropdownMenuItem
            class="flex items-center gap-3 px-4 py-2 rounded-md hover:bg-red-50 text-gray-700 hover:text-red-600 transition-all cursor-pointer text-sm"
            @click="onDelete"
          >
            <i class="pi pi-trash text-red-500"></i>
            <span>Delete</span>
          </DropdownMenuItem>
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
