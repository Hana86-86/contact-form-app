import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
<<<<<<< HEAD
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
=======
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});
>>>>>>> 1f671e1 (初回コミット（再構築後）)
