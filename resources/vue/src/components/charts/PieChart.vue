<template>
    <div 
        v-flowbite 
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-start w-full">
            <div class="flex-col items-center">
                <div class="flex items-center mb-1">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">{{ title }}</h5>
                    <svg :data-popover-target="popoverId" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
                    </svg>
                    <div :id="popoverId" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ tooltipTitle }}</h3>
                            <p>{{ tooltipDescription }}</p>
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ tooltipCalcTitle }}</h3>
                            <p>{{ tooltipCalcText }}</p>
                            <a :href="tooltipLink" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">{{ tooltipLinkLabel }}
                                <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CHART -->
        <div class="py-6" :id="chartId"></div>

        <!-- FOOTER -->
        <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
            <div class="flex justify-between items-center pt-5">
                <button
                    :id="`dropdownDefaultButton-${chartId}`"
                    :data-dropdown-toggle="`dropdown-${chartId}`"
                    data-dropdown-placement="right"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                    type="button">
                    {{ selectedPeriodLabel }}
                    <i class="fa-solid fa-caret-down text-gray-500 dark:text-gray-400 ms-1"></i>
                </button>

                <div :id="`dropdown-${chartId}`" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="`dropdownDefaultButton-${chartId}`">
                        <li v-for="period in periods" :key="period.key">
                            <a href="#" @click.prevent="selectPeriod(period)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{ period.label }}
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="#" @click.prevent="$emit('viewReport', chartId)" class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 px-3 py-2">
                    {{ reportLabel }}
                    <i class="fa-solid fa-arrow-right text-blue-600 dark:text-blue-500 ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import ApexCharts from 'apexcharts';

export default {
    name: 'PieChart',
    props: {
        chartId: { type: String, required: true },
        series: { type: Array, required: true },
        labels: { type: Array, required: true },
        colors: { type: Array, default: () => ['#1C64F2', '#16BDCA', '#9061F9'] },
        chartHeight: { type: Number, default: 350 },
        title: { type: String, default: 'Website traffic' },
        tooltipTitle: String,
        tooltipDescription: String,
        tooltipCalcTitle: String,
        tooltipCalcText: String,
        tooltipLink: { type: String, default: '#' },
        tooltipLinkLabel: { type: String, default: 'Read more' },
        reportLabel: { type: String, default: 'Users Report' },
        periods: {
            type: Array,
            default: () => [
                { key: 'yesterday', label: 'Yesterday' },
                { key: 'today', label: 'Today' },
                { key: 'last_7_days', label: 'Last 7 days' },
                { key: 'last_30_days', label: 'Last 30 days' },
                { key: 'last_90_days', label: 'Last 90 days' },
            ]
        },
        defaultPeriod: { type: String, default: 'last_7_days' },
    },
    emits: ['updatePeriod', 'viewReport'],
    data() {
        return {
            selectedPeriod: this.defaultPeriod
        };
    },
    computed: {
        selectedPeriodLabel() {
            const period = this.periods.find(p => p.key === this.selectedPeriod);
            return period ? period.label : '';
        },
        popoverId() {
            return `popover-${this.chartId}`;
        }
    },
    mounted() {
        this.renderChart();
    },
    methods: {
        selectPeriod(period) {
            this.selectedPeriod = period.key;
            this.$emit('updatePeriod', { chartId: this.chartId, period: period.key });
        },
        renderChart() {
            const options = {
                series: this.series,
                labels: this.labels,
                colors: this.colors,
                chart: {
                    type: 'pie',
                    height: this.chartHeight,
                    width: '100%',
                    fontFamily: 'Inter, sans-serif'
                },
                stroke: {
                    colors: ['white'],
                    lineCap: ''
                },
                plotOptions: {
                    pie: {
                        labels: { show: true },
                        size: '100%',
                        dataLabels: {
                            offset: -25
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: 'Inter, sans-serif'
                    }
                },
                legend: {
                    position: 'bottom',
                    fontFamily: 'Inter, sans-serif'
                },
                yaxis: {
                    labels: {
                        formatter: value => `${value}%`
                    }
                },
                xaxis: {
                    labels: {
                        formatter: value => `${value}%`
                    },
                    axisTicks: { show: false },
                    axisBorder: { show: false }
                }
            };

            const el = document.getElementById(this.chartId);
            if (el && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(el, options);
                chart.render();
            }
        }
    }
}
</script>