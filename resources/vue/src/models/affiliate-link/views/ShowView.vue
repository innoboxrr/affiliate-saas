<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affiliate-link="affiliateLink" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

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

	import { showModel } from '@affiliatesModels/affiliate-link'
	import ModelCard from '@affiliatesModels/affiliate-link/widgets/ModelCard.vue'
	import ModelProfile from '@affiliatesModels/affiliate-link/widgets/ModelProfile.vue'

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
						{ text: this.affiliate-link.name ?? 'AffiliateLink', path: '/admin/affiliate-link/' + this.affiliate-link.id}
					];

				} else if(this.$route.name == 'AdminEditAffiliateLink') {

					return [
						{ text: 'AffiliateLinks', path: '/admin/affiliate-link'},
						{ text: this.affiliate-link.name ?? 'AffiliateLink' , path: '/admin/affiliate-link/' + this.affiliate-link.id},
						{ text: 'Editar affiliate-link', path: '/admin/affiliate-link/' + this.affiliate-link.id + '/edit'}	
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