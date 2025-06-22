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
            v-model="affiliateClick.affiliate_id" />

        <!-- URL de destino -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="url"
            label="URL destino"
            placeholder="https://..."
            validators="required url"
            v-model="affiliateClick.url" />

        <!-- IP -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="ip"
            label="Dirección IP"
            placeholder="IP"
            v-model="affiliateClick.ip" />

        <!-- User Agent -->
        <textarea-input-component
            :custom-class="inputClass"
            name="user_agent"
            label="User Agent"
            placeholder="Agente del navegador"
            v-model="affiliateClick.user_agent" />

        <!-- Referer -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="referer"
            label="Referer"
            placeholder="Referer"
            v-model="affiliateClick.referer" />

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />
        
    </form>
</template>

<script>

import { showModel, updateModel } from '@affiliateModels/affiliate-click'
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
            default: 'editAffiliateClickForm'
        },
        affiliateClickId: {
            type: [Number, String],
            required: true
        }
    },

    emits: ['submit'],

    data() {
        return {
            affiliateClick: {
                affiliate_id: '',
                url: '',
                ip: '',
                user_agent: '',
                referer: ''
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
            this.fetchAffiliateClick();
        },

        fetchAffiliateClick() {
            showModel(this.affiliateClickId).then(res => {
                this.affiliateClick = res;
            });
        },

        onSubmit() {
            if(this.JSValidator.status) {
                this.disabled = true;
                updateModel(this.affiliateClick.id, {
                    affiliate_id: this.affiliateClick.affiliate_id,
                    url: this.affiliateClick.url,
                    ip: this.affiliateClick.ip,
                    user_agent: this.affiliateClick.user_agent,
                    referer: this.affiliateClick.referer
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
