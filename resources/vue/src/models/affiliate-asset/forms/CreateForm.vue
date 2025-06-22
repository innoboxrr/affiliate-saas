<template>
	<form :id="formId" @submit.prevent="onSubmit">

        <!-- Programa de Afiliados -->
        <model-search-input-component
            v-if="!affiliateProgramId"
            custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
            label-str="Selecciona un programa de afiliados"
            placeholder-str="Buscar por nombre o ID"
            :route="affiliateProgramRoute"
            q="name"
            :get-option-label="option => `${option.name} (ID: ${option.id})`"
            @submit="setAffiliateProgram" />

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
            value="Crear" />

    </form>
</template>

<script>
import { createModel } from '@affiliateModels/affiliate-asset'
import { API_ROUTE_PREFIX } from '@affiliateModels/affiliate-program'
import JSValidator from 'innoboxrr-js-validator'
import {
    TextInputComponent,
    TextareaInputComponent,
    SelectInputComponent,
    FileInputComponent,
    ButtonComponent,
    ModelSearchInputComponent
} from 'innoboxrr-form-elements'

export default {
    components: {
        TextInputComponent,
        TextareaInputComponent,
        SelectInputComponent,
        FileInputComponent,
        ButtonComponent,
        ModelSearchInputComponent
    },
    props: {
        formId: {
            type: String,
            default: 'createAffiliateAssetForm',
        },
        affiliateProgramId: {
            type: [Number, String],
            default: null
        }
    },
    emits: ['submit'],
    data() {
        return {
            disabled: false,
            JSValidator: undefined,
            affiliateProgramRoute: route(`${API_ROUTE_PREFIX}index`),
            affiliateAsset: {
                name: '',
                type: '',
                url: '',
                payload: {
                    usage_notes: '',
                    file: ''
                }
            },
            selectedAffiliateProgramId: this.affiliateProgramId
        }
    },
    mounted() {
        this.JSValidator = new JSValidator(this.formId).init();
    },
    methods: {
        onFileUpload(files) {
            if (files?.[0]?.path) {
                this.affiliateAsset.payload.file = files[0].path;
            }
        },
        setAffiliateProgram(id) {
            this.selectedAffiliateProgramId = id;
        },
        onSubmit() {
            if(this.JSValidator.status) {
                this.disabled = true;
                createModel({
                    name: this.affiliateAsset.name,
                    type: this.affiliateAsset.type,
                    url: this.affiliateAsset.url,
                    usage_notes: this.affiliateAsset.payload.usage_notes,
                    file: this.affiliateAsset.payload.file,
                    affiliate_program_id: this.selectedAffiliateProgramId
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
