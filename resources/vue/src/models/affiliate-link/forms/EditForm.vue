<template>
    <form :id="formId" @submit.prevent="onSubmit">

        <!-- Nombre del enlace -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre del enlace"
            placeholder="Nombre del enlace"
            validators="required length"
            :min_length="3"
            v-model="affiliateLink.name" />

        <!-- Código personalizado -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="code"
            label="Código"
            placeholder="Ej. summer-campaign"
            validators="required length"
            :min_length="3"
            v-model="affiliateLink.code" />

        <!-- Enlace destino -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="target"
            label="Enlace destino"
            placeholder="https://..."
            validators="required url"
            v-model="affiliateLink.target" />

        <!-- Token del servidor -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Token del servidor
            </label>
            <div class="flex items-center space-x-2">
                <clipboard-input
                    :value="affiliateLink.server_token"
                    class="block w-full text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-300 dark:hover:text-blue-400"
                />
                <button
                    type="button"
                    @click="regenerateToken"
                    class="text-sm px-3 py-2 text-grey-600 rounded focus:ring-2 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900">
                    <i class="fas fa-sync-alt mr-1 text-lg"></i> 
                </button>
            </div>
        </div>

        <!-- Botón de actualizar -->
        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />

    </form>
</template>

<script>
import { showModel, updateModel } from '@affiliateModels/affiliate-link'
import JSValidator from 'innoboxrr-js-validator'
import {
    TextInputComponent,
    ButtonComponent,
} from 'innoboxrr-form-elements'


export default {
    components: {
        TextInputComponent,
        ButtonComponent
    },
    props: {
        formId: {
            type: String,
            default: 'editAffiliateLinkForm'
        },
        affiliateLinkId: {
            type: [Number, String],
            required: true
        },
    },
    emits: ['submit'],
    data() {
        return {
            affiliateLink: {
                name: '',
                code: '',
                target: '',
                server_token: ''
            },
            disabled: false,
            JSValidator: undefined
        }
    },
    mounted() {
        this.fetchAffiliateLink();
        this.JSValidator = new JSValidator(this.formId).init();
        this.JSValidator.status = true;
    },
    methods: {
        fetchAffiliateLink() {
            showModel(this.affiliateLinkId).then(res => {
                this.affiliateLink = res;
            });
        },
        onSubmit() {
            if (this.JSValidator.status) {
                this.disabled = true;
                updateModel(this.affiliateLink.id, {
                    name: this.affiliateLink.name,
                    code: this.affiliateLink.code,
                    target: this.affiliateLink.target,
                    server_token: this.affiliateLink.server_token
                }).then(res => {
                    this.$emit('submit', res);
                    setTimeout(() => {
                        this.disabled = false;
                    }, 2500);
                }).catch(error => {
                    this.disabled = false;
                    if (error.response.status === 422) {
                        this.JSValidator.appendExternalErrors(error.response.data.errors);
                    }
                });
            } else {
                this.disabled = false;
            }
        },
        regenerateToken() {
            // Cadena de 64 caracteres alfanuméricos
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let uuid = '';
            for (let i = 0; i < 64; i++) {
                uuid += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            // Asignar el nuevo token al modelo
            this.affiliateLink.server_token = uuid;
        }
    }
}
</script>