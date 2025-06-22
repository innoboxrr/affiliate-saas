<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affiliate-click="affiliateClick" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:affiliate-click="affiliateClick" />
	    				
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

	import { showModel } from '@affiliateModels/affiliate-click'
	import ModelCard from '@affiliateModels/affiliate-click/widgets/ModelCard.vue'
	import ModelProfile from '@affiliateModels/affiliate-click/widgets/ModelProfile.vue'

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

				affiliateClickId: this.$route.params.id,

				affiliateClick: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffiliateClick');

			},

			items() {

				if(this.$route.name == 'AdminShowAffiliateClick') {

					return [
						{ text: 'AffiliateClicks', path: '/admin/affiliate-click'},
						{ text: this.affiliate-click.name ?? 'AffiliateClick', path: '/admin/affiliate-click/' + this.affiliate-click.id}
					];

				} else if(this.$route.name == 'AdminEditAffiliateClick') {

					return [
						{ text: 'AffiliateClicks', path: '/admin/affiliate-click'},
						{ text: this.affiliate-click.name ?? 'AffiliateClick' , path: '/admin/affiliate-click/' + this.affiliate-click.id},
						{ text: 'Editar affiliate-click', path: '/admin/affiliate-click/' + this.affiliate-click.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffiliateClick()

				this.dataLoaded = true;
				
				this.title = this.affiliateClick.name;

				document.title = this.title;

			},

			async fetchAffiliateClick() {

				let res = await showModel(this.affiliateClickId);

				this.affiliateClick = res;

            },

		}

	}

</script>