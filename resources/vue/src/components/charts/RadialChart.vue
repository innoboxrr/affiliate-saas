<template>
    <div 
        v-flowbite
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">

        <!-- HEADER -->
        <div class="flex justify-between mb-3">
            <div class="flex items-center">
                <div class="flex justify-center items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">{{ title }}</h5>
                    <svg :data-popover-target="popoverId" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
                    </svg>
                    <div :id="popoverId" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-xs opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ tooltipTitle }}</h3>
                            <p>{{ tooltipDescription }}</p>
                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ tooltipCalcTitle }}</h3>
                            <p>{{ tooltipCalcText }}</p>
                            <a :href="tooltipLink" class="flex items-center font-medium text-blue-600 dark:text-blue-500 dark:hover:text-blue-600 hover:text-blue-700 hover:underline">
                                {{ tooltipLinkLabel }}
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

        <!-- STATUS CARDS -->
        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
            <div class="grid grid-cols-3 gap-3 mb-2">
                <dl v-for="(item, index) in statuses" :key="index" :class="`bg-${item.bg} dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]`">
                    <dt :class="`w-8 h-8 rounded-full bg-${item.circleBg} dark:bg-gray-500 text-${item.text} dark:text-${item.textDark} text-sm font-medium flex items-center justify-center mb-1`">
                        {{ item.value }}
                    </dt>
                    <dd :class="`text-${item.text} dark:text-${item.textDark} text-sm font-medium`">
                        {{ item.label }}
                    </dd>
                </dl>
            </div>
            <button data-collapse-toggle="more-details" type="button" class="hover:underline text-xs text-gray-500 dark:text-gray-400 font-medium inline-flex items-center">
                {{ collapseLabel }}
                <svg class="w-2 h-2 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
            </button>
            <div id="more-details" class="border-gray-200 border-t dark:border-gray-600 pt-3 mt-3 space-y-2 hidden">
                <dl v-for="(detail, i) in details" :key="i" class="flex items-center justify-between">
                    <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal">{{ detail.label }}</dt>
                    <dd :class="detail.class">
                        <component :is="detail.icon" v-if="detail.icon" class="me-1.5 w-2.5 h-2.5" />
                        {{ detail.value }}
                    </dd>
                </dl>
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
    name: 'RadialChart',
    props: {
        chartId: { type: String, required: true },
        series: { type: Array, required: true },
        labels: { type: Array, required: true },
        colors: { type: Array, required: true },
        title: { type: String, default: 'Your team\'s progress' },
        statuses: { type: Array, required: true },
        details: { type: Array, required: true },
        collapseLabel: { type: String, default: 'Show more details' },
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
        defaultPeriod: { type: String, default: 'last_7_days' }
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
                    height: 350,
                    width: '100%',
                    type: 'radialBar',
                    sparkline: { enabled: true }
                },
                plotOptions: {
                    radialBar: {
                        track: { background: '#E5E7EB' },
                        dataLabels: { show: false },
                        hollow: { margin: 0, size: '32%' }
                    }
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: { left: 2, right: 2, top: -23, bottom: -20 }
                },
                legend: {
                    show: true,
                    position: 'bottom',
                    fontFamily: 'Inter, sans-serif'
                },
                tooltip: {
                    enabled: true,
                    x: { show: false }
                },
                yaxis: {
                    show: false,
                    labels: {
                        formatter: value => `${value}%`
                    }
                }
            };

            const el = document.getElementById(this.chartId);
            if (el && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(el, options);
                chart.render();
            }
        }
    }
};
</script>
