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
            v-model="affiliateProgram.name"
        />

        <!-- Descripción -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Explicación del programa"
            :min_length="3"
            validators="length"
            v-model="affiliateProgram.description"
        />

        <!-- Activar modo prueba -->
        <select-input-component
            :custom-class="inputClass"
            name="test_mode"
            label="Modo prueba"
            v-model="affiliateProgram.payload.test_mode">
            <option :value="true">Sí</option>
            <option :value="false">No</option>
        </select-input-component>

        <!-- Modelo de tracking -->
        <select-input-component
            :custom-class="inputClass"
            name="tracking_model"
            label="Modelo de Tracking"
            v-model="affiliateProgram.payload.tracking_model">
            <option value="first_click">Primer click</option>
            <option value="last_click">Último click</option>
        </select-input-component>

        <!-- Tiempo de vida de la cookie -->
        <text-input-component
            :custom-class="inputClass"
            type="number"
            name="cookie_lifetime"
            label="Tiempo de vida de la cookie (días)"
            placeholder="Ej. 30"
            validators="required"
            v-model="affiliateProgram.payload.cookie_lifetime"
        />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar"
        />
        
    </form>
</template>

<script>

import { showModel, updateModel } from '@affiliateModels/affiliate-program'
import JSValidator from 'innoboxrr-js-validator'
import {
    TextInputComponent,
    TextareaInputComponent,
    SelectInputComponent,
    ButtonComponent
} from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
        ButtonComponent
    },

    props: {
        formId: {
            type: String,
            default: 'editAffiliateProgramForm',
        },
        affiliateProgramId: {
            type: [Number, String],
            required: true
        }
    },

    emits: ['submit'],

    data() {
        return {
            disabled: false,
            JSValidator: undefined,
            workspaceRoute: route('api.workspace.index'),
            affiliateProgram: {
                name: '',
                description: '',
                payload: {
                    test_mode: false,
                    tracking_model: '',
                    cookie_lifetime: ''
                },
            }
        }
    },

    mounted() {
        this.fetchData();
        this.JSValidator = new JSValidator(this.formId).init();
        this.JSValidator.status = true;
    },

    methods: {

        fetchData() {
            showModel(this.affiliateProgramId).then(res => {
                this.affiliateProgram = res;
            });
        },

        onSubmit() {
            if(this.JSValidator.status) {
                this.disabled = true;
                updateModel(this.affiliateProgram.id, {
                    name: this.affiliateProgram.name,
                    description: this.affiliateProgram.description,
                    ...this.affiliateProgram.payload
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
