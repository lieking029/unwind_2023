import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from 'vite-plugin-static-copy'

import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        // viteStaticCopy({
        //     targets: [
        //         {
        //             src: path.resolve(__dirname, 'node_modules/select2/dist/'),
        //             dest: path.resolve(__dirname, 'public/vendor/select2/')
        //         }
        //     ]
        // })
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
