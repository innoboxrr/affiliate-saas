<template>
	
	<form :id="formId" @submit.prevent="onSubmit">      

        <!-- Nombre del programa -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre del Programa"
            placeholder="Ej. Programa de Influencers"
            validators="required length"
            :min_length="3"
            v-model="affiliateProgram.name" />

        <!-- Descripción -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Explicación del programa"
            :min_length="3"
            validators="length"
            v-model="affiliateProgram.description" />

        <!-- Comisión (%) -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="commission"
            label="Comisión (%)"
            placeholder="Ej. 10"
            validators="required decimal"
            v-model="affiliateProgram.commission" />

        <!-- Código -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="slug"
            label="Código del programa"
            placeholder="Ej. influencers2025"
            v-model="affiliateProgram.slug" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear" />
        
    </form>
</template>

<script>

import { createModel } from '@affiliateModels/affiliate-program'
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
            default: 'createAffiliateProgramForm',
        }
    },

    emits: ['submit'],

    data() {
        return {
            disabled: false,
            JSValidator: undefined,
            affiliateProgram: {
                name: '',
                description: '',
                commission: '',
                slug: ''
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
                    name: this.affiliateProgram.name,
                    description: this.affiliateProgram.description,
                    commission: this.affiliateProgram.commission,
                    slug: this.affiliateProgram.slug
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
