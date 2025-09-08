<template>
    <div>
        <div v-if="$route.query.test">
            <dashboard-header :title="__affiliate('Dashboard')" />
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
    import { fetchCards } from './../api/fetch-dashboard-cards.js';
    import { fetchCharts } from './../api/fetch-dashboard-charts.js';

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