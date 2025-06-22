<template>
    <div class="bg-white dark:bg-gray-800 border rounded-lg overflow-hidden border dark:border-gray-700">
        <!-- Dropdown Actions -->
        <div class="flex justify-end p-4">
            <dropdown-button-component
                :items="[
                    {
                        type: 'router',
                        to: {
                            name: 'AdminShowAffiliateAsset',
                            params: { id: affiliateAsset.id },
                        },
                        label: 'Mostrar',
                    },
                    {
                        type: 'router',
                        to: {
                            name: 'AdminEditAffiliateAsset',
                            params: { id: affiliateAsset.id },
                        },
                        label: 'Editar',
                    },
                    {
                        type: 'event',
                        action: deleteAffiliateAsset,
                        label: 'Eliminar',
                    },
                ]"
            />
        </div>

        <!-- Content -->
        <div class="flex flex-col items-center px-6 pb-8">
            <div class="w-28 h-28 mb-4 rounded-full shadow-md flex items-center justify-center bg-gray-200 dark:bg-gray-600 text-gray-400 text-2xl">
                <i class="fas fa-link"></i>
            </div>

            <h5 class="text-lg font-semibold text-gray-900 dark:text-white text-center">
                {{ affiliateAsset.name }}
            </h5>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center capitalize">
                Tipo: {{ affiliateAsset.type }}
            </p>

            <a
                :href="affiliateAsset.asset_url"
                target="_blank"
                class="mt-4 text-sm text-blue-600 hover:text-blue-800 dark:text-blue-300 dark:hover:text-blue-400 underline">
                Ver recurso
            </a>
        </div>
    </div>
</template>

<script>
import { deleteModel } from '@affiliateModels/affiliate-asset'

export default {
    props: {
        affiliateAsset: {
            type: Object,
            required: false,
        },
        affiliateAssetId: {
            type: [Number, String],
            required: false,
        },
    },
    created() {
        if (!this.affiliateAsset && !this.affiliateAssetId) {
            console.error("Se debe proporcionar 'affiliateAsset' o 'affiliateAssetId'.");
        }
    },
    methods: {
        deleteAffiliateAsset() {
            deleteModel(this.affiliateAsset).then(() => {
                this.$router.push({ name: 'AdminAffiliateAssets' });
            });
        },
    },
}
</script>
