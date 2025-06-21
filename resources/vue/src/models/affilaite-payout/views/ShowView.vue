<template>

	<div v-if="dataLoaded">

		<breadcrumb-component :items="items" />
	    
	    <div class="uk-container uk-container-expand">

	    	<div class="uk-grid-small" uk-grid>
	    		
	    		<div class="uk-width-1-3@m uk-width-1-1@s">

					<model-card 
						:affilaite-payout="affilaitePayout" />

	    		</div>

	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">

	    			<div v-if="this.isShowView">

	    				<model-profile 
	    					:affilaite-payout="affilaitePayout" />
	    				
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

	import { showModel } from '@affiliatesModels/affilaite-payout'
	import ModelCard from '@affiliatesModels/affilaite-payout/widgets/ModelCard.vue'
	import ModelProfile from '@affiliatesModels/affilaite-payout/widgets/ModelProfile.vue'

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

				affilaitePayoutId: this.$route.params.id,

				affilaitePayout: {},

			}
		
		},

		computed: {

			isShowView() {

				return (this.$route.name == 'AdminShowAffilaitePayout');

			},

			items() {

				if(this.$route.name == 'AdminShowAffilaitePayout') {

					return [
						{ text: 'AffilaitePayouts', path: '/admin/affilaite-payout'},
						{ text: this.affilaite-payout.name ?? 'AffilaitePayout', path: '/admin/affilaite-payout/' + this.affilaite-payout.id}
					];

				} else if(this.$route.name == 'AdminEditAffilaitePayout') {

					return [
						{ text: 'AffilaitePayouts', path: '/admin/affilaite-payout'},
						{ text: this.affilaite-payout.name ?? 'AffilaitePayout' , path: '/admin/affilaite-payout/' + this.affilaite-payout.id},
						{ text: 'Editar affilaite-payout', path: '/admin/affilaite-payout/' + this.affilaite-payout.id + '/edit'}	
					];

				}

			}

		},

		methods: {

			async fetchData() {

				await this.fetchAffilaitePayout()

				this.dataLoaded = true;
				
				this.title = this.affilaitePayout.name;

				document.title = this.title;

			},

			async fetchAffilaitePayout() {

				let res = await showModel(this.affilaitePayoutId);

				this.affilaitePayout = res;

            },

		}

	}

</script>