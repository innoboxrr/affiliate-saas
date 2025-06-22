<template>

	<div v-if="dataLoaded">

		<breadcrumbs-component :items="items" />
	    
	    <div class="uk-container uk-container-expand mt-4">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affiliate-link="affiliateLink" />

	    		</div>

	    		<div class="uk-width-expand">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:affiliate-link="affiliateLink" />
	    				
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

	import { showModel } from '@affiliateModels/affiliate-link'
	import ModelCard from '@affiliateModels/affiliate-link/widgets/ModelCard.vue'
	import ModelProfile from '@affiliateModels/affiliate-link/widgets/ModelProfile.vue'

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

				affiliateLinkId: this.$route.params.id,

				affiliateLink: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffiliateLink');

			},

			items() {

				if(this.$route.name == 'AdminShowAffiliateLink') {

					return [
						{ text: 'AffiliateLinks', path: '/admin/affiliate-link'},
						{ text: this.affiliateLink.name ?? 'AffiliateLink', path: '/admin/affiliate-link/' + this.affiliateLink.id}
					];

				} else if(this.$route.name == 'AdminEditAffiliateLink') {

					return [
						{ text: 'AffiliateLinks', path: '/admin/affiliate-link'},
						{ text: this.affiliateLink.name ?? 'AffiliateLink' , path: '/admin/affiliate-link/' + this.affiliateLink.id},
						{ text: 'Editar affiliate-link', path: '/admin/affiliate-link/' + this.affiliateLink.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffiliateLink()

				this.dataLoaded = true;
				
				this.title = this.affiliateLink.name;

				document.title = this.title;

			},

			async fetchAffiliateLink() {

				let res = await showModel(this.affiliateLinkId);

				this.affiliateLink = res;

            },

		}

	}

</script>