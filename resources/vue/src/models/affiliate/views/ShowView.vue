<template>
	<div v-if="dataLoaded">
		<breadcrumbs-component :items="items" />
	    <div class="uk-container uk-container-expand">
	    	<div class="uk-grid-small" uk-grid>
	    		<div class="uk-width-1-3@m uk-width-1-1@s">
					<model-card 
						:affiliate="affiliate" />
	    		</div>
	    		<div class="uk-width-expand uk-width-1-2@m uk-width-1-1@s">
	    			<div v-if="this.isShowView">
	    				<model-profile 
	    					:affiliate="affiliate" />
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

	import { showModel } from '@affiliateModels/affiliate'
	import ModelCard from '@affiliateModels/affiliate/widgets/ModelCard.vue'
	import ModelProfile from '@affiliateModels/affiliate/widgets/ModelProfile.vue'

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
				affiliateId: this.$route.params.id,
				affiliate: {},
			}
		},
		computed: {
			isShowView() {
				return (this.$route.name == 'AdminShowAffiliate');
			},
			items() {
				if(this.$route.name == 'AdminShowAffiliate') {
					return [
						{ text: 'Affiliates', path: '/admin/affiliate'},
						{ text: this.affiliate.name ?? 'Affiliate', path: '/admin/affiliate/' + this.affiliate.id}
					];
				} else if(this.$route.name == 'AdminEditAffiliate') {
					return [
						{ text: 'Affiliates', path: '/admin/affiliate'},
						{ text: this.affiliate.name ?? 'Affiliate' , path: '/admin/affiliate/' + this.affiliate.id},
						{ text: 'Editar affiliate', path: '/admin/affiliate/' + this.affiliate.id + '/edit'}	
					];
				}
			}
		},
		methods: {
			async fetchData() {
				await this.fetchAffiliate()
				this.dataLoaded = true;
				this.title = this.affiliate.name;
				document.title = this.title;
			},
			async fetchAffiliate() {
				let res = await showModel(this.affiliateId);
				this.affiliate = res;
            },
		}
	}
</script>