<template>
    <div class="bg-white dark:bg-gray-800 border rounded-lg overflow-hidden border dark:border-gray-700 p-4 mt-4">
        <!-- Header -->
        <div class="flex items-center justify-between pb-2 mb-2 dark:border-gray-600">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Documentación
            </h2>
        </div>

        <ul class="space-y-2">
            <li
                v-for="(step, index) in steps"
                :key="index"
                class="flex items-center justify-between px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                <div 
                    class="flex items-center"
                    @click="step.event">
                    <i :class="step.icon" class="text-blue-500 dark:text-blue-300 text-lg mr-2"></i>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ step.name }}
                    </span>
                </div>

                <button
                    @click="step.event"
                    class="text-gray-600 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400 transition">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </li>
        </ul>
    </div>
</template>

<script>
import DocumentationDialog from "@affiliateModels/affiliate-program/dialogs/documentation/DocumentationDialog.vue";
export default {
    components: {
        DocumentationDialog,
    },
    props: {
        affiliateProgram: {
            type: Object,
            required: true,
        },
    },
    computed: {
        steps() {
            return [
                {
                    name: "Cómo Funciona",
                    icon: "fas fa-info-circle",
                    event: () => {
                        this.openDrawer(
                            DocumentationDialog,
                            {
                                title: "Cómo Funciona",
                                view: "how-it-works",
                                program: this.affiliateProgram,
                            },
                            this.drawerCallback
                        );
                    },
                },
                {
                    name: "Invitar Afiliados",
                    icon: "fas fa-envelope",
                    event: () => {
                        this.openDrawer(
                            DocumentationDialog,
                            {
                                title: "Invitar Afiliados",
                                view: "invite-affiliates",
                                program: this.affiliateProgram,
                            },
                            this.drawerCallback
                        );
                    },
                },
                {
                    name: "Eventos Frontend",
                    icon: "fas fa-desktop",
                    event: () => {
                        this.openDrawer(
                            DocumentationDialog,
                            {
                                title: "Eventos Frontend",
                                view: "frontend-events",
                                program: this.affiliateProgram,
                            },
                            this.drawerCallback
                        );
                    },
                },
                {
                    name: "Eventos Backend",
                    icon: "fas fa-server",
                    event: () => {
                        this.openDrawer(
                            DocumentationDialog,
                            {
                                title: "Eventos Backend",
                                view: "backend-events",
                                program: this.affiliateProgram,
                            },
                            this.drawerCallback
                        );
                    },
                },
                {
                    name: "Eventos Locales",
                    icon: "fas fa-map-marker-alt",
                    event: () => {
                        this.openDrawer(
                            DocumentationDialog,
                            {
                                title: "Eventos Locales",
                                view: "local-events",
                                program: this.affiliateProgram,
                            },
                            this.drawerCallback
                        );
                    },
                },
            ];
        },
    },
    methods: {
        drawerCallback({ event }) {
            console.log(event);
        },
    },
};
</script>

<style scoped>
/* Estilo para botones y elementos minimalistas */
button i {
    font-size: 1rem;
}
</style>
