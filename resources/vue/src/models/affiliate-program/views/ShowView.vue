<template>

	<div v-if="dataLoaded">

		<breadcrumbs-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affiliate-program="affiliateProgram" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:affiliate-program="affiliateProgram" />
	    				
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

	import { showModel } from '@affiliateModels/affiliate-program'
	import ModelCard from '@affiliateModels/affiliate-program/widgets/ModelCard.vue'
	import ModelProfile from '@affiliateModels/affiliate-program/widgets/ModelProfile.vue'

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

				affiliateProgramId: this.$route.params.id,

				affiliateProgram: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffiliateProgram');

			},

			items() {

				if(this.$route.name == 'AdminShowAffiliateProgram') {

					return [
						{ text: 'AffiliatePrograms', path: '/admin/affiliate-program'},
						{ text: this.affiliate-program.name ?? 'AffiliateProgram', path: '/admin/affiliate-program/' + this.affiliate-program.id}
					];

				} else if(this.$route.name == 'AdminEditAffiliateProgram') {

					return [
						{ text: 'AffiliatePrograms', path: '/admin/affiliate-program'},
						{ text: this.affiliate-program.name ?? 'AffiliateProgram' , path: '/admin/affiliate-program/' + this.affiliate-program.id},
						{ text: 'Editar affiliate-program', path: '/admin/affiliate-program/' + this.affiliate-program.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffiliateProgram()

				this.dataLoaded = true;
				
				this.title = this.affiliateProgram.name;

				document.title = this.title;

			},

			async fetchAffiliateProgram() {

				let res = await showModel(this.affiliateProgramId);

				this.affiliateProgram = res;

            },

		}

	}

</script>