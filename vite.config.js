import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

const isProduction = process.env.NODE_ENV === 'production';

export default defineConfig({
  plugins: [
      laravel({
        input: ['resources/css/app.css', 'resources/js/app.ts'],
        refresh: true,
      }),
      tailwindcss(),
      vue(),
  ],
  build: {
    outDir: 'public/build',
    manifest: true,
    rollupOptions: {
      input: ['resources/css/app.css', 'resources/js/app.ts'],
    },
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
  server: {
    // https: (() => {
    //   try {
    //     if (fs.existsSync('./docker/ssl/cloudflare-origin.key') && fs.existsSync('./docker/ssl/cloudflare-origin.crt')) {
    //       console.log('SSL certificates loaded successfully.');
    //       console.log('Using SSL for development server.');
    //       return {
    //         key: fs.readFileSync('./docker/ssl/cloudflare-origin.key'),
    //         cert: fs.readFileSync('./docker/ssl/cloudflare-origin.crt'),
    //       };
    //     }
    //     return false;
    //   } catch (error) {
    //     console.warn('Failed to load SSL certificates:', error.message);
    //     return false;
    //   }
    // })(),
    https: false,
    cors: true,
    hmr: {
      // host: isProduction ? 'bloggist.fun' : 'localhost',
      host: 'bloggist.fun',
      protocol: 'ws',
      port: 3000,
    },
    port: 3000,
    host: '0.0.0.0',
    watch: {
      usePolling: true,
    },
  },
  optimizeDeps: {
    include: ['vee-validate', 'yup'],
  },
});
