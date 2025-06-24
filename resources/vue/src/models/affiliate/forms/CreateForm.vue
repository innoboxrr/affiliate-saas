<template>

	<form :id="formId" @submit.prevent="onSubmit">

		<!-- Nombre del Afiliado -->
		<div class="border rounded-md mb-4">
			<div 
				class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" 
				@click="collapsed.user = !collapsed.user">
				<span class="text-sm font-semibold">
						{{ __affiliate('User info') }}
				</span>
				<i :class="['fa-solid', collapsed.user ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
			</div>
			<div v-show="!collapsed.user" class="p-4 space-y-4">

				<!-- User Select or Create -->
				<div v-if="user_id == null" uk-grid="" class="uk-grid-small">
					<div class="uk-width-expand">
						<model-search-input-component
							custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
							label-str="Buscar usuario"
							placeholder-str="Escribe el correo del usuario"
							:route="userRoute"
							:external-filters="{
								managed: true,
								affiliate_search: true,
								email_exact: true,
							}"
							q="email"
							:noOptionsText="`No se encontraron usuarios`"
							:get-option-label="option => `${option.name}`"
							@submit="setUser" />
					</div>
					<div class="uk-width-auto uk-flex uk-flex-middle">
						<a 
							:class="buttonClass" 
							class="hover:text-white"
							href="#createUserModal" 
							uk-toggle>
							Agregar usuario
						</a>
					</div>
				</div>

				<!-- Programa de Afiliados -->
				<model-search-input-component
					v-if="!affiliateProgramId"
					custom-class="bg-gray-50 rounded-lg text-sm py-0.5 border border-gray-300"
					label-str="Selecciona un programa de afiliados"
					placeholder-str="Buscar por nombre o ID"
					:route="affiliateProgramRoute"
					:external-filters="{ managed: true }"
					q="name"
					:get-option-label="option => `${option.name} (ID: ${option.id})`"
					@submit="setAffiliateProgram" />

				<text-input-component 
					:custom-class="inputClass" 
					name="user_name" 
					label="Nombre del Usuario" 
					placeholder="Nombre del usuario" 
					validators="required length" 
					:min_length="3" 
					v-model="affiliate.payload.user.name" />

				<text-input-component 
					:custom-class="inputClass" 
					type="email" 
					name="user_email" 
					label="Correo del Usuario" 
					placeholder="correo@ejemplo.com" 
					validators="required email" 
					v-model="affiliate.payload.user.email" />
			</div>
		</div>

		<!-- Address Section -->
		<div class="border rounded-md mb-4">
			<div 
				class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" 
				@click="collapsed.address = !collapsed.address">
				<span class="text-sm font-semibold">
						{{ __affiliate('Address') }}
				</span>
				<i :class="['fa-solid', collapsed.address ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
			</div>
			<div v-show="!collapsed.address" class="p-4 space-y-4">
				
				<text-input-component 
					:custom-class="inputClass" 
					name="address_street" 
					label="Dirección" 
					placeholder="Dirección física" 
					v-model="affiliate.payload.address.street" />

				<text-input-component 
					:custom-class="inputClass" 
					name="address_city" 
					label="Ciudad" 
					placeholder="Ciudad" 
					v-model="affiliate.payload.address.city" />
				
				<text-input-component 
					:custom-class="inputClass" 
					name="address_state" 
					label="Estado" 
					placeholder="Estado" 
					v-model="affiliate.payload.address.state" />    

				<text-input-component 
					:custom-class="inputClass" 
					name="address_country" 
					label="País" 
					placeholder="País" 
					v-model="affiliate.payload.address.country" />  

				<text-input-component 
					:custom-class="inputClass" 
					name="address_zip" 
					label="Código Postal" 
					placeholder="Código Postal" 
					v-model="affiliate.payload.address.zip" />
			</div>
		</div>

		<!-- Social Section -->
		<div class="border rounded-md mb-4">
			<div 
				class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" 
				@click="collapsed.social = !collapsed.social">
				<span class="text-sm font-semibold">
						{{ __affiliate('Socail') }}
				</span>
				<i :class="['fa-solid', collapsed.social ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
			</div>
			<div v-show="!collapsed.social" class="p-4 space-y-4">

				<text-input-component 
					:custom-class="inputClass" 
					name="website" 
					label="Sitio Web" 
					placeholder="https://" 
					validators="url" 
					v-model="affiliate.payload.links.website" />

				<text-input-component :custom-class="inputClass" name="facebook" label="Facebook" placeholder="https://" validators="url" v-model="affiliate.payload.links.facebook" />
				<text-input-component :custom-class="inputClass" name="twitter" label="Twitter" placeholder="https://" validators="url" v-model="affiliate.payload.links.twitter" />
				<text-input-component :custom-class="inputClass" name="instagram" label="Instagram" placeholder="https://" validators="url" v-model="affiliate.payload.links.instagram" />
				<text-input-component :custom-class="inputClass" name="linkedin" label="LinkedIn" placeholder="https://" validators="url" v-model="affiliate.payload.links.linkedin" />
				<text-input-component :custom-class="inputClass" name="youtube" label="YouTube" placeholder="https://" validators="url" v-model="affiliate.payload.links.youtube" />
				<text-input-component :custom-class="inputClass" name="tiktok" label="TikTok" placeholder="https://" validators="url" v-model="affiliate.payload.links.tiktok" />

			</div>
		</div>

		<!-- Financial Section -->
		<div class="border rounded-md mb-4">
			<div 
				class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 cursor-pointer" 
				@click="collapsed.financial = !collapsed.financial">
				<span class="text-sm font-semibold">
						{{ __affiliate('Financial') }}
				</span>
				<i :class="['fa-solid', collapsed.financial ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
			</div>
			<div v-show="!collapsed.financial" class="p-4 space-y-4">
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="tax_id"
					label="ID Fiscal"
					placeholder="Número de identificación fiscal"
					v-model="affiliate.payload.financial.tax_id" />

				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="comercial_name"
					label="Nombre Comercial"
					placeholder="Nombre o Razón Social"
					v-model="affiliate.payload.financial.comercial_name" />

				<select-input-component
					:custom-class="inputClass"
					name="payment_method"
					label="Método de Pago"
					v-model="affiliate.payload.financial.payment_method">
					<option value="bank_transfer">Transferencia Bancaria</option>
					<option value="paypal" disabled>PayPal (Comming Soon)</option>
					<option value="stripe" disabled>Stripe (Comming Soon)</option>
				</select-input-component>

				<text-input-component
					v-if="affiliate.payload.financial.payment_method === 'paypal'"
					:custom-class="inputClass"
					type="email"
					name="paypal_email"
					label="Correo de PayPal"
					placeholder="correo@paypal.com"
					validators="email"
					v-model="affiliate.payload.financial.paypal_email" />

				<div v-if="affiliate.payload.financial.payment_method === 'bank_transfer'">
					<text-input-component
						:custom-class="inputClass"
						name="bank_name"
						label="Nombre del banco"
						placeholder="Ej. Banco XYZ"
						v-model="affiliate.payload.financial.bank_name" />

					<text-input-component
						:custom-class="inputClass"
						name="account_number"
						label="Número de cuenta"
						placeholder="Ej. 123456789"
						v-model="affiliate.payload.financial.account_number" />

					<text-input-component
						:custom-class="inputClass"
						name="account_holder"
						label="Titular de la cuenta"
						placeholder="Nombre completo"
						v-model="affiliate.payload.financial.account_holder" />
				</div>

				<text-input-component
					v-if="affiliate.payload.financial.payment_method === 'stripe'"
					:custom-class="inputClass"
					name="stripe_account_id"
					label="Cuenta de Stripe"
					placeholder="ID de cuenta de Stripe"
					v-model="affiliate.payload.financial.stripe_account_id" />

				<select-input-component 
					:custom-class="inputClass" 
					name="affiliate_type" 
					label="Tipo de Afiliado" 
					v-model="affiliate.payload.financial.affiliate_type">
					<option value="influencer">Influencer</option>
					<option value="empresa">Empresa</option>
					<option value="particular">Particular</option>
				</select-input-component>
			</div>
		</div>

		<button-component 
            :custom-class="buttonClass" 
            :disabled="disabled" 
            :value="__affiliate('Create')" />

		<!-- User Modal -->
		<div id="createUserModal" uk-modal>
			<div class="uk-modal-dialog uk-modal-body">
				<h2 class="uk-modal-title">
					Crear nuevo usuario
				</h2>
				<user-create-form 
                    :show-avatar-input="false" 
                    :show-roles-input="false" 
                    default-role-code="001" 
                    @submit="userCreateFormSubmit" />
			</div>
		</div>
	</form>

</template>

<script>
	import { payload, createModel } from '@affiliateModels/affiliate'
	import { API_ROUTE_PREFIX } from '@affiliateModels/affiliate-program'
	import JSValidator from 'innoboxrr-js-validator'
	import {
		TextInputComponent,
		TextareaInputComponent,
		SelectInputComponent,
		ButtonComponent,
		ModelSearchInputComponent
	} from 'innoboxrr-form-elements'
	import UserCreateForm from '@models/user/forms/CreateForm.vue'

export default {
	components: {
		TextInputComponent,
		TextareaInputComponent,
        SelectInputComponent,
		ButtonComponent,
		ModelSearchInputComponent,
		UserCreateForm
	},
	props: {
		formId: {
			type: String,
			default: 'createAffiliateForm'
		},
		affiliateProgramId: {
            type: [Number, String],
            default: null
        }
	},
	emits: ['submit'],
	data() {
		return {
			collapsed: {
				user: false,
				address: false,
				social: true,
				financial: true
			},
			userRoute: route('api.user.index'),
			affiliate: {
				payload: payload
			},
			selectedAffiliateProgramId: this.affiliateProgramId,
			affiliateProgramRoute: route(`${API_ROUTE_PREFIX}index`),
			user_id: null,
			disabled: false,
			JSValidator: undefined,
		}
	},
	mounted() {
		this.JSValidator = new JSValidator(this.formId).init();
	},
	methods: {
		onSubmit() {
			if (this.JSValidator.status && this.user_id) {
				this.disabled = true;
				createModel({
					user_id: this.user_id,
					affiliate_program_id: this.selectedAffiliateProgramId,
					...this.affiliate.payload
				}).then(res => {
					this.$emit('submit', res);
					setTimeout(() => { this.disabled = false; }, 2500);
				}).catch(error => {
					this.disabled = false;
					if (error?.response?.status == 422)
						this.JSValidator.appendExternalErrors(error.response.data.errors);
				});
			} else {
				this.disabled = false;
			}
		},
		setAffiliateProgram(id) {
            this.selectedAffiliateProgramId = id;
        },
		setUser(userId) {
			this.user_id = userId;
		},
		userCreateFormSubmit(payload) {
			this.user_id = payload.data.id;
			UIkit.modal('#createUserModal').hide();
		}
	}
}
</script>
