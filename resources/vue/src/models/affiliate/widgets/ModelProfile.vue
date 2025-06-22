<template>
    <div class="space-y-6">
        <!-- 🧾 Detalles del Afiliado -->
        <div class="border rounded-xl shadow-sm p-6 bg-white dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-between items-center border-b pb-4 mb-6 dark:border-gray-600">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                        {{ affiliate.payload.financial.comercial_name || affiliate.payload.user.name }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ affiliate.payload.user.email || 'Sin correo registrado' }}
                    </p>
                </div>
                <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    ID: {{ affiliate.id }}
                </span>
            </div>

            <dl class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <!-- 📍 Dirección -->
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Ciudad</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.address.city || 'No especificada' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Estado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.address.state || 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">País</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.address.country || 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Código Postal</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.address.zip || 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Calle</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.address.street || 'No especificada' }}</dd>
                </div>

                <!-- 💰 Información Financiera -->
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Método de Pago</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.financial.payment_method || 'No definido' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo de Afiliado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.financial.affiliate_type || 'No definido' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">RFC / Tax ID</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.financial.tax_id || 'No especificado' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Banco</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.financial.bank_name || 'No definido' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Titular de la Cuenta</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.financial.account_holder || 'No definido' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Cuenta Bancaria</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ affiliate.payload.financial.account_number || 'No especificado' }}</dd>
                </div>

                <!-- 🌐 Enlaces -->
                <div v-for="(url, key) in affiliate.payload.links" :key="key" v-if="url">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 capitalize">{{ key }}</dt>
                    <dd class="mt-1 text-sm text-blue-600 dark:text-blue-300">
                        <a :href="url" target="_blank" class="hover:underline">{{ url }}</a>
                    </dd>
                </div>

                <!-- 🕐 Fechas -->
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Creado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ formatDate(affiliate.created_at, 'LLL') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Actualizado</dt>
                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ formatDate(affiliate.updated_at, 'LLL') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</template>

<script>
import { showModel } from '@affiliateModels/affiliate'

export default {
    props: {
        affiliate: {
            type: Object,
            required: false,
        },
        affiliateId: {
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
        if (!this.affiliate && !this.affiliateId) {
            console.error("Se debe proporcionar 'affiliate' o 'affiliateId'.")
        }
    },
    mounted() {
        if (!this.affiliate && this.affiliateId) {
            this.fetchAffiliate()
        } else {
            this.dataLoaded = true
        }
    },
    methods: {
        async fetchAffiliate() {
            const res = await showModel(this.affiliateId)
            this.affiliate = res.data
            this.dataLoaded = true
        },
    },
}
</script>
