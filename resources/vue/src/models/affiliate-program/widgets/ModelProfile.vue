<template>
    <div v-if="dataLoaded" class="space-y-6">
        <div class="border rounded-xl shadow-sm p-6 bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center border-b pb-4 mb-6 dark:border-gray-600">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ affiliateProgram.name }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ affiliateProgram.description || 'Sin descripción disponible' }}
                    </p>
                </div>
                <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    ID: {{ affiliateProgram.id }}
                </span>
            </div>

            <dl class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Modo de Prueba</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliateProgram.payload.test_mode ? 'Activo' : 'Inactivo' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Modelo de Tracking</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliateProgram.payload.tracking_model }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Duración de Cookie</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliateProgram.payload.cookie_lifetime }} días</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Comisión Predeterminada</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliateProgram.payload.default_commission }}%</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Creado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ formatDate(affiliateProgram.created_at, 'LLL') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Actualizado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ formatDate(affiliateProgram.updated_at, 'LLL') }}</dd>
                </div>
            </dl>
        </div>

        <!-- TOKEN DEL SERVIDOR -->
        <div class="border rounded-xl shadow-sm p-6 bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Program token
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Este es el token del programa de afiliados que se utiliza para autenticar las solicitudes desde el servidor. Asegúrate de mantenerlo seguro y no compartirlo públicamente.
                </p>
            </div>

            <div class="relative rounded-md shadow-sm">
                <clipboard-input
                    :value="affiliateProgram.server_token"
                    class="w-full pr-12 text-sm text-gray-700 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 rounded-md py-2 px-3"
                />
            </div>
        </div>
    </div>
</template>

<script>
import { showModel } from '@affiliateModels/affiliate-program'

export default {
    props: {
        affiliateProgram: {
            type: Object,
            required: false,
        },
        affiliateProgramId: {
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
        if (!this.affiliateProgram && !this.affiliateProgramId) {
            console.error("Se debe proporcionar 'affiliateProgram' o 'affiliateProgramId'.")
        }
    },
    mounted() {
        if (!this.affiliateProgram && this.affiliateProgramId) {
            this.fetchAffiliateProgram()
        } else {
            this.dataLoaded = true
        }
    },
    methods: {
        async fetchAffiliateProgram() {
            const res = await showModel(this.affiliateProgramId)
            this.affiliateProgram = res
            this.dataLoaded = true
        },
    },
}
</script>
