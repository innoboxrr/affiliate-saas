<template>
    <div v-if="dataLoaded" class="space-y-4">
        <div class="border rounded-xl shadow-sm p-8 bg-white dark:bg-gray-800 dark:border-gray-700">
            <!-- Encabezado -->
            <div class="flex justify-between items-start border-b pb-6 mb-8 dark:border-gray-600">
                <div class="space-y-2">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Click #{{ affiliateClick.id }}
                    </h2>
                    <p class="text-sm text-red-500">
                        UUID: <code>{{ affiliateClick.uuid }}</code>
                    </p>
                </div>
                <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    ID: {{ affiliateClick.id }}
                </span>
            </div>

            <!-- Detalles -->
            <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">IP</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ affiliateClick.ip_address }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">User Agent</dt>
                    <dd class="text-sm text-gray-900 dark:text-white">{{ affiliateClick.user_agent }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Referrer</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ affiliateClick.referrer || 'No disponible' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">URL</dt>
                    <dd class="text-base">
                        <a
                            :href="affiliateClick.url"
                            target="_blank"
                            class="text-blue-600 hover:underline dark:text-blue-300 dark:hover:text-blue-400"
                        >
                            Ver página
                        </a>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Enlace afiliado ID</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ affiliateClick.affiliate_link_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Creado</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ formatDate(affiliateClick.created_at, 'LLL') }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Actualizado</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ formatDate(affiliateClick.updated_at, 'LLL') }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</template>

<script>
import { showModel } from '@affiliateModels/affiliate-click'

export default {
    props: {
        affiliateClick: {
            type: Object,
            required: false,
        },
        affiliateClickId: {
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
        if (!this.affiliateClick && !this.affiliateClickId) {
            console.error("Se debe proporcionar 'affiliateClick' o 'affiliateClickId'.")
        }
    },
    mounted() {
        if (!this.affiliateClick && this.affiliateClickId) {
            this.fetchAffiliateClick()
        } else {
            this.dataLoaded = true
        }
    },
    methods: {
        async fetchAffiliateClick() {
            const res = await showModel(this.affiliateClickId)
            this.affiliateClick = res
            this.dataLoaded = true
        },
    },
}
</script>
