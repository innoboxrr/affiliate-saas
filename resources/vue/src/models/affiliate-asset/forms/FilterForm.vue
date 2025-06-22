<template>	
	<form id="affiliateAssetFilterForm" @submit.prevent="onSubmit">
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
					label="Nombre del activo"
					placeholder="Nombre"
					v-model="name" />
			</div>

			<!-- Tipo de activo -->
			<div>
				<select-input-component
					:custom-class="inputClass"
					name="type"
					label="Tipo"
					v-model="type">
					<option value="">Todos</option>
					<option value="archivo">Archivo</option>
					<option value="imagen">Imagen</option>
					<option value="enlace">Enlace</option>
				</select-input-component>
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
		SelectInputComponent
	} from 'innoboxrr-form-elements'

	export default {

		components: {
			TextInputComponent,
			SelectInputComponent
		},

		emits: ['submit'],

		data() {
			return {
				id: null,
				name: null,
				type: null
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', this.$data);
			},

			resetForm() {
				this.id = null;
				this.name = null;
				this.type = null;
				this.onSubmit();
			}
		}
	}
</script>
