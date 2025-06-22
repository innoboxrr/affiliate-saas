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
            v-model="affiliatePayout.affiliate_id" />

        <!-- Monto -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="amount"
            label="Monto"
            placeholder="0.00"
            validators="required decimal"
            v-model="affiliatePayout.amount" />

        <!-- Divisa -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="currency"
            label="Divisa"
            placeholder="Ej. USD, MXN"
            v-model="affiliatePayout.currency" />

        <!-- Método de pago -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="payment_method"
            label="Método de Pago"
            placeholder="Transferencia, PayPal, etc."
            v-model="affiliatePayout.payment_method" />

        <!-- Referencia -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="payment_reference"
            label="Referencia de Pago"
            placeholder="ID o número de transacción"
            v-model="affiliatePayout.payment_reference" />

        <!-- Notas -->
        <textarea-input-component
            :custom-class="inputClass"
            name="notes"
            label="Notas"
            placeholder="Observaciones o detalles adicionales"
            v-model="affiliatePayout.notes" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />
        
    </form>

</template>

<script>

import { createModel } from '@affiliateModels/affiliate-payout'
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
            default: 'createAffiliatePayoutForm',
        }
    },

    emits: ['submit'],

    data() {
        return {
            disabled: false,
            JSValidator: undefined,
            affiliatePayout: {
                affiliate_id: '',
                amount: '',
                currency: '',
                payment_method: '',
                payment_reference: '',
                notes: ''
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
                    affiliate_id: this.affiliatePayout.affiliate_id,
                    amount: this.affiliatePayout.amount,
                    currency: this.affiliatePayout.currency,
                    payment_method: this.affiliatePayout.payment_method,
                    payment_reference: this.affiliatePayout.payment_reference,
                    notes: this.affiliatePayout.notes
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
