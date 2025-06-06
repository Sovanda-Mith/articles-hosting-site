import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  // server: {
  //     hmr: {
  //         host: "0.0.0.0",
  //     },
  //     port: 3000,
  //     host: true,
  //     watch: {
  //         usePolling: true,
  //     },
  // },
  server: {
    hmr: {
      host: 'localhost', // or your machine IP if needed externally
      protocol: 'ws',
      port: 3000,
    },
    port: 3000,
    host: '0.0.0.0', // <- This is important for Docker
    watch: {
      usePolling: true,
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.ts'],
      refresh: true,
    }),
    tailwindcss(),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
  ],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'),
    },
  },
  optimizeDeps: {
    include: ['vee-validate', 'yup'],
  },
});
