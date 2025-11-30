import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/tailwind.css', 'resources/js/app.js'],
            refresh: true,
        }),
        // config option টা ব্যবহার করে path টা বলে দিন
        tailwindcss({
            config: './tailwind.config.cjs' // Root থেকে config ফাইলের পাথ
        }),
    ],
});