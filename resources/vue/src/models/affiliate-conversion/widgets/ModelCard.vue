<template>
    <div class="bg-white dark:bg-gray-800 border rounded-lg overflow-hidden border dark:border-gray-700">
        <!-- Dropdown Actions -->
        <div class="flex justify-end p-4">
            <dropdown-button-component
                :items="[                
                    {
                        type: 'router',
                        to: {
                            name: 'AdminShowAffiliateConversion',
                            params: { id: affiliateConversion.id },
                        },
                        label: 'Mostrar',
                    },
                    {
                        type: 'router',
                        to: {
                            name: 'AdminEditAffiliateConversion',
                            params: { id: affiliateConversion.id },
                        },
                        label: 'Editar',
                    },
                    {
                        type: 'event',
                        action: deleteAffiliateConversion,
                        label: 'Eliminar',
                    },
                ]"
            />
        </div>

        <!-- Card Content -->
        <div class="flex flex-col items-center px-6 pb-8">
            <!-- Icono -->
            <div class="w-28 h-28 mb-4 rounded-full shadow-md flex items-center justify-center bg-green-200 dark:bg-green-600 text-white text-2xl">
                <i class="fas fa-dollar-sign"></i>
            </div>

            <!-- Título -->
            <h5 class="text-lg font-semibold text-gray-900 dark:text-white text-center">
                Conversión #{{ affiliateConversion.id }}
            </h5>

            <!-- Detalles -->
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                {{ affiliateConversion.amount }} {{ affiliateConversion.currency }} · {{ affiliateConversion.event_type }}
            </p>

            <!-- Estado -->
            <span
                class="mt-2 text-xs px-3 py-1 rounded-full capitalize font-medium"
                :class="{
                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': affiliateConversion.status === 'approved',
                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': affiliateConversion.status === 'pending',
                    'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': affiliateConversion.status === 'rejected',
                }"
            >
                {{ affiliateConversion.status }}
            </span>

            <!-- Botones -->
            <div class="mt-6 flex space-x-4">
                <router-link
                    :to="{
                        name: 'AdminEditAffiliateConversion',
                        params: { id: affiliateConversion.id },
                    }"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-800 hover:text-white">
                    <i class="fas fa-pen mr-2"></i>
                    Editar
                </router-link>
                <button
                    @click="deleteAffiliateConversion"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-900">
                    <i class="fas fa-trash mr-2"></i>
                    Eliminar
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { deleteModel } from '@affiliateModels/affiliate-conversion'

export default {
    props: {
        affiliateConversion: {
            type: Object,
            required: true,
        },
    },
    methods: {
        deleteAffiliateConversion() {
            deleteModel(this.affiliateConversion).then(() => {
                this.$router.push({ name: 'AdminAffiliateConversions' });
            });
        },
    },
}
</script>
