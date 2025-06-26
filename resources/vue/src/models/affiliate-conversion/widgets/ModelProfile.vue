<template>
    <div v-if="dataLoaded" class="space-y-4">
        <div class="border rounded-xl shadow-sm p-8 bg-white dark:bg-gray-800 dark:border-gray-700">
            <!-- Encabezado -->
            <div class="flex justify-between items-start border-b pb-6 mb-8 dark:border-gray-600">
                <div class="space-y-2">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Conversión #{{ affiliateConversion.id }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Evento: <strong>{{ affiliateConversion.event_type }}</strong>
                    </p>
                </div>
                <span
                    class="text-xs px-3 py-1 rounded-full font-medium capitalize"
                    :class="{
                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': affiliateConversion.status === 'approved',
                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': affiliateConversion.status === 'pending',
                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': affiliateConversion.status === 'rejected',
                    }"
                >
                    {{ affiliateConversion.status }}
                </span>
            </div>

            <!-- Detalles -->
            <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Monto</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ affiliateConversion.amount }} {{ affiliateConversion.currency }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Comisión</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ affiliateConversion.commission }} {{ affiliateConversion.currency }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">¿Es test?</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ affiliateConversion.is_test ? 'Sí' : 'No' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Enlace afiliado ID</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ affiliateConversion.affiliate_link_id || '—' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Click ID</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ affiliateConversion.affiliate_click_id || '—' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Aprobado en</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ formatDate(affiliateConversion.approved_at, 'LLL') || '—' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Creado</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ formatDate(affiliateConversion.created_at, 'LLL') }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Actualizado</dt>
                    <dd class="text-base text-gray-900 dark:text-white">
                        {{ formatDate(affiliateConversion.updated_at, 'LLL') }}
                    </dd>
                </div>
            </dl>
        </div>
		<div class="border rounded-xl shadow-sm p-4 bg-white dark:bg-gray-800 dark:border-gray-700">
			<p class="text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1">Payload</p>
			<dd class="text-sm text-gray-900 dark:text-white whitespace-pre-wrap break-words">
				<pre class="text-xs whitespace-pre-wrap bg-gray-800 text-blue-100 p-4 rounded-lg">{{ JSON.stringify(affiliateConversion.payload, null, 2) }}</pre>
			</dd>
		</div>
    </div>
</template>

<script>
import { showModel } from '@affiliateModels/affiliate-conversion'

export default {
    props: {
        affiliateConversion: {
            type: Object,
            required: false,
        },
        affiliateConversionId: {
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
        if (!this.affiliateConversion && !this.affiliateConversionId) {
            console.error("Se debe proporcionar 'affiliateConversion' o 'affiliateConversionId'.")
        }
    },
    mounted() {
        if (!this.affiliateConversion && this.affiliateConversionId) {
            this.fetchAffiliateConversion()
        } else {
            this.dataLoaded = true
        }
    },
    methods: {
        async fetchAffiliateConversion() {
            const res = await showModel(this.affiliateConversionId)
            this.affiliateConversion = res
            this.dataLoaded = true
        }
    }
}
</script>
