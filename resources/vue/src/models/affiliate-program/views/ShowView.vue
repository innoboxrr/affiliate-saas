<template>
	<div v-if="dataLoaded">
		<breadcrumbs-component :items="items" />
	    <div class="uk-container uk-container-expand mt-4">
	    	<div class="uk-grid-small" uk-grid>
	    		<div class="uk-width-1-3@m uk-width-1-1@s">
					<model-card :affiliate-program="affiliateProgram" />
					<program-documentation :affiliate-program="affiliateProgram" />
	    		</div>
	    		<div class="uk-width-expand">
	    			<div v-if="this.isShowView">
	    				<model-profile :affiliate-program="affiliateProgram" />

						<div class="bg-white dark:bg-slate-700 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800 uk-border-rounded uk-margin uk-padding-small">
							<h3 class="text-lg font-semibold mb-4">
								{{ __affiliate('Affiliates') }}
							</h3>
							<affiliate-data-table 
								:card-wrapper="false"
								:extra-query="{
									affiliate_program_id: affiliateProgram.id,
								}"
								:externalFilters="{ 
									program_id:  affiliateProgram.id,
								}" />
						</div>

						<div class="bg-white dark:bg-slate-700 border rounded-lg px-8 pt-6 pb-8 mb-4 dark:border-slate-800 uk-border-rounded uk-margin uk-padding-small">
							<h3 class="text-lg font-semibold mb-4">
								{{ __affiliate('Affiliate Assets') }}
							</h3>
							<affiliate-asset-data-table 
								:card-wrapper="false"
								:extra-query="{
									affiliate_program_id: affiliateProgram.id,
								}"
								:externalFilters="{ 
									program_id:  affiliateProgram.id,
								}" />
						</div>
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
	import ProgramDocumentation from '@affiliateModels/affiliate-program/widgets/ProgramDocumentation.vue'
	import AffiliateDataTable from '@affiliateModels/affiliate/widgets/DataTable.vue'
	import AffiliateAssetDataTable from '@affiliateModels/affiliate-asset/widgets/DataTable.vue'

	export default {
		components: {
			ModelCard,
			ModelProfile,
			ProgramDocumentation,
			AffiliateDataTable,
			AffiliateAssetDataTable,
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
						{ text: this.affiliateProgram.name ?? 'AffiliateProgram', path: '/admin/affiliate-program/' + this.affiliateProgram.id}
					];
				} else if(this.$route.name == 'AdminEditAffiliateProgram') {
					return [
						{ text: 'AffiliatePrograms', path: '/admin/affiliate-program'},
						{ text: this.affiliateProgram.name ?? 'AffiliateProgram' , path: '/admin/affiliate-program/' + this.affiliateProgram.id},
						{ text: 'Editar affiliate-program', path: '/admin/affiliate-program/' + this.affiliateProgram.id + '/edit'}	
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