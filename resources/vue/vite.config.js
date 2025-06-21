import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@affiliates': path.resolve(__dirname, './'),
            '@affiliatesComponents': path.resolve(__dirname, './src/components'),
            '@affiliatesModels': path.resolve(__dirname, './src/models'),
            '@affiliatesPages': path.resolve(__dirname, './src/pages'),
            '@affiliatesStore': path.resolve(__dirname, './src/store'),
        },
    },
});
