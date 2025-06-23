<template>
  <div class="flex flex-col ml-[100px] flex-1 space-y-[10px] w-full">
    <div class="flex justify-between h-[50px] items-center cursor-pointer">
      <div class="flex flex-col cursor-pointer" @click="downloadData">
        <p class="font-medium">Download your information</p>
        <p class="text-gray-500 text-sm">
          Download a copy of your information in a .zip file format
        </p>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
  import axios from 'axios';

  const downloadData = async () => {
    try {
      const response = await axios.get('/api/settings/download', {
        headers: {
          'Content-Type': 'application/zip',
          Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
        },
        responseType: 'blob',
      });

      const blob = new Blob([response.data], { type: 'application/zip' });
      const url = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = url;
      link.download = 'data.zip';
      link.click();
      window.URL.revokeObjectURL(url);
    } catch (error) {
      console.error(error);
    }
  };
</script>
