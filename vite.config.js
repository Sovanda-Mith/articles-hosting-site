import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import fs from 'fs';

const isProduction = process.env.NODE_ENV === 'production';

export default defineConfig({
  // plugins: [
  //     laravel({
  //       input: ['resources/css/app.css', 'resources/js/app.ts'],
  //       refresh: true,
  //       buildDirectory: 'build',
  //     }),
  //     tailwindcss(),
  //     vue(),
  // ],
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
  build: {
    outDir: 'public/build',
    manifest: 'manifest.json',
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
    // SSL is only needed for development HMR with HTTPS sites
    https: !isProduction ? (() => {
      try {
        if (fs.existsSync('./docker/ssl/cloudflare-origin.key') && fs.existsSync('./docker/ssl/cloudflare-origin.crt')) {
          console.log('SSL certificates loaded for development HMR.');
          return {
            key: fs.readFileSync('./docker/ssl/cloudflare-origin.key'),
            cert: fs.readFileSync('./docker/ssl/cloudflare-origin.crt'),
          };
        }
        console.log('No SSL certificates found, using HTTP for development.');
        return false;
      } catch (error) {
        console.warn('Failed to load SSL certificates:', error.message);
        return false;
      }
    })() : false, // Production builds don't need Vite dev server
    cors: true,
    hmr: {
      host: isProduction ? 'bloggist.fun' : 'localhost', // Use localhost for Docker development
      protocol: isProduction ? 'wss' : 'ws', // Use ws for Docker development
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
