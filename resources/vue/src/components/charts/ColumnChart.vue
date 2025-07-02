<template>
    <div 
        v-flowbite 
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">

        <!-- HEADER -->
        <div class="flex justify-between border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center me-3">
                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 19">
                        <path d="M14.5 0A3.987 3.987 0 0 0 11 2.1a4.977 4.977 0 0 1 3.9 5.858A3.989 3.989 0 0 0 14.5 0ZM9 13h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z"/>
                        <path d="M5 19h10v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2ZM5 7a5.008 5.008 0 0 1 4-4.9 3.988 3.988 0 1 0-3.9 5.859A4.974 4.974 0 0 1 5 7Zm5 3a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm5-1h-.424a5.016 5.016 0 0 1-1.942 2.232A6.007 6.007 0 0 1 17 17h2a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5ZM5.424 9H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h2a6.007 6.007 0 0 1 4.366-5.768A5.016 5.016 0 0 1 5.424 9Z"/>
                    </svg>
                </div>
                <div>
                    <h5 class="leading-none text-2xl font-bold text-gray-900 dark:text-white pb-1">{{ value }}</h5>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ label }}</p>
                </div>
            </div>
            <div>
                <span
                    :class="percentage >= 0 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'"
                    class="text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md">
                    <i :class="['fa-solid mr-2', percentage >= 0 ? 'fa-arrow-up text-green-500 dark:text-green-400' : 'fa-arrow-down text-red-500 dark:text-red-400']"></i>
                    {{ percentage }}%
                </span>
            </div>
        </div>

        <!-- METRICS -->
        <div class="grid grid-cols-2 py-3">
            <dl v-for="(metric, index) in metrics" :key="index" class="flex items-center">
                <dt class="text-gray-500 dark:text-gray-400 text-sm font-normal me-1">{{ metric.label }}</dt>
                <dd class="text-gray-900 dark:text-white text-sm font-semibold">{{ metric.value }}</dd>
            </dl>
        </div>

        <!-- CHART -->
        <div :id="chartId"></div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-5 mt-5">
            <!-- Dropdown -->
            <div class="relative">
                <button
                    :id="`dropdownDefaultButton-${chartId}`"
                    :data-dropdown-toggle="`dropdown-${chartId}`"
                    data-dropdown-placement="bottom-start"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white inline-flex items-center"
                    type="button">
                    {{ selectedPeriodLabel }}
                    <i class="fa-solid fa-caret-down text-gray-500 dark:text-gray-400 ms-1"></i>
                </button>

                <div
                    :id="`dropdown-${chartId}`"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="`dropdownDefaultButton-${chartId}`">
                        <li v-for="period in periods" :key="period.key">
                            <a
                                href="#"
                                @click.prevent="selectPeriod(period)"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{ period.label }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Report -->
            <a
                href="#"
                @click.prevent="$emit('viewReport', chartId)"
                class="uppercase text-sm font-semibold inline-flex items-center text-blue-600 hover:text-blue-700 dark:hover:text-blue-500">
                {{ reportLabel || 'Ver reporte' }}
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</template>

<script>
import ApexCharts from 'apexcharts';

export default {
    name: 'ColumnChart',
    props: {
        chartId: {
            type: String,
            required: true
        },
        value: [String, Number],
        label: String,
        percentage: Number,
        metrics: {
            type: Array,
            default: () => []
        },
        periods: {
            type: Array,
            default: () => [
                { key: 'yesterday', label: 'Ayer' },
                { key: 'today', label: 'Hoy' },
                { key: 'last_7_days', label: 'Últimos 7 días' },
                { key: 'last_30_days', label: 'Últimos 30 días' },
                { key: 'last_90_days', label: 'Últimos 90 días' }
            ]
        },
        defaultPeriod: {
            type: String,
            default: 'last_7_days'
        },
        reportLabel: String,
        series: Array,
        colors: {
            type: Array,
            default: () => ['#4F46E5', '#3B82F6', '#10B981', '#F59E0B', '#EF4444']
        },
    },
    data() {
        return {
            selectedPeriod: this.defaultPeriod
        };
    },
    computed: {
        selectedPeriodLabel() {
            const period = this.periods.find(p => p.key === this.selectedPeriod);
            return period ? period.label : '';
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
                colors: this.colors,
                series: this.series || [],
                chart: {
                    type: "bar",
                    height: 250,
                    fontFamily: "Inter, sans-serif",
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "70%",
                        borderRadiusApplication: "end",
                        borderRadius: 8
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                    style: { fontFamily: "Inter, sans-serif" }
                },
                stroke: {
                    show: true,
                    width: 0,
                    colors: ["transparent"]
                },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: { left: 2, right: 2, top: -14 }
                },
                dataLabels: { enabled: false },
                legend: { show: false },
                xaxis: {
                    labels: {
                        show: true,
                        style: {
                            fontFamily: "Inter, sans-serif",
                            cssClass: "text-xs font-normal fill-gray-500 dark:fill-gray-400"
                        }
                    },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: { show: false },
                fill: { opacity: 1 }
            };

            const chartEl = document.getElementById(this.chartId);
            if (chartEl && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(chartEl, options);
                chart.render();
            }
        }
    }
};
</script>
