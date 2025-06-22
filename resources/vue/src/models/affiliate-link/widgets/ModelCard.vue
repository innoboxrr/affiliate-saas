<template>
    <div class="bg-white dark:bg-gray-800 border rounded-lg overflow-hidden border dark:border-gray-700">
        <!-- Dropdown Actions -->
        <div class="flex justify-end p-4">
            <dropdown-button-component
                :items="[
                    {
                        type: 'router',
                        to: {
                            name: 'AdminShowAffiliateLink',
                            params: { id: affiliateLink.id },
                        },
                        label: 'Mostrar',
                    },
                    {
                        type: 'router',
                        to: {
                            name: 'AdminEditAffiliateLink',
                            params: { id: affiliateLink.id },
                        },
                        label: 'Editar',
                    },
                    {
                        type: 'event',
                        action: deleteAffiliateLink,
                        label: 'Eliminar',
                    },
                ]"
            />
        </div>

        <!-- Card Content -->
        <div class="flex flex-col items-center px-6 pb-8">
            <div class="w-28 h-28 mb-4 rounded-full shadow-md flex items-center justify-center bg-gray-200 dark:bg-gray-600 text-gray-400 text-2xl">
                <i class="fas fa-link"></i>
            </div>

            <h5 class="text-lg font-semibold text-gray-900 dark:text-white text-center">
                {{ affiliateLink.name }}
            </h5>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                Código: <code>{{ affiliateLink.code }}</code>
            </p>

            <!-- Clipboard Link -->
            <div class="w-full text-center mt-4">
                <clipboard-input 
                    :value="registerLink" 
                    class="block w-full text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-300 dark:hover:text-blue-400" />
            </div>

            <!-- Botones -->
            <div class="mt-6 flex space-x-4">
                <router-link
                    :to="{
                        name: 'AdminEditAffiliateLink',
                        params: { id: affiliateLink.id },
                    }"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-800 hover:text-white">
                    <i class="fas fa-pen mr-2"></i>
                    Editar
                </router-link>
                <button
                    @click="deleteAffiliateLink"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-900">
                    <i class="fas fa-trash mr-2"></i>
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { deleteModel } from '@affiliateModels/affiliate-link'

export default {
    props: {
        affiliateLink: {
            type: Object,
            required: true,
        },
    },
    computed: {
        registerLink() {
            const base = this.affiliateLink.program?.payload?.cookie_path;

			// Añadir parametro pero ver si ya tiene o no, añadirlo de una manera correcta
			const separator = base.includes('?') ? '&' : '?';
			return `${base}${separator}sp-aff=${this.affiliateLink.code}`;

        },
    },
    methods: {
        deleteAffiliateLink() {
            deleteModel(this.affiliateLink).then(() => {
                this.$router.push({ name: 'AdminAffiliateLinks' });
            });
        },
    },
}
</script>
