<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- Nombre -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre"
            placeholder="Nombre del afiliado"
            validators="required length"
            :min_length="3"
            v-model="affiliate.payload.name" />

        <!-- Email -->
        <text-input-component
            :custom-class="inputClass"
            type="email"
            name="email"
            label="Correo Electrónico"
            placeholder="ejemplo@correo.com"
            validators="required email"
            v-model="affiliate.payload.email" />

        <!-- Teléfono -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="phone"
            label="Teléfono"
            placeholder="Número telefónico"
            v-model="affiliate.payload.phone" />

        <!-- Dirección -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="address"
            label="Dirección"
            placeholder="Dirección física"
            v-model="affiliate.payload.address" />

        <!-- Ciudad -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="city"
            label="Ciudad"
            placeholder="Ciudad"
            v-model="affiliate.payload.city" />

        <!-- Estado -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="state"
            label="Estado"
            placeholder="Estado"
            v-model="affiliate.payload.state" />

        <!-- País -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="country"
            label="País"
            placeholder="País"
            v-model="affiliate.payload.country" />

        <!-- Código Postal -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="zip"
            label="Código Postal"
            placeholder="Ej. 12345"
            v-model="affiliate.payload.zip" />

        <!-- Sitio Web -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="website"
            label="Sitio Web"
            placeholder="https://"
            validators="url"
            v-model="affiliate.payload.website" />

        <!-- Redes Sociales -->
        <text-input-component :custom-class="inputClass" name="facebook" label="Facebook" placeholder="https://" validators="url" v-model="affiliate.payload.facebook" />
        <text-input-component :custom-class="inputClass" name="twitter" label="Twitter" placeholder="https://" validators="url" v-model="affiliate.payload.twitter" />
        <text-input-component :custom-class="inputClass" name="instagram" label="Instagram" placeholder="https://" validators="url" v-model="affiliate.payload.instagram" />
        <text-input-component :custom-class="inputClass" name="linkedin" label="LinkedIn" placeholder="https://" validators="url" v-model="affiliate.payload.linkedin" />
        <text-input-component :custom-class="inputClass" name="youtube" label="YouTube" placeholder="https://" validators="url" v-model="affiliate.payload.youtube" />
        <text-input-component :custom-class="inputClass" name="tiktok" label="TikTok" placeholder="https://" validators="url" v-model="affiliate.payload.tiktok" />

        <!-- Método de Pago -->
        <text-input-component
            :custom-class="inputClass"
            name="payment_method"
            label="Método de Pago"
            placeholder="Ej. PayPal, Transferencia"
            v-model="affiliate.payload.payment_method" />

        <!-- Datos de Pago -->
        <textarea-input-component
            :custom-class="inputClass"
            name="payment_data"
            label="Datos de Pago"
            placeholder="Datos detallados para el pago"
            v-model="affiliate.payload.payment_data" />

        <!-- Tipo de Afiliado -->
        <text-input-component
            :custom-class="inputClass"
            name="affiliate_type"
            label="Tipo de Afiliado"
            placeholder="Ej. Influencer, Empresa"
            v-model="affiliate.payload.affiliate_type" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />
        
    </form>

</template>

<script>

import { showModel, updateModel } from '@affiliateModels/affiliate'
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
            default: 'editAffiliateForm'
        },
        affiliateId: {
            type: [Number, String],
            required: true
        }
    },

    emits: ['submit'],

    data() {
        return {
            affiliate: {
                payload: {}
            },
            disabled: false,
            JSValidator: undefined,
        }
    },

    mounted() {
        this.fetchData(); 
        this.JSValidator = new JSValidator(this.formId).init();
        this.JSValidator.status = true;
    },

    methods: {

        fetchData() {
            showModel(this.affiliateId).then(res => {
                this.affiliate = res;
            });
        },

        onSubmit() {
            if (this.JSValidator.status) {
                this.disabled = true;
                updateModel(this.affiliate.id, {
                    payload: this.affiliate.payload
                }).then(res => {
                    this.$emit('submit', res);
                    setTimeout(() => { this.disabled = false; }, 2500);
                }).catch(error => {
                    this.disabled = false;
                    if (error.response.status == 422)
                        this.JSValidator.appendExternalErrors(error.response.data.errors);
                });
            } else {
                this.disabled = false;
            }
        }
    }
}
</script>
