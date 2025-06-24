<template>
	<div>
		<breadcrumbs-component 
			:pages="[
				{ link: $router.resolve({ name: 'AdminAffiliates' }).fullPath, title: __affiliate('Affiliates') },
				{ link: $router.resolve({ name: 'AdminCreateAffiliate' }).fullPath, title: __affiliate('Create Affiliate') }
			]"/>	
		<div class="flex justify-center items-center mt-8">
			<div class="max-w-2xl w-full">
				<div class="card bg-white dark:bg-slate-600 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800">
					<h2 class="text-xl font-bold mb-4">
						{{ __affiliate('Create Affiliate') }}
					</h2>
					<create-form 
						:affiliate-program-id="$route.query.affiliate_program_id"
						@submit="formSubmit"/>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { getPolicy } from '@affiliateModels/affiliate'
	import CreateForm from '@affiliateModels/affiliate/forms/CreateForm.vue'
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
					name: "AdminShowAffiliate", 
					params: { 
						id: payload.id 
					} 
				});
			}
		}
	}
</script>