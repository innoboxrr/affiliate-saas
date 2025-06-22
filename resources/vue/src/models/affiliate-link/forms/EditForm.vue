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
    ButtonComponent
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
        }
    },
    emits: ['submit'],
    data() {
        return {
            affiliateLink: {
                name: '',
                code: '',
                target: ''
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
            if(this.JSValidator.status) {
                this.disabled = true;
                updateModel(this.affiliateLink.id, {
                    name: this.affiliateLink.name,
                    code: this.affiliateLink.code,
                    target: this.affiliateLink.target
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
