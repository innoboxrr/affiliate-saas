<template>
    <form :id="formId" @submit.prevent="onSubmit">

        <!-- Afiliado -->
        <model-search-input-component
            v-if="!affiliateId"
            custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
            label-str="Selecciona un afiliado"
            placeholder-str="Buscar por nombre o ID"
            :route="affiliateRoute"
            q="name"
            :get-option-label="option => `${option.payload?.user?.name} (ID: ${option.id})`"
            @submit="setAffiliate" />

        <!-- Nombre del enlace -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre del enlace"
            placeholder="Nombre descriptivo"
            validators="required length"
            :min_length="3"
            v-model="affiliateLink.name" />

        <!-- Código del enlace -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="code"
            label="Código"
            placeholder="Código único del enlace"
            validators="required length"
            :min_length="3"
            v-model="affiliateLink.code" />

        <!-- Enlace destino -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="target"
            label="Enlace destino (Opcional)"
            help="Si no se especifica, se usará el destino por defecto del programa."
            placeholder="https://..."
            validators="url"
            v-model="affiliateLink.target" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />

    </form>
</template>

<script>
import { createModel } from '@affiliateModels/affiliate-link'
import { API_ROUTE_PREFIX as AFFILIATE_ROUTE_PREFIX } from '@affiliateModels/affiliate'
import JSValidator from 'innoboxrr-js-validator'
import {
    TextInputComponent,
    ButtonComponent,
    ModelSearchInputComponent
} from 'innoboxrr-form-elements'

export default {
    components: {
        TextInputComponent,
        ButtonComponent,
        ModelSearchInputComponent
    },
    props: {
        formId: {
            type: String,
            default: 'createAffiliateLinkForm'
        },
        affiliateId: {
            type: [Number, String],
            default: null
        },
    },
    emits: ['submit'],
    data() {
        return {
            disabled: false,
            JSValidator: undefined,
            affiliateRoute: route(`${AFFILIATE_ROUTE_PREFIX}index`),
            affiliateLink: {
                name: '',
                code: this.randomCode(8),
                server_token: this.randomCode(64),
                target: ''
            },
            selectedAffiliateId: this.affiliateId,
        }
    },
    mounted() {
        this.JSValidator = new JSValidator(this.formId).init();
    },
    methods: {
        setAffiliate(id) {
            this.selectedAffiliateId = id;
        },
        randomCode(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        },
        onSubmit() {
            if(this.JSValidator.status) {
                this.disabled = true;
                createModel({
                    name: this.affiliateLink.name,
                    code: this.affiliateLink.code,
                    server_token: this.affiliateLink.server_token,
                    target: this.affiliateLink.target,
                    affiliate_id: this.selectedAffiliateId,
                }).then(res => {
                    this.$emit('submit', res);
                    setTimeout(() => { this.disabled = false; }, 2500);
                }).catch(error => {
                    this.disabled = false;
                    if(error.response.status == 422)
                        this.JSValidator.appendExternalErrors(error.response.data.errors);
                });
            } else {
                this.disabled = false;
            }
        }
    }
}
</script>
