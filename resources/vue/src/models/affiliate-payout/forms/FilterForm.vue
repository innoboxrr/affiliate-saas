<template>	
	<form id="affiliatePayoutFilterForm" @submit.prevent="onSubmit">
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

			<!-- Afiliado -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="affiliate_id"
					label="Afiliado"
					placeholder="ID del afiliado"
					v-model="affiliate_id" />
			</div>

			<!-- Monto -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="amount"
					label="Monto"
					placeholder="Ej. 100.00"
					v-model="amount" />
			</div>

			<!-- Divisa -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="currency"
					label="Divisa"
					placeholder="USD, MXN..."
					v-model="currency" />
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
		TextInputComponent
	} from 'innoboxrr-form-elements'

	export default {

		components: {
			TextInputComponent
		},

		emits: ['submit'],

		data() {
			return {
				id: null,
				affiliate_id: null,
				amount: null,
				currency: null
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', this.$data);
			},

			resetForm() {
				this.id = null;
				this.affiliate_id = null;
				this.amount = null;
				this.currency = null;
				this.onSubmit();
			}
		}
	}
</script>
