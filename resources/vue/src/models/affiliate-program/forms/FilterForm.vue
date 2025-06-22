<template>	
	<form id="affiliateProgramFilterForm" @submit.prevent="onSubmit">
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
					placeholder="Nombre del programa"
					v-model="name" />
			</div>

			<!-- Slug -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="slug"
					label="Código"
					placeholder="Código único"
					v-model="slug" />
			</div>

			<!-- Comisión -->
			<div>
				<text-input-component
					:custom-class="inputClass"
					type="text"
					name="commission"
					label="Comisión"
					placeholder="Ej. 10"
					v-model="commission" />
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
				name: null,
				slug: null,
				commission: null
			}
		},

		methods: {

			onSubmit() {
				this.$emit('submit', this.$data);
			},

			resetForm() {
				this.id = null;
				this.name = null;
				this.slug = null;
				this.commission = null;
				this.onSubmit();
			}
		}
	}
</script>
