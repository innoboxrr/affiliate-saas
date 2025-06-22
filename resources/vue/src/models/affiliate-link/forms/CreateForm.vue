<template>
	
	<form :id="formId" @submit.prevent="onSubmit">      

        <!-- ID del afiliado -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="affiliate_id"
            label="ID del Afiliado"
            placeholder="ID del afiliado"
            validators="required positive_integer"
            v-model="affiliateLink.affiliate_id" />

        <!-- Enlace destino -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="url"
            label="Enlace destino"
            placeholder="https://..."
            validators="required url"
            v-model="affiliateLink.url" />

        <!-- Etiqueta -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="label"
            label="Etiqueta"
            placeholder="Ej. campaña verano"
            v-model="affiliateLink.label" />

        <!-- Descripción -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Descripción o contexto del enlace"
            v-model="affiliateLink.description" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />
        
    </form>

</template>

<script>

import { createModel } from '@affiliateModels/affiliate-link'
import JSValidator from 'innoboxrr-js-validator'
import {
    TextInputComponent,
    TextareaInputComponent,
    ButtonComponent
} from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
        TextareaInputComponent,
        ButtonComponent
    },

    props: {
        formId: {
            type: String,
            default: 'createAffiliateLinkForm',
        }
    },

    emits: ['submit'],

    data() {
        return {
            disabled: false,
            JSValidator: undefined,
            affiliateLink: {
                affiliate_id: '',
                url: '',
                label: '',
                description: ''
            }
        }
    },

    mounted() {
        this.fetchData();
        this.JSValidator = new JSValidator(this.formId).init();
    },

    methods: {

        fetchData() {},

        onSubmit() {
            if(this.JSValidator.status) {
                this.disabled = true;
                createModel({
                    affiliate_id: this.affiliateLink.affiliate_id,
                    url: this.affiliateLink.url,
                    label: this.affiliateLink.label,
                    description: this.affiliateLink.description
                }).then(res => {
                    this.$emit('submit', res);
                    setTimeout(() => { this.disabled = false; }, 2500);
                }).catch(error => {
                    this.disabled = false;
                    if(error.response.status == 422)
                        this.JSValidator
                            .appendExternalErrors(error.response.data.errors);
                });
            } else {
                this.disabled = false;
            }
        }
    }
}
</script>
