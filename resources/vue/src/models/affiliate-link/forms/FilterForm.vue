<template>	
	<form id="affiliateLinkFilterForm" @submit.prevent="onSubmit">
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

			<!-- Enlace destino -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="url"
					label="Enlace"
					placeholder="URL destino"
					v-model="url" />
			</div>

			<!-- Etiqueta -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="label"
					label="Etiqueta"
					placeholder="Etiqueta o alias"
					v-model="label" />
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
				url: null,
				label: null
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', this.$data);
			},

			resetForm() {
				this.id = null;
				this.affiliate_id = null;
				this.url = null;
				this.label = null;
				this.onSubmit();
			}
		}
	}
</script>
