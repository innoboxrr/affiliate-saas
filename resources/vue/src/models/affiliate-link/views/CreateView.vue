<template>

	<div>

		<breadcrumbs-component 
			:pages="[
				{ link: $router.resolve({ name: 'AdminAffiliateLinks' }).fullPath, title: 'AffiliateLinks'},
				{ link: $router.resolve({ name: 'AdminCreateAffiliateLink' }).fullPath, title: 'Crear AffiliateLinks'}
			]"/>
			
		<div class="flex justify-center items-center mt-8">
			
			<div class="max-w-2xl w-full">
				
				<div class="card bg-white dark:bg-slate-600 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800">

					<h2 class="text-xl font-bold mb-4">Crear AffiliateLinks</h2>
					
					<create-form 
						:affiliate-id="$route.query.affiliate_id"
						@submit="formSubmit"/>

				</div>

			</div>

		</div>

	</div>

</template>

<script>

	import { getPolicy } from '@affiliateModels/affiliate-link'
	import CreateForm from '@affiliateModels/affiliate-link/forms/CreateForm.vue'

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

					if(!res.create) {

						// this.$router.push({name: "NotAuthorized" });
						
					}

                });

			},

			formSubmit(payload) {	

				this.$emit('updateData', payload);

				this.$router.push({

					name: "AdminShowAffiliateLink", 

					params: { 

						id: payload.id 

					} 

				});

			}

		}

	}

</script>