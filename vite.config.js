import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import fs from 'fs';

const isProduction = process.env.NODE_ENV === 'production';

// Check if SSL certificates exist
// const sslKeyPath = path.resolve(__dirname, 'docker/ssl/localhost-key.pem');
// const sslCertPath = path.resolve(__dirname, 'docker/ssl/localhost.pem');
// const hasSSL = fs.existsSync(sslKeyPath) && fs.existsSync(sslCertPath);

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
    // Conditionally enable HTTPS only if SSL certificates exist
    // https: hasSSL ? {
    //   key: fs.readFileSync(sslKeyPath),
    //   cert: fs.readFileSync(sslCertPath),
    // } : false,
    // https: false,
    cors: true,
    hmr: {
      host: isProduction? 'bloggist.fun':'localhost',
      protocol: isProduction ? 'wss' : 'ws',
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
