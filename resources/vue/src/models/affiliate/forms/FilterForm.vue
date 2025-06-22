<template>	
	<form id="affiliateFilterForm" @submit.prevent="onSubmit">
		<div class="uk-flex uk-flex-left uk-child-width-1-4@m uk-child-width-1-1@s" uk-grid>

			<!-- ID -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="id"
					label="ID"
					placeholder="ID"
					v-model="id" />
			</div>

			<!-- Nombre -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="name"
					label="Nombre"
					placeholder="Nombre del afiliado"
					v-model="name" />
			</div>

			<!-- Email -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="email"
					label="Correo Electrónico"
					placeholder="ejemplo@correo.com"
					v-model="email" />
			</div>

			<!-- Teléfono -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="phone"
					label="Teléfono"
					placeholder="Número telefónico"
					v-model="phone" />
			</div>

			<!-- Dirección -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="address"
					label="Dirección"
					placeholder="Dirección"
					v-model="address" />
			</div>

			<!-- Ciudad -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="city"
					label="Ciudad"
					placeholder="Ciudad"
					v-model="city" />
			</div>

			<!-- Estado -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="state"
					label="Estado"
					placeholder="Estado"
					v-model="state" />
			</div>

			<!-- País -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="country"
					label="País"
					placeholder="País"
					v-model="country" />
			</div>

			<!-- Código Postal -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="zip"
					label="Código Postal"
					placeholder="Ej. 12345"
					v-model="zip" />
			</div>

			<!-- Sitio Web -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="website"
					label="Sitio Web"
					placeholder="https://"
					v-model="website" />
			</div>

			<!-- Redes Sociales -->
			<div><text-input-component :custom-class="inputClass" name="facebook" label="Facebook" placeholder="https://" v-model="facebook" /></div>
			<div><text-input-component :custom-class="inputClass" name="twitter" label="Twitter" placeholder="https://" v-model="twitter" /></div>
			<div><text-input-component :custom-class="inputClass" name="instagram" label="Instagram" placeholder="https://" v-model="instagram" /></div>
			<div><text-input-component :custom-class="inputClass" name="linkedin" label="LinkedIn" placeholder="https://" v-model="linkedin" /></div>
			<div><text-input-component :custom-class="inputClass" name="youtube" label="YouTube" placeholder="https://" v-model="youtube" /></div>
			<div><text-input-component :custom-class="inputClass" name="tiktok" label="TikTok" placeholder="https://" v-model="tiktok" /></div>

			<!-- Método de Pago -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					name="payment_method"
					label="Método de Pago"
					placeholder="Ej. PayPal"
					v-model="payment_method" />
			</div>

			<!-- Datos de Pago -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					name="payment_data"
					label="Datos de Pago"
					placeholder="Información bancaria, email, etc."
					v-model="payment_data" />
			</div>

			<!-- Tipo de Afiliado -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					name="affiliate_type"
					label="Tipo de Afiliado"
					placeholder="Ej. Influencer"
					v-model="affiliate_type" />
			</div>

		</div>

		<div class="uk-flex uk-flex-right uk-child-width-auto@m uk-child-width-1-1@m" uk-grid>
			<div>
				<button :class="buttonClass">
					{{ __('Search') }}
				</button>
			</div>
			<div>
				<button 
					:class="buttonClass + ' bg-gray-400'"
					@click.prevent="resetForm()">
					{{ __('Reset') }}
				</button>
			</div>
		</div>
	</form>
</template>

<script>
import {
	TextInputComponent,
} from 'innoboxrr-form-elements'

export default {

	components: {
		TextInputComponent,
	},

	emits: ['submit'],

	data() {
		return {
			id: null,
			name: null,
			email: null,
			phone: null,
			address: null,
			city: null,
			state: null,
			country: null,
			zip: null,
			website: null,
			facebook: null,
			twitter: null,
			instagram: null,
			linkedin: null,
			youtube: null,
			tiktok: null,
			payment_method: null,
			payment_data: null,
			affiliate_type: null,
		}
	},

	methods: {

		onSubmit() {
			this.$emit('submit', this.$data);
		},

		resetForm() {
			Object.keys(this.$data).forEach(key => {
				this[key] = null;
			});
			this.onSubmit();
		}
	}
}
</script>
