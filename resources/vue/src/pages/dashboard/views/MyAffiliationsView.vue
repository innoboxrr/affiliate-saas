<template>
    <div>
        <div v-if="$route.query.test">
            <dashboard-header :title="__affiliate('My Affiliations')" />
            <stats-grid :cards="cards" />
            <charts-grid 
                :chart-rows="charts" 
                @updatePeriod="chartUpdatePeriodHandler"
                @viewReport="chartViewReportHandler" />
        </div>
        <div v-else>
            <under-construction />
        </div>
    </div>
</template>

<script>
    import UnderConstruction from '@affiliateComponents/partials/UnderConstruction.vue';
    import DashboardHeader from './../components/headers/DashboardHeader.vue';
    import StatsGrid from './../components/stats/StatsGrid.vue';
    import ChartsGrid from './../components/charts/ChartsGrid.vue';
    import { fetchCards } from './../api/fetch-my-affiliations-cards.js';
    import { fetchCharts } from './../api/fetch-my-affiliations-charts.js';

    export default {
        name: "dealDashboardSection",
        components: {
            UnderConstruction,
            DashboardHeader,
            StatsGrid,
            ChartsGrid,
        },
        data() {
            return {
                cards: [],
                charts: [],
            };
        },
        async mounted() {
            this.cards = await fetchCards();
            this.charts = await fetchCharts();
            console.log(this.charts);
        },
        methods: {
            chartUpdatePeriodHandler(period) {
                //
            },
            chartViewReportHandler(report) {
                // 
            }
        }
    };
</script>