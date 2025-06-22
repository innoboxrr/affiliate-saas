<template>

	<div v-if="dataLoaded">

		<breadcrumbs-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affiliate-payout="affiliatePayout" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:affiliate-payout="affiliatePayout" />
	    				
	    			</div>

	    			<div v-else>
	    				
	    				<router-view @updateData="fetchData"></router-view>

	    			</div>

	    		</div>

	    	</div>

	    </div>

	</div>

</template>

<script>

	import { showModel } from '@affiliateModels/affiliate-payout'
	import ModelCard from '@affiliateModels/affiliate-payout/widgets/ModelCard.vue'
	import ModelProfile from '@affiliateModels/affiliate-payout/widgets/ModelProfile.vue'

	export default {

		components: {

			ModelCard,

			ModelProfile

		},

		mounted() {

			this.fetchData();

		},

		data() {
		
			return {

				dataLoaded: false,

				title: undefined,

				affiliatePayoutId: this.$route.params.id,

				affiliatePayout: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffiliatePayout');

			},

			items() {

				if(this.$route.name == 'AdminShowAffiliatePayout') {

					return [
						{ text: 'AffiliatePayouts', path: '/admin/affiliate-payout'},
						{ text: this.affiliate-payout.name ?? 'AffiliatePayout', path: '/admin/affiliate-payout/' + this.affiliate-payout.id}
					];

				} else if(this.$route.name == 'AdminEditAffiliatePayout') {

					return [
						{ text: 'AffiliatePayouts', path: '/admin/affiliate-payout'},
						{ text: this.affiliate-payout.name ?? 'AffiliatePayout' , path: '/admin/affiliate-payout/' + this.affiliate-payout.id},
						{ text: 'Editar affiliate-payout', path: '/admin/affiliate-payout/' + this.affiliate-payout.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffiliatePayout()

				this.dataLoaded = true;
				
				this.title = this.affiliatePayout.name;

				document.title = this.title;

			},

			async fetchAffiliatePayout() {

				let res = await showModel(this.affiliatePayoutId);

				this.affiliatePayout = res;

            },

		}

	}

</script>