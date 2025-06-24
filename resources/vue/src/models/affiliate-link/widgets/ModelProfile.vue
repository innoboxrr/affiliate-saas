<template>
    <div v-if="dataLoaded" class="space-y-4">
        <div class="border rounded-xl shadow-sm p-6 bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center border-b pb-4 mb-6 dark:border-gray-600">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ affiliateLink.name }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Código del enlace: <code>{{ affiliateLink.code }}</code>
                    </p>
                </div>
                <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    ID: {{ affiliateLink.id }}
                </span>
            </div>

            <dl class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Código único</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliateLink.code }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Destino</dt>
                    <dd class="mt-1 text-sm">
                        <a
                            :href="affiliateLink.target"
                            target="_blank"
                            class="text-blue-600 hover:underline dark:text-blue-300 dark:hover:text-blue-400">
                            Abrir enlace
                        </a>
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Afiliado ID</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliateLink.affiliate_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Programa ID</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliateLink.affiliate_program_id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Creado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ formatDate(affiliateLink.created_at, 'LLL') }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Actualizado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ formatDate(affiliateLink.updated_at, 'LLL') }}</dd>
                </div>
            </dl>
        </div>

        <!-- TOKEN DEL SERVIDOR -->
        <div class="border rounded-xl shadow-sm p-6 bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Link token
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Para enviar conversiones a este link desde un servicio externo, utiliza el siguiente token. Este token es único para cada enlace y debe ser tratado como un secreto.
                </p>
            </div>

            <div class="relative rounded-md shadow-sm">
                <clipboard-input
                    :value="affiliateLink.server_token"
                    class="w-full pr-12 text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 rounded-md py-2 px-3"
                />
            </div>
        </div>

    </div>
</template>

<script>
    import { showModel } from '@affiliateModels/affiliate-link'

    export default {
        props: {
            affiliateLink: {
                type: Object,
                required: false,
            },
            affiliateLinkId: {
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
            if (!this.affiliateLink && !this.affiliateLinkId) {
                console.error("Se debe proporcionar 'affiliateLink' o 'affiliateLinkId'.")
            }
        },
        mounted() {
            if (!this.affiliateLink && this.affiliateLinkId) {
                this.fetchAffiliateLink()
            } else {
                this.dataLoaded = true
            }
        },
        methods: {
            async fetchAffiliateLink() {
                const res = await showModel(this.affiliateLinkId)
                this.affiliateLink = res
                this.dataLoaded = true
            },
        },
    }
</script>
