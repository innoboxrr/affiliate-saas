<template>
    <div 
        v-flowbite
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">
        
        <!-- HEADER: Valor principal + porcentaje -->
        <div class="flex justify-between">
            <div>
                <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">
                    {{ value }}
                </h5>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                    {{ label }}
                </p>
            </div>
            <div
                class="flex items-center px-2.5 py-0.5 text-base font-semibold"
                :class="percentage >= 0 ? 'text-green-500' : 'text-red-500'">
                {{ percentage }}%
                <i
                    :class="[ 
                        'fa-solid ms-1', 
                        percentage >= 0 ? 'fa-arrow-up text-green-500' : 'fa-arrow-down text-red-500' 
                    ]"></i>
            </div>
        </div>

        <!-- CHART -->
        <div class="mt-6" :id="chartId"></div>

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
    name: 'AreaChart',
    props: {
        chartId: {
            type: String,
            default: 'area-chart'
        },
        label: {
            type: String,
            required: true
        },
        value: {
            type: [String, Number],
            required: true
        },
        percentage: {
            type: Number,
            default: 0
        },
        categories: {
            type: Array,
            required: true
        },
        series: {
            type: Array,
            required: true
        },
        color: {
            type: String,
            default: '#1A56DB'
        },
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
        chartHeight: {
            type: Number,
            default: 200
        },
    },
    emits: ['updatePeriod', 'viewReport'],
    data() {
        return {
            selectedPeriodKey: this.defaultPeriod
        };
    },
    computed: {
        selectedPeriodLabel() {
            const period = this.periods.find(p => p.key === this.selectedPeriodKey);
            return period ? period.label : '';
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.renderChart();
        });
    },
    methods: {
        handlePeriodSelect(period) {
            this.selectedPeriodKey = period.key;
            this.$emit('updatePeriod', { chartId: this.chartId, period: period.key });
        },
        renderChart() {
            const options = {
                chart: {
                    height: this.chartHeight || 200,
                    maxWidth: "100%",
                    type: "area",
                    fontFamily: "Inter, sans-serif",
                    toolbar: { show: false },
                    dropShadow: { enabled: false }
                },
                tooltip: { enabled: true, x: { show: false } },
                fill: {
                    type: "gradient",
                    gradient: {
                        opacityFrom: 0.55,
                        opacityTo: 0,
                        shade: this.color,
                        gradientToColors: [this.color]
                    }
                },
                dataLabels: { enabled: false },
                stroke: { width: 6 },
                grid: {
                    show: false,
                    strokeDashArray: 4,
                    padding: { left: 2, right: 2, top: 0 }
                },
                series: Array.isArray(this.series)
                    ? this.series.map(s => ({ ...s, color: s.color || this.color }))
                    : [],
                xaxis: {
                    categories: this.categories,
                    labels: { show: false },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: { show: false }
            };

            const chartElement = document.getElementById(this.chartId);
            if (chartElement && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(chartElement, options);
                chart.render();
            }
        }
    }
};
</script>
