import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
  server: {
    https: true, // Ensure Vite runs in HTTPS mode locally
  },
  base: '/build/', // Ensure assets are served from the correct base URL
});

