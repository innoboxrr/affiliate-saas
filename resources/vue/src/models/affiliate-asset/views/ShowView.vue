<template>

	<div v-if="dataLoaded">

		<breadcrumbs-component :items="items" />
	    
	    <div class="uk-container uk-container-expand mt-4">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affiliate-asset="affiliateAsset" />

	    		</div>

	    		<div class="uk-width-expand">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:affiliate-asset="affiliateAsset" />
	    				
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

	import { showModel } from '@affiliateModels/affiliate-asset'
	import ModelCard from '@affiliateModels/affiliate-asset/widgets/ModelCard.vue'
	import ModelProfile from '@affiliateModels/affiliate-asset/widgets/ModelProfile.vue'

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

				affiliateAssetId: this.$route.params.id,

				affiliateAsset: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffiliateAsset');

			},

			items() {

				if(this.$route.name == 'AdminShowAffiliateAsset') {

					return [
						{ text: 'AffiliateAssets', path: '/admin/affiliate-asset'},
						{ text: this.affiliateAsset.name ?? 'AffiliateAsset', path: '/admin/affiliate-asset/' + this.affiliateAsset.id}
					];

				} else if(this.$route.name == 'AdminEditAffiliateAsset') {

					return [
						{ text: 'AffiliateAssets', path: '/admin/affiliate-asset'},
						{ text: this.affiliateAsset.name ?? 'AffiliateAsset' , path: '/admin/affiliate-asset/' + this.affiliateAsset.id},
						{ text: 'Editar affiliate-asset', path: '/admin/affiliate-asset/' + this.affiliateAsset.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffiliateAsset()

				this.dataLoaded = true;
				
				this.title = this.affiliateAsset.name;

				document.title = this.title;

			},

			async fetchAffiliateAsset() {

				let res = await showModel(this.affiliateAssetId);

				this.affiliateAsset = res;

            },

		}

	}

</script>