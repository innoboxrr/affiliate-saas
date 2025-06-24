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
        <div class="border rounded-md mb-6">
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

                <div>
                    <label for="cookie_path" class="block text-sm/6 font-medium text-gray-900">
                        {{ __affiliate('Cookie URL') }}
                    </label>
                    <div class="mt-2 flex">
                        <div class="flex shrink-0 items-center rounded-l-md bg-gray-100 px-3 text-base text-gray-500 outline outline-1 -outline-offset-1 outline-gray-300 sm:text-sm/6">
                            https:// or https://
                        </div>
                        <input 
                            type="text" 
                            name="cookie_path" 
                            id="cookie_path" 
                            validators="required alphanumeric_dash"
                            :class="inputClassWithUrl"
                            v-model="affiliateProgram.payload.cookie_path"
                            data-validators="alphanumeric"
                            placeholder="misitioweb.com" 
                            @input="sanitizeCookiePath"/>
                    </div>
                </div>

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

                <!-- Currency -->
                <div>
                    <select-input-component
                        :custom-class="inputClass"
                        label="Moneda"
                        help="Selecciona la moneda para el programa"
                        validators="required"
                        placeholder="Selecciona una moneda"
                        name="currency"
                        v-model="affiliateProgram.payload.currency">
                        <option value="" disabled selected>Selecciona una moneda</option>
                        <option value="USD">Dólar (USD)</option>
                        <option value="EUR">Euro (EUR)</option>
                        <option value="MXN">Peso Mexicano (MXN)</option>
                        <!-- Agregar más monedas según sea necesario -->
                    </select-input-component>
                </div>

                <!-- Ubral para poder enviar pago a afiliados -->
                <text-input-component
                    :custom-class="inputClass"
                    type="number"
                    name="payout_threshold"
                    label="Ubral de pago a afiliados"
                    placeholder="Ej. 10.00"
                    validators="required decimal"
                    v-model="affiliateProgram.payload.payout_threshold"
                />
            </div>
        </div>

        <!-- SEGURIDAD -->
        <div class="border rounded-md mb-6">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.tech = !collapsed.tech">
                <span class="text-sm font-semibold">SEGURIDAD</span>
                <i :class="['fa-solid', collapsed.security ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.security" class="p-4 space-y-4">

                <select-input-component
                    :custom-class="inputClass"
                    name="allow_frontend_conversions"
                    label="Permitir conversiones desde el frontend"
                    v-model="affiliateProgram.payload.allow_frontend_conversions">
                    <option :value="true">Sí</option>
                    <option :value="false">No</option>
                </select-input-component>

                <tags-input-component
                    v-if="affiliateProgram.payload.allow_frontend_conversions"
                    :custom-class="inputClass"
                    name="allowed_urls"
                    label="URLs permitidas"
                    help="URLs donde se permiten conversiones. Separa múltiples URLs con comas."
                    placeholder="Ej. sitio.com/success, sitio.com/thank-you"
                    v-model="affiliateProgram.payload.allowed_urls"
                />
                
				<div class="mt-6">
					<label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
						Server-side conversion token
                        <span class="text-xs text-gray-500 dark:text-gray-400"> (64 caracteres alfanuméricos)</span>
					</label>
					<div class="flex items-center space-x-2">
						<clipboard-input
							:value="affiliateProgram.server_token"
							class="block w-full text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-300 dark:hover:text-blue-400"
						/>
						<button
							type="button"
							@click="regenerateToken"
							class="text-sm px-3 py-2 text-grey-600 rounded focus:ring-2 focus:ring-blue-300 dark:bg-blue-700 dark:hover:bg-blue-800 dark:focus:ring-blue-900">
							<i class="fas fa-sync-alt mr-1 text-lg"></i> 
						</button>
					</div>
				</div>

            </div>
        </div>

        <!-- PÁGINA DE REGISTRO -->
        <div class="border rounded-md mb-6">
            <div class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" @click="collapsed.general = !collapsed.general">
                <span class="text-sm font-semibold">
                    Página de Registro
                    <span class="text-xs text-gray-500 dark:text-gray-400"> (opcional)</span>
                </span>
                <i :class="['fa-solid', collapsed.register ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
            </div>
            <div v-show="!collapsed.register" class="p-4 space-y-4">
                <select-input-component
                    :custom-class="inputClass"
                    name="allow_self_registration"
                    label="Permitir auto-registro"
                    v-model="affiliateProgram.payload.allow_self_registration">
                    <option :value="true">Sí</option>
                    <option :value="false">No</option>
                </select-input-component>

                <!-- NAME -->
                <text-input-component
                    :custom-class="inputClass"
                    type="text"
                    name="registration_title"
                    label="Título de la página de registro"
                    placeholder="Ej: Regístrate y gana dinero"
                    validators="required length"
                    help="Es el valor que se mostrará en la página de registro"
                    min_length="3"
                    max_length="100"
                    v-model="affiliateProgram.payload.registration_title" />

                <!-- DESCRIPTION -->
                <textarea-input-component
                    :custom-class="inputClass"
                    name="registration_description"
                    label="Descripción"
                    placeholder="Describe brevemente el formulario"
                    validators="length"
                    min_length="3"
                    v-model="affiliateProgram.payload.registration_description" />

                <div v-if="affiliateProgram.payload.allow_self_registration">
                    <div>
                        <label class="uk-form-label">
                            Imagen de fondo
                        </label>
                        <file-input-component
                            :upload-url="uploadUrl"
                            :auto-upload="true"
                            :show-top-preview="true"
                            :hide-on-max-files-reached="true"
                            :valid-mimes="[ 'image/jpeg', 'image/png' ]"
                            message="Da clic o arrastra una imagen para subir como fondo de formulario"
                            @updateFileList="onImageUpload" />
                    </div>
                </div>
            </div>
        </div>


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
	ButtonComponent,
    FileInputComponent
} from 'innoboxrr-form-elements'

export default {

	components: {
		TextInputComponent,
		TextareaInputComponent,
		SelectInputComponent,
		ButtonComponent,
        FileInputComponent
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
			collapsed: {
				general: false,
			},
			affiliateProgram: {
				name: '',
				description: '',
				server_token: this.randomCode(64),
				payload: {
					test_mode: false,
					tracking_model: '',
					cookie_path: '',
					cookie_lifetime: '',
					default_commission: '',

                    allow_frontend_conversions: 0,

                    registration_title: '',
                    registration_description: '',
                    registration_image: '',
                    allow_self_registration: 0,
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
                this.affiliateProgram.payload.allowed_urls = this.affiliateProgram?.payload?.allowed_urls?.split(',') || [];
			});
		},

		randomCode(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        },

        regenerateToken() {
            this.affiliateProgram.server_token = this.randomCode(64);
        },
        
        sanitizeCookiePath() {
            const raw = this.affiliateProgram.payload.cookie_path || '';
            this.affiliateProgram.payload.cookie_path = raw
                .replace(/^https?:\/\//i, '') // remueve http:// o https://
                .replace(/\/+$/, '');         // opcional: remueve slash final
        },

		onSubmit() {

			this.sanitizeCookiePath(); // asegura limpieza final

			if(this.JSValidator.status) {
				this.disabled = true;
				updateModel(this.affiliateProgram.id, {
					name: this.affiliateProgram.name,
					description: this.affiliateProgram.description,
					server_token: this.affiliateProgram.server_token,
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
