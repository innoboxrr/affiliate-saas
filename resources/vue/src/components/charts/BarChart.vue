<template>
    <div v-flowbite class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        <!-- PROFIT SECTION -->
        <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
            <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">{{ profitLabel }}</dt>
                <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">{{ profitValue }}</dd>
            </dl>
            <div>
                <span :class="ratePositive ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'"
                      class="text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md">
                    <i :class="['fa-solid mr-2', ratePositive ? 'fa-arrow-up text-green-500 dark:text-green-400' : 'fa-arrow-down text-red-500 dark:text-red-400']"></i>
                    {{ rateLabel }} {{ rateValue }}%
                </span>
            </div>
        </div>

        <!-- METRICS -->
        <div class="grid grid-cols-2 py-3 justify-between items-center">
            <dl v-for="(metric, index) in metrics" :key="index">
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">{{ metric.label }}</dt>
                <dd :class="getClassByValue(metric.value)" class="leading-none text-xl font-bold">{{ metric.value }}</dd>
            </dl>
        </div>

        <!-- CHART -->
        <div :id="chartId"></div>

        <!-- FOOTER COMPACTO -->
        <div class="flex items-center justify-between gap-2 border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
            <!-- Dropdown -->
            <div class="relative">
                <button
                    :id="`dropdownDefaultButton-${chartId}`"
                    :data-dropdown-toggle="`dropdown-${chartId}`"
                    data-dropdown-placement="bottom-start"
                    class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white inline-flex items-center"
                    type="button">
                    {{ selectedPeriodLabel }}
                    <i class="fa-solid fa-caret-down text-gray-500 dark:text-gray-400 ml-1"></i>
                </button>

                <div
                    :id="`dropdown-${chartId}`"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul
                        class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        :aria-labelledby="`dropdownDefaultButton-${chartId}`">
                        <li v-for="period in periods" :key="period.key">
                            <a
                                href="#"
                                @click.prevent="handlePeriodSelect ? handlePeriodSelect(period) : selectPeriod(period)"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{ period.label }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Link a reporte -->
            <a
                href="#"
                @click.prevent="$emit('viewReport', chartId)"
                class="text-sm font-semibold text-blue-600 hover:text-blue-700 dark:hover:text-blue-500 inline-flex items-center whitespace-nowrap">
                {{ reportLabel || 'VER REPORTE' }}
                <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</template>

<script>
import ApexCharts from 'apexcharts';

export default {
    name: 'BarChart',
    props: {
        chartId: String,
        series: Array,
        categories: Array,
        horizontal: Boolean,
        columnWidth: String,
        borderRadius: Number,
        borderRadiusApplication: String,
        chartHeight: Number,
        profitLabel: String,
        profitValue: String,
        rateLabel: String,
        rateValue: Number,
        ratePositive: Boolean,
        metrics: {
            type: Array,
            default: () => []
        },
        periods: {
            type: Array,
            default: () => []
        },
        defaultPeriod: String,
        reportLabel: String,
        replaceOptions: Object,
        
    },
    data() {
        return {
            selectedPeriod: this.defaultPeriod
        }
    },
    computed: {
        selectedPeriodLabel() {
            const period = this.periods.find(p => p.key === this.selectedPeriod);
            return period ? period.label : '';
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.renderChart();
        });
    },
    methods: {
        getClassByValue(value) {
            const n = parseFloat((value + '').replace(/[^0-9.-]+/g, ''));
            return n >= 0 ? 'text-green-500 dark:text-green-400' : 'text-red-600 dark:text-red-500';
        },
        selectPeriod(period) {
            this.selectedPeriod = period.key;
            this.$emit('updatePeriod', period.key);
        },
        renderChart() {
            const defaultOptions = {
                series: this.series,
                chart: {
                    type: 'bar',
                    height: this.chartHeight || 200,
                    toolbar: { show: false },
                    sparkline: { enabled: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: this.horizontal,
                        columnWidth: this.columnWidth,
                        borderRadius: this.borderRadius,
                        borderRadiusApplication: this.borderRadiusApplication,
                        dataLabels: { position: 'top' }
                    }
                },
                legend: { show: true, position: 'bottom' },
                dataLabels: { enabled: false },
                tooltip: {
                    shared: true,
                    intersect: false,
                    formatter: val => `$${val}`
                },
                xaxis: {
                    categories: this.categories,
                    labels: {
                        show: true,
                        style: {
                            fontFamily: 'Inter, sans-serif',
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        },
                        formatter: val => `$${val}`
                    },
                    axisTicks: { show: false },
                    axisBorder: { show: false }
                },
                yaxis: {
                    labels: {
                        show: true,
                        style: {
                            fontFamily: 'Inter, sans-serif',
                            cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                        }
                    }
                },
                grid: {
                    show: true,
                    strokeDashArray: 4,
                    padding: { left: 2, right: 2, top: -20 }
                },
                fill: { opacity: 1 }
            };

            const chart = new ApexCharts(
                document.getElementById(this.chartId),
                this.replaceOptions || defaultOptions
            );
            chart.render();
        }
    }
}
</script>
