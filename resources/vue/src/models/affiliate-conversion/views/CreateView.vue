<template>

	<div>

		<breadcrumb-component 
			:pages="[
				{ link: $router.resolve({ name: 'AdminAffiliateConversions' }).fullPath, title: 'AffiliateConversions'},
				{ link: $router.resolve({ name: 'AdminCreateAffiliateConversion' }).fullPath, title: 'Crear AffiliateConversions'}
			]"/>
			
		<div class="flex justify-center items-center mt-8">
			
			<div class="max-w-2xl w-full">
				
				<div class="card bg-white dark:bg-slate-600 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800">

					<h2 class="text-4xl font-bold dark:text-white mb-6">Crear AffiliateConversions</h2>
					
					<create-form 
						@submit="formSubmit"/>

				</div>

			</div>

		</div>

	</div>

</template>

<script>

	import { getPolicy } from '@affiliateModels/affiliate-conversion'
	import CreateForm from '@affiliateModels/affiliate-conversion/forms/CreateForm.vue'

	export default {

		components: {
			
			CreateForm

		},
		
		emits: ['updateData'],

		mounted(){

			this.fetchCreatePolicy();

		},

		methods: {

			fetchCreatePolicy() {

				getPolicy('create').then( res => {

					if(!res.data.create) {

						// this.$router.push({name: "NotAuthorized" });
						
					}

                });

			},

			formSubmit(payload) {	

				this.$emit('updateData', payload);

				this.$router.push({

					name: "AdminShowAffiliateConversion", 

					params: { 

						id: payload.data.id 

					} 

				});

			}

		}

	}

</script>