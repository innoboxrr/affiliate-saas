<template>
	<div id="AdminAffiliatesWrapper">
		<div v-if="isHome">
			<breadcrumbs-component 
				:pages="[
					{ link: $router.resolve({ name: 'AdminAffiliates' }).fullPath, title: 'Affiliates'}
				]"/>
			<data-table 
				:show-title="false"
				:hide-columns="hideColumns"
				:key="crudKey" />
		</div>
		<div v-else>
			<router-view @updateData="updateDatatable"></router-view>
		</div>
	</div>
</template>

<script>
	import DataTable from '@affiliateModels/affiliate/widgets/DataTable.vue'
	export default {
		components: {
			DataTable
		},
		data() {
			return {
				title: undefined,
				crudKey: 0,
			}
		},
		computed: {
			isHome() {
				return (this.$route.name == 'AdminAffiliates');
			},
			hideColumns() {
				if(false) {
					this.updateDatatable();
					return [];
				}
				return [];
			}
		},
		methods: {
			updateDatatable() {
				++this.crudKey;
			},
		}
	}
</script>