<template>
    <div v-if="dataLoaded" class="space-y-6">
        <div class="border rounded-xl shadow-sm p-6 bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center border-b pb-4 mb-6 dark:border-gray-600">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ affiliateAsset.name }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">
                        Tipo de recurso: {{ affiliateAsset.type }}
                    </p>
                </div>
                <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    ID: {{ affiliateAsset.id }}
                </span>
            </div>

            <dl class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">URL del recurso</dt>
                    <dd class="mt-1 text-sm">
                        <a
                            :href="affiliateAsset.asset_url"
                            target="_blank"
                            class="text-blue-600 hover:underline dark:text-blue-300 dark:hover:text-blue-400">
                            Abrir recurso
                        </a>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Programa Afiliado ID</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliateAsset.affiliate_program_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Creado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ formatDate(affiliateAsset.created_at, 'LLL') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Actualizado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ formatDate(affiliateAsset.updated_at, 'LLL') }}</dd>
                </div>
            </dl>
        </div>
		<div class="border rounded-xl shadow-sm p-6 bg-white dark:bg-gray-800 dark:border-gray-700">
			<div>
				<dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">Notas de uso</dt>
				<dd 
					class="mt-1 text-sm text-gray-900 dark:text-white" 
					v-html="affiliateAsset.payload.usage_notes"></dd>
			</div>
		</div>
    </div>
</template>

<script>
import { showModel } from '@affiliateModels/affiliate-asset'

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
    data() {
        return {
            dataLoaded: false,
        }
    },
    created() {
        if (!this.affiliateAsset && !this.affiliateAssetId) {
            console.error("Se debe proporcionar 'affiliateAsset' o 'affiliateAssetId'.")
        }
    },
    mounted() {
        if (!this.affiliateAsset && this.affiliateAssetId) {
            this.fetchAffiliateAsset()
        } else {
            this.dataLoaded = true
        }
    },
    methods: {
        async fetchAffiliateAsset() {
            const res = await showModel(this.affiliateAssetId)
            this.affiliateAsset = res
            this.dataLoaded = true
        },
    },
}
</script>
