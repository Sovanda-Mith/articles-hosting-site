<template>
  <section class="body-1 space-y-3">
    <header>
      <h2 class="text-h5 text-primary mb-2">About Me</h2>
      <p class="text-muted-foreground">
        Sharing the practical lessons of philosophy and history for your life and work.
      </p>
    </header>
    <div class="space-y-3 text-base text-gray-700">
      <!-- <p>
        I am a history PhD, independent philosophy scholar, and essayist. My passion is making complex ideas accessible and useful.
      </p>
      <p>
        With experience in marketing strategy and a busy family life, I bring a unique perspective to every topic I explore.
      </p> -->
      {{ aboutMe }}
    </div>
    <footer class="flex flex-col sm:flex-row gap-4 pt-4 border-t justify-between items-start sm:items-center">
      <div class="flex items-center gap-2">
        <a
          href="mailto:steven.gambardella@gmail.com"
          class="flex items-center gap-1 text-primary hover:underline break-all"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <rect x="3" y="5" width="18" height="14" rx="2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M3 7l9 6 9-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span>steven.gambardella@gmail.com</span>
        </a>
      </div>
      <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
        <Button
          href="#"
          class="px-4 py-2 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 transition-colors shadow-sm"
        >
          Subscribe
        </Button>
      </div>
    </footer>
  </section>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import type { User } from '../../lib/types/user';
import { useUserStore } from '@/stores/features/users/user';
import { computed } from 'vue';
defineOptions({
  name: 'ViewerProfileAbout'
});

const userStore = useUserStore();
const user = computed(() => userStore.user as User | null);

const aboutMe = computed(() => user.value?.bio || 'No bio available.')
</script>
