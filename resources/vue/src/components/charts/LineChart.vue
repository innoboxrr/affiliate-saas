<template>
    <div 
        v-flowbite 
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <div class="w-full mx-auto">
            <div class="flex justify-between items-center mb-4">
                <div v-for="(metric, index) in metrics" :key="index">
                    <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">
                        {{ metric.label }}
                        <i class="fa-solid fa-circle-info text-xs ml-2"></i>
                    </h5>
                    <p class="text-gray-900 dark:text-white text-xl leading-none font-bold">
                        {{ metric.value }}
                    </p>
                </div>
            </div>
        </div>
        <div :id="chartId"></div>
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
                <div 
                    :id="`dropdown-${chartId}`" 
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="`dropdownDefaultButton-${chartId}`">
                        <li v-for="period in periods" :key="period.key">
                            <a href="#" @click.prevent="selectPeriod(period)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{ period.label }}
                            </a>
                        </li>
                    </ul>
                </div>
                <a
                    href="#"
                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    {{ reportLabel || 'Reporte' }}
                    <i class="fa-solid fa-arrow-right text-blue-600 dark:text-blue-500 ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
import ApexCharts from 'apexcharts';

export default {
    name: 'LineChart',
    props: {
        chartId: {
            type: String,
            default: 'line-chart'
        },
        metrics: {
            type: Array,
            default: () => []
        },
        series: {
            type: Array,
            required: true
        },
        categories: {
            type: Array,
            required: true
        },
        reportLabel: String,
        periods: {
            type: Array,
            default: () => ([
                { key: 'yesterday', label: 'Ayer' },
                { key: 'today', label: 'Hoy' },
                { key: 'last_7_days', label: 'Últimos 7 días' },
                { key: 'last_30_days', label: 'Últimos 30 días' },
                { key: 'last_90_days', label: 'Últimos 90 días' }
            ])
        },
        defaultPeriod: {
            type: String,
            default: 'last_7_days'
        },
        formatValue: {
            type: Function,
            default: (serie, value) => value
        }
    },
    data() {
        return {
            selectedPeriod: this.defaultPeriod
        }
    },
    computed: {
        selectedPeriodLabel() {
            const p = this.periods.find(p => p.key === this.selectedPeriod);
            return p ? p.label : ''
        }
    },
    mounted() {
        this.renderChart();
    },
    methods: {
        selectPeriod(period) {
            this.selectedPeriod = period.key;
            this.$emit('updatePeriod', period.key);
        },
        renderChart() {
            const options = {
                chart: {
                    height: 265,
                    maxWidth: '100%',
                    type: 'line',
                    fontFamily: 'Inter, sans-serif',
                    dropShadow: { enabled: false },
                    toolbar: { show: false },
                },
                stroke: {
                    width: 6,
                    curve: 'smooth'
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: { left: 2, right: 2, top: -26 },
                },
                series: this.series,
                dataLabels: {
                    enabled: false,
                    formatter: (value, opts) => {
                        const serieName = opts.w.config.series[opts.seriesIndex].name;
                        return this.formatValue(serieName, value);
                    }
                },
                tooltip: {
                    enabled: true,
                    y: {
                        formatter: (value, opts) => {
                            const serieName = opts.w.config.series[opts.seriesIndex].name;
                            return this.formatValue(serieName, value);
                        }
                    }
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: this.categories,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: 'Inter, sans-serif',
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                },
                yaxis: {
                    show: false
                },
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
