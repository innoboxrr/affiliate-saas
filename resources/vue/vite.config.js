import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@affiliate': path.resolve(__dirname, './'),
            '@affiliateComponents': path.resolve(__dirname, './src/components'),
            '@affiliateModels': path.resolve(__dirname, './src/models'),
            '@affiliatePages': path.resolve(__dirname, './src/pages'),
            '@affiliateStore': path.resolve(__dirname, './src/store'),
        },
    },
});
