import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    define: {
        'process.env': process.env
    },
    server: {
        host: 'localhost', // or '0.0.0.0' to allow external access
        port: 5173,
        hmr: {
            host: 'localhost',
        },
    },
});
