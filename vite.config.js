import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin'; // Ensure this plugin is correctly installed via npm/yarn
import vue from '@vitejs/plugin-vue'; // Import Vue plugin for Vite
import path from 'path';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
      ],
      refresh: true, // Enable hot module replacement for Laravel
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }) // Enable Vue support in Vite
  ],
  build: {
    manifest: true, // Generate manifest file for Laravel
    outDir: 'public/build', // Output directory for Vite-built assets
  },
  server: {
    cors: true, // Enable CORS
  },
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js',
    }
  },
  define: {
    __VUE_OPTIONS_API__: true,
    __VUE_PROD_DEVTOOLS__: false,
    'process.env': {}
  }
});
