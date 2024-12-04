import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/home/theme.css'],
            refresh: [{
                paths: [
                    // ...refreshPaths,
                    'app/Livewire/**',
                    'app/Http/Livewire/**',
                    'app/Forms/**',
                    'app/Tables/**',
                    'resources/views/**',
                ],
                config: { delay: 100 }
            }]
        }),
    ],
});
