import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true, // Pastikan refresh aktif
        }),
    ],
    server: {
        watch: {
            usePolling: true, // Ini penting untuk mendeteksi perubahan file
        },
    },
});
