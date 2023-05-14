import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css','resources/scss/app.scss', 'resources/js/app.js','resources/js/car.js','resources/js/product.js','resources/js/register.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': '$'
        },
    },
});
