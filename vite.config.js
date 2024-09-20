import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'public/assets/scss/app.scss',
                'public/assets/scss/themes/dark/app-dark.scss',
                'public/assets/scss/pages/auth.scss',
                'public/assets/static/js/initTheme.js',
                'public/assets/static/js/components/dark.js',
                'public/assets/js/app.js',
                'resources/js/perfect-scrollbar.js',
            ],
            refresh: true,
        }),
    ],
});
