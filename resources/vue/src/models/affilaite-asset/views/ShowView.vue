<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:Affiliate-asset="AffiliateAsset" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:Affiliate-asset="AffiliateAsset" />
	    				
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

				AffiliateAssetId: this.$route.params.id,

				AffiliateAsset: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffiliateAsset');

			},

			items() {

				if(this.$route.name == 'AdminShowAffiliateAsset') {

					return [
						{ text: 'AffiliateAssets', path: '/admin/Affiliate-asset'},
						{ text: this.Affiliate-asset.name ?? 'AffiliateAsset', path: '/admin/Affiliate-asset/' + this.Affiliate-asset.id}
					];

				} else if(this.$route.name == 'AdminEditAffiliateAsset') {

					return [
						{ text: 'AffiliateAssets', path: '/admin/Affiliate-asset'},
						{ text: this.Affiliate-asset.name ?? 'AffiliateAsset' , path: '/admin/Affiliate-asset/' + this.Affiliate-asset.id},
						{ text: 'Editar Affiliate-asset', path: '/admin/Affiliate-asset/' + this.Affiliate-asset.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffiliateAsset()

				this.dataLoaded = true;
				
				this.title = this.AffiliateAsset.name;

				document.title = this.title;

			},

			async fetchAffiliateAsset() {

				let res = await showModel(this.AffiliateAssetId);

				this.AffiliateAsset = res;

            },

		}

	}

</script>