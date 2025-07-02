<template>
    <section class="flex items-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full">
            <div class="relative dark:bg-gray-800 border-b">
                <div class="px-4 divide-y dark:divide-gray-700">
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center flex-1 space-x-2">
                            <h5 class="font-semibold dark:text-white">
                                {{ title }}
                            </h5>
                        </div>
                        <div class="flex items-center gap-4 justify-between sm:justify-end">
                            <global-actions-menu />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    
    import GlobalActionsMenu from './GlobalActionsMenu.vue';

    export default {
        name: 'DashboardHeaders',
        components: {
            GlobalActionsMenu
        },
        props: {
            title: {
                type: String,
                default: 'Dashboard'
            }
        },
    };
</script>
