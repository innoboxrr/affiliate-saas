<template>

	<form :id="formId" @submit.prevent="onSubmit">

        <!-- INFORMACIÓN GENERAL -->
        <div class="border rounded-md mb-6">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.general = !collapsed.general">
                <span class="text-sm font-semibold">Información General</span>
                <i :class="['fa-solid', collapsed.general ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.general" class="p-4 space-y-4">
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

                <textarea-input-component
                    :custom-class="inputClass"
                    name="description"
                    label="Descripción"
                    placeholder="Explicación del programa"
                    :min_length="3"
                    validators="length"
                    v-model="affiliateProgram.description"
                />
            </div>
        </div>

        <!-- CONFIGURACIÓN TÉCNICA -->
        <div class="border rounded-md">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.tech = !collapsed.tech">
                <span class="text-sm font-semibold">Configuración Técnica</span>
                <i :class="['fa-solid', collapsed.tech ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.tech" class="p-4 space-y-4">
                <select-input-component
                    :custom-class="inputClass"
                    name="test_mode"
                    label="Modo prueba"
                    v-model="affiliateProgram.payload.test_mode">
                    <option :value="true">Sí</option>
                    <option :value="false">No</option>
                </select-input-component>

                <select-input-component
                    :custom-class="inputClass"
                    name="tracking_model"
                    label="Modelo de Tracking"
                    v-model="affiliateProgram.payload.tracking_model">
                    <option value="first_click">Primer click</option>
                    <option value="last_click">Último click</option>
                </select-input-component>

                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="cookie_path"
                    label="Ruta de la cookie"
                    placeholder="Ej. https://tu-sitio.com"
                    validators="required"
                    v-model="affiliateProgram.payload.cookie_path"
                />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="cookie_lifetime"
                    label="Tiempo de vida de la cookie (días)"
                    help="El tiempo en días que la cookie permanecerá activa. Cero significa que no expira."
                    placeholder="Ej. 30"
                    validators="required"
                    v-model="affiliateProgram.payload.cookie_lifetime"
                />

                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="default_commission"
                    label="Comisión por defecto (%)"
                    placeholder="Ej. 10"
                    validators="required decimal"
                    v-model="affiliateProgram.payload.default_commission"
                />
            </div>
        </div>

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Crear"
        />
        
    </form>
</template>

<script>

import { createModel } from '@affiliateModels/affiliate-program'
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
            default: 'createAffiliateProgramForm',
        }
    },

    emits: ['submit'],

    data() {
        return {
            disabled: false,
            JSValidator: undefined,
            collapsed: {
                general: false,
                tech: false
            },
            affiliateProgram: {
                name: '',
                description: '',
                payload: {
                    test_mode: false,
                    tracking_model: '',
                    cookie_path: '',
                    cookie_lifetime: '',
                    default_commission: ''
                },
            }
        }
    },

    mounted() {
        this.JSValidator = new JSValidator(this.formId).init();
    },

    methods: {

        onSubmit() {
            if(this.JSValidator.status) {
                this.disabled = true;
                createModel({
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
