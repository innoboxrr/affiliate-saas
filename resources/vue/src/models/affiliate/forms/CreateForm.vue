<template>

	<form :id="formId" @submit.prevent="onSubmit">

		<!-- User Select or Create -->
		<div v-if="user_id == null" uk-grid>
			<div class="uk-width-expand">
				<model-search-input-component
					custom-class="bg-gray-50 rounded-lg text-sm py-0.5"
					label-str="Buscar usuario"
					placeholder-str="Escribe el correo del usuario"
					:route="userRoute"
					q="email"
					:get-option-label="option => `${option.name} ${option.email}`"
					@submit="setUser" />
			</div>
			<div class="uk-width-auto uk-flex uk-flex-middle">
				<a class="uk-button button" href="#createUserModal" uk-toggle>
					Agregar usuario
				</a>
			</div>
		</div>

		<!-- Affiliate Inputs -->
		<text-input-component 
            :custom-class="inputClass" 
            name="name" 
            label="Nombre legal" 
            placeholder="Nombre como aparece en tu documento de identidad" 
            validators="required length" 
            :min_length="3" 
            v-model="affiliate.payload.name" />

		<text-input-component 
            :custom-class="inputClass" 
            type="email" 
            name="email" 
            label="Correo Electrónico" 
            placeholder="ejemplo@correo.com" 
            validators="required email" 
            v-model="affiliate.payload.email" />

		<text-input-component 
            :custom-class="inputClass" 
            name="phone" 
            label="Teléfono" 
            placeholder="Número telefónico" 
            v-model="affiliate.payload.phone" />

		<text-input-component 
            :custom-class="inputClass" 
            name="address" 
            label="Dirección" 
            placeholder="Dirección física" 
            v-model="affiliate.payload.address" />

		<text-input-component 
            :custom-class="inputClass" 
            name="city" 
            label="Ciudad" 
            placeholder="Ciudad" 
            v-model="affiliate.payload.city" />

		<text-input-component 
            :custom-class="inputClass" 
            name="state" 
            label="Estado" 
            placeholder="Estado" 
            v-model="affiliate.payload.state" />

		<text-input-component 
            :custom-class="inputClass" 
            name="country" 
            label="País" 
            placeholder="País" 
            v-model="affiliate.payload.country" />

		<text-input-component 
            :custom-class="inputClass" 
            name="zip" 
            label="Código Postal" 
            placeholder="Ej. 12345" 
            v-model="affiliate.payload.zip" />

		<text-input-component 
            :custom-class="inputClass" 
            name="website" 
            label="Sitio Web" 
            placeholder="https://" 
            validators="url" 
            v-model="affiliate.payload.website" />

		<text-input-component 
            :custom-class="inputClass" 
            name="facebook" 
            label="Facebook" 
            placeholder="https://" 
            validators="url" 
            v-model="affiliate.payload.facebook" />

		<text-input-component 
            :custom-class="inputClass" 
            name="twitter" 
            label="Twitter" 
            placeholder="https://" 
            validators="url" 
            v-model="affiliate.payload.twitter" />

		<text-input-component 
            :custom-class="inputClass" 
            name="instagram" 
            label="Instagram" 
            placeholder="https://" 
            validators="url" 
            v-model="affiliate.payload.instagram" />

		<text-input-component 
            :custom-class="inputClass" 
            name="linkedin" 
            label="LinkedIn" 
            placeholder="https://" 
            validators="url" 
            v-model="affiliate.payload.linkedin" />

		<text-input-component 
            :custom-class="inputClass" 
            name="youtube" 
            label="YouTube" 
            placeholder="https://" 
            validators="url" 
            v-model="affiliate.payload.youtube" />

		<text-input-component 
            :custom-class="inputClass" 
            name="tiktok" 
            label="TikTok" 
            placeholder="https://" 
            validators="url" 
            v-model="affiliate.payload.tiktok" />

		<text-input-component 
            :custom-class="inputClass" 
            name="payment_method" 
            label="Método de Pago" 
            placeholder="Ej. PayPal, Transferencia" 
            v-model="affiliate.payload.payment_method" />

		<textarea-input-component 
            :custom-class="inputClass" 
            name="payment_data" 
            label="Datos de Pago" 
            placeholder="Datos detallados para el pago" 
            v-model="affiliate.payload.payment_data" />

		<text-input-component 
            :custom-class="inputClass" 
            name="affiliate_type" 
            label="Tipo de Afiliado" 
            placeholder="Ej. Influencer, Empresa" 
            v-model="affiliate.payload.affiliate_type" />

		<button-component 
            :custom-class="buttonClass" 
            :disabled="disabled" 
            value="Crear" />

		<!-- User Modal -->
		<div id="createUserModal" uk-modal>
			<div class="uk-modal-dialog uk-modal-body">
				<h2 class="uk-modal-title">Crear nuevo usuario</h2>
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
import { createModel } from '@affiliateModels/affiliate'
import JSValidator from 'innoboxrr-js-validator'
import {
	TextInputComponent,
	TextareaInputComponent,
	ButtonComponent,
	ModelSearchInputComponent
} from 'innoboxrr-form-elements'
import UserCreateForm from '@models/user/forms/CreateForm.vue'

export default {
	components: {
		TextInputComponent,
		TextareaInputComponent,
		ButtonComponent,
		ModelSearchInputComponent,
		UserCreateForm
	},
	props: {
		formId: {
			type: String,
			default: 'createAffiliateForm'
		}
	},
	emits: ['submit'],
	data() {
		return {
			userRoute: route('api.user.index'),
			affiliate: {
				payload: {}
			},
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
			if (this.JSValidator.status) {
				this.disabled = true;
				createModel({
					user_id: this.user_id,
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
