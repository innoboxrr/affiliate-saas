<template>
    <div class="bg-white dark:bg-gray-800 border rounded-lg overflow-hidden border dark:border-gray-700">
        <!-- Dropdown Actions -->
        <div class="flex justify-end p-4">
            <dropdown-button-component
                :items="[
                    {
                        type: 'router',
                        to: {
                            name: 'AdminShowAffiliateProgram',
                            params: { id: affiliateProgram.id },
                        },
                        label: 'Mostrar',
                    },
                    {
                        type: 'router',
                        to: {
                            name: 'AdminEditAffiliateProgram',
                            params: { id: affiliateProgram.id },
                        },
                        label: 'Editar',
                    },
                    {
                        type: 'event',
                        action: deleteAffiliateProgram,
                        label: 'Eliminar',
                    },
                ]"
            />
        </div>

        <div class="flex flex-col items-center px-6 pb-8">
            <div class="w-28 h-28 mb-4 rounded-full shadow-md flex items-center justify-center bg-gray-200 dark:bg-gray-600 text-gray-400 text-2xl">
                <i class="fas fa-bullhorn"></i>
            </div>

            <h5 class="text-lg font-semibold text-gray-900 dark:text-white text-center">
                {{ affiliateProgram.name }}
            </h5>

            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center">
                {{ affiliateProgram.description || 'Sin descripción' }}
            </p>

            <p class="mt-4 text-sm text-gray-600 dark:text-gray-300">
                Comisión: {{ affiliateProgram.payload.default_commission }}%
            </p>
        </div>
    </div>
</template>

<script>
import { deleteModel } from '@affiliateModels/affiliate-program'

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
    created() {
        if (!this.affiliateProgram && !this.affiliateProgramId) {
            console.error("Se debe proporcionar 'affiliateProgram' o 'affiliateProgramId'.");
        }
    },
    methods: {
        deleteAffiliateProgram() {
            deleteModel(this.affiliateProgram).then(() => {
                this.$router.push({ name: 'AdminAffiliatePrograms' });
            });
        },
    },
}
</script>
