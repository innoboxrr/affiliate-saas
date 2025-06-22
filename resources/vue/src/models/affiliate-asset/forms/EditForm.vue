<template>
	
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- Nombre del activo -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="name"
            label="Nombre del activo"
            placeholder="Nombre del activo"
            validators="required length"
            :min_length="3"
            v-model="affiliateAsset.name" />

        <!-- Tipo de activo -->
        <select-input-component
            :custom-class="inputClass"
            name="type"
            label="Tipo de activo"
            validators="required"
            v-model="affiliateAsset.type">
            <option value="archivo">Archivo</option>
            <option value="imagen">Imagen</option>
            <option value="enlace">Enlace</option>
        </select-input-component>

        <!-- Descripción -->
        <textarea-input-component
            :custom-class="inputClass"
            name="description"
            label="Descripción"
            placeholder="Descripción del activo"
            v-model="affiliateAsset.description" />

        <!-- URL -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="url"
            label="URL"
            placeholder="https://..."
            validators="url"
            v-model="affiliateAsset.payload.url" />

        <!-- Archivo -->
        <div>
            <label class="uk-form-label">Archivo</label>
            <file-input-component 
                :upload-url="fileUploadUrl"
                :auto-upload="true"
                :show-top-preview="true"
                :hide-on-max-files-reached="true"
                message="Da clic o arrastra un archivo para subir"
                @updateFileList="onFileUpload" />
        </div>

        <button-component
            :custom-class="buttonClass"
            :disabled="disabled"
            value="Actualizar" />
        
    </form>
</template>

<script>

import { showModel, updateModel } from '@affiliateModels/affiliate-asset'
import JSValidator from 'innoboxrr-js-validator'
import {
    TextInputComponent,
    TextareaInputComponent,
    SelectInputComponent,
    FileInputComponent,
    ButtonComponent
} from 'innoboxrr-form-elements'

export default {

    components: {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
        FileInputComponent,
        ButtonComponent
    },

    props: {
        formId: {
            type: String,
            default: 'editAffiliateAssetForm'
        },
        affiliateAssetId: {
            type: [Number, String],
            required: true
        }
    },

    emits: ['submit'],

    data() {
        return {
            affiliateAsset: {
                name: '',
                type: '',
                description: '',
                payload: {
                    url: '',
                    file: ''
                }
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
            this.fetchAffiliateAsset();
        },

        fetchAffiliateAsset() {
            showModel(this.affiliateAssetId).then(res => {
                this.affiliateAsset = res;
            });
        },

        onFileUpload(files) {
            if (files?.[0]?.path) {
                this.affiliateAsset.payload.file = files[0].path;
            }
        },

        onSubmit() {
            if(this.JSValidator.status) {
                this.disabled = true;
                updateModel(this.affiliateAsset.id, {
                    name: this.affiliateAsset.name,
                    type: this.affiliateAsset.type,
                    description: this.affiliateAsset.description,
                    url: this.affiliateAsset.payload.url,
                    file: this.affiliateAsset.payload.file
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
