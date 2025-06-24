<template>

	<div class="flex justify-center items-center">
			
		<div class="w-full">
			
			<div class="card bg-white dark:bg-slate-600 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800">

				<h2 class="text-xl font-bold mb-4">Editar Programa</h2>

				<edit-form 
					:key="$route.params.id"
					:affiliate-program-id="$route.params.id"
					@submit="formSubmit"/>

			</div>

		</div>

	</div>

</template>

<script>

	import { getPolicy } from '@affiliateModels/affiliate-program'
	import EditForm from '@affiliateModels/affiliate-program/forms/EditForm.vue'

	export default {

		components: {
			
			EditForm

		},

		emits: ['updateData'],

		mounted() {

			this.fetchEditPolicy();

		},

		methods: {

			fetchEditPolicy() {

				getPolicy('update', this.$route.params.id).then( res => {

					if(!res.update) {

						// this.$router.push({name: "NotAuthorized" });
						
					}

                });

			},

			formSubmit(payload) {	

				this.$emit('updateData', payload);

				this.$router.push({

					name: "AdminShowAffiliateProgram", 

					params: { 

						id: payload.id 

					} 

				});

			}

		}

	}

</script>