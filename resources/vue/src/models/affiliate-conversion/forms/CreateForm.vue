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
            v-model="affiliateConversion.affiliate_id" />

        <!-- Monto -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="amount"
            label="Monto"
            placeholder="0.00"
            validators="required decimal"
            v-model="affiliateConversion.amount" />

        <!-- Divisa -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="currency"
            label="Divisa"
            placeholder="Ej. USD, MXN"
            v-model="affiliateConversion.currency" />

        <!-- Referencia externa -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="external_reference"
            label="Referencia externa"
            placeholder="ID externo u orden"
            v-model="affiliateConversion.external_reference" />

        <!-- Descripción -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Detalle adicional o contexto"
            v-model="affiliateConversion.description" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />
        
    </form>

</template>

<script>

import { createModel } from '@affiliateModels/affiliate-conversion'
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
            default: 'createAffiliateConversionForm',
        }
    },

    emits: ['submit'],

    data() {
        return {
            disabled: false,
            JSValidator: undefined,
            affiliateConversion: {
                affiliate_id: '',
                amount: '',
                currency: '',
                external_reference: '',
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
                    affiliate_id: this.affiliateConversion.affiliate_id,
                    amount: this.affiliateConversion.amount,
                    currency: this.affiliateConversion.currency,
                    external_reference: this.affiliateConversion.external_reference,
                    description: this.affiliateConversion.description
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
