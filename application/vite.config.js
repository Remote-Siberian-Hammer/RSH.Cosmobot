import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: true,
        hmr: {
            host: 'localhost',
        },
        watch: {
          usePolling: true,
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/leader-line/leader-line.min.js',
                'resources/js/dialogue-chain.js',
                'resources/css/app.effects.css',
                'resources/css/bootstrap-5-3-2/bootstrap.min.css',
                'resources/js/bootstrap-5-3-2/bootstrap.bundle.min.js',

            ],
            refresh: true,
        }),
    ],
});
