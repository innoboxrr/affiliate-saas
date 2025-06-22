<template>

	<div v-if="dataLoaded">

		<breadcrumbs-component :items="items" />
	    
	    <div class="uk-container uk-container-expand mt-4">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affiliate-conversion="affiliateConversion" />

	    		</div>

	    		<div class="uk-width-expand">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:affiliate-conversion="affiliateConversion" />
	    				
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

	import { showModel } from '@affiliateModels/affiliate-conversion'
	import ModelCard from '@affiliateModels/affiliate-conversion/widgets/ModelCard.vue'
	import ModelProfile from '@affiliateModels/affiliate-conversion/widgets/ModelProfile.vue'

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

				affiliateConversionId: this.$route.params.id,

				affiliateConversion: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffiliateConversion');

			},

			items() {

				if(this.$route.name == 'AdminShowAffiliateConversion') {

					return [
						{ text: 'AffiliateConversions', path: '/admin/affiliate-conversion'},
						{ text: this.affiliateConversion.name ?? 'AffiliateConversion', path: '/admin/affiliate-conversion/' + this.affiliateConversion.id}
					];

				} else if(this.$route.name == 'AdminEditAffiliateConversion') {

					return [
						{ text: 'AffiliateConversions', path: '/admin/affiliate-conversion'},
						{ text: this.affiliateConversion.name ?? 'AffiliateConversion' , path: '/admin/affiliate-conversion/' + this.affiliateConversion.id},
						{ text: 'Editar affiliate-conversion', path: '/admin/affiliate-conversion/' + this.affiliateConversion.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffiliateConversion()

				this.dataLoaded = true;
				
				this.title = this.affiliateConversion.name;

				document.title = this.title;

			},

			async fetchAffiliateConversion() {

				let res = await showModel(this.affiliateConversionId);

				this.affiliateConversion = res;

            },

		}

	}

</script>