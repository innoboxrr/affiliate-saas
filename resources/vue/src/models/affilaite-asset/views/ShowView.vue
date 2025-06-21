<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affilaite-asset="affilaiteAsset" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:affilaite-asset="affilaiteAsset" />
	    				
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

	import { showModel } from '@affiliatesModels/affilaite-asset'
	import ModelCard from '@affiliatesModels/affilaite-asset/widgets/ModelCard.vue'
	import ModelProfile from '@affiliatesModels/affilaite-asset/widgets/ModelProfile.vue'

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

				affilaiteAssetId: this.$route.params.id,

				affilaiteAsset: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffilaiteAsset');

			},

			items() {

				if(this.$route.name == 'AdminShowAffilaiteAsset') {

					return [
						{ text: 'AffilaiteAssets', path: '/admin/affilaite-asset'},
						{ text: this.affilaite-asset.name ?? 'AffilaiteAsset', path: '/admin/affilaite-asset/' + this.affilaite-asset.id}
					];

				} else if(this.$route.name == 'AdminEditAffilaiteAsset') {

					return [
						{ text: 'AffilaiteAssets', path: '/admin/affilaite-asset'},
						{ text: this.affilaite-asset.name ?? 'AffilaiteAsset' , path: '/admin/affilaite-asset/' + this.affilaite-asset.id},
						{ text: 'Editar affilaite-asset', path: '/admin/affilaite-asset/' + this.affilaite-asset.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffilaiteAsset()

				this.dataLoaded = true;
				
				this.title = this.affilaiteAsset.name;

				document.title = this.title;

			},

			async fetchAffilaiteAsset() {

				let res = await showModel(this.affilaiteAssetId);

				this.affilaiteAsset = res;

            },

		}

	}

</script>