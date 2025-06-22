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
            <option value="image">Imagen</option>
            <option value="video">Video</option>
            <option value="document">Documento</option>
        </select-input-component>

        <!-- URL -->
        <text-input-component
            :custom-class="inputClass"
            type="text"
            name="url"
            label="URL"
            placeholder="https://..."
            validators="url"
            v-model="affiliateAsset.url" />

        <!-- Notas de uso -->
        <textarea-input-component
            :custom-class="inputClass"
            name="usage_notes"
            label="Notas de uso"
            placeholder="Indicaciones sobre el uso del activo"
            v-model="affiliateAsset.payload.usage_notes" />

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
                url: '',
                payload: {
                    usage_notes: ''
                }
            },
            disabled: false,
            JSValidator: undefined
        }
    },
    mounted() {
        this.fetchAffiliateAsset();
        this.JSValidator = new JSValidator(this.formId).init();
        this.JSValidator.status = true;
    },
    methods: {
        fetchAffiliateAsset() {
            showModel(this.affiliateAssetId).then(res => {
                this.affiliateAsset = res;
            });
        },
        onFileUpload(files) {
            if (files?.[0]?.path) {
                this.affiliateAsset.url = files[0].path;
            }
        },
        onSubmit() {
            if(this.JSValidator.status) {
                this.disabled = true;
                updateModel(this.affiliateAsset.id, {
                    name: this.affiliateAsset.name,
                    type: this.affiliateAsset.type,
                    url: this.affiliateAsset.url,
                    usage_notes: this.affiliateAsset.payload.usage_notes
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
