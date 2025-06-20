<template>
  <div class="flex flex-col ml-[100px] flex-1 space-y-[10px] w-full">
    <div class="flex justify-between h-[50px] items-center">
      <div class="flex flex-col">
        <p class="font-medium">Notifications on your articles</p>
        <p class="text-gray-500 text-sm">Get notifications for likes, comments, save, etc.</p>
      </div>
      <Checkbox
        v-model="notificationSettings.notify_on_article"
        @update:modelValue="updateSettingsNotification"
      />
    </div>
    <div class="flex justify-between h-[50px] items-center">
      <p class="font-medium">When someone follows you</p>
      <Checkbox
        v-model="notificationSettings.notify_on_follow"
        @update:modelValue="updateSettingsNotification"
      />
    </div>
    <div class="flex justify-between h-[50px] items-center">
      <p class="font-medium">New features from Bloggist</p>
      <Checkbox
        v-model="notificationSettings.new_feature"
        @update:modelValue="updateSettingsNotification"
      />
    </div>
  </div>
</template>
<script setup lang="ts">
  import Checkbox from '@/components/ui/checkbox/Checkbox.vue';
  import axios from 'axios';
  import { onMounted, ref } from 'vue';

  const notificationSettings = ref<{
    notify_on_article: boolean | null;
    notify_on_follow: boolean | null;
    new_feature: boolean | null;
  }>({
    notify_on_article: null,
    notify_on_follow: null,
    new_feature: null,
  });

  const updateSettingsNotification = async () => {
    try {
      const response = await axios.post('/api/settings/notification', notificationSettings.value, {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      });

      if (response.status === 200) {
        console.log(response.data);
      }
    } catch (error) {
      console.error(error);
    }
  };

  const getSettingsNotification = async () => {
    try {
      const response = await axios.get('/api/settings/notification', {
        headers: {
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
      });
      notificationSettings.value.notify_on_article = response.data.notify_on_article === 1;
      notificationSettings.value.notify_on_follow = response.data.notify_on_follow === 1;
      notificationSettings.value.new_feature = response.data.new_feature === 1;
    } catch (error) {
      console.error(error);
    }
  };

  onMounted(() => {
    getSettingsNotification();
  });
</script>
