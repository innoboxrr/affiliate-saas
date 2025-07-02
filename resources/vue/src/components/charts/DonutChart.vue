<template>
    <div 
        v-flowbite 
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">

        <!-- HEADER -->
        <div class="flex justify-between mb-4 border-b border-gray-200 dark:border-gray-700 pb-4">
            <div class="flex items-center">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">{{ title }}</h5>
                <slot name="tooltip"></slot>
            </div>
            <div>
                <button type="button" @click="downloadData"
                    class="hidden sm:inline-flex items-center justify-center text-gray-500 w-8 h-8 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 16 18" xmlns="http://www.w3.org/2000/svg">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                    </svg>
                    <span class="sr-only">Download data</span>
                </button>
            </div>
        </div>

        <!-- FILTERS -->
        <div class="flex gap-4 mb-4" :id="filtersId">
            <div v-for="option in filterOptions" :key="option.value" class="flex items-center">
                <input :id="option.value" type="checkbox" :value="option.value"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label :for="option.value" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                    {{ option.label }}
                </label>
            </div>
        </div>

        <!-- CHART -->
        <div class="py-6" :id="chartId"></div>

        <!-- FOOTER -->
        <div class="flex justify-between items-center border-t border-gray-200 dark:border-gray-700 pt-5 mt-5">
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
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul
                        class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        :aria-labelledby="`dropdownDefaultButton-${chartId}`">
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

            <a href="#" @click.prevent="$emit('viewReport', chartId)"
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
    name: 'DonutChart',
    props: {
        chartId: {
            type: String,
            default: 'donut-chart'
        },
        title: String,
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
        filterOptions: {
            type: Array,
            default: () => []
        },
        filtersId: {
            type: String,
            default: 'filters'
        },
        series: {
            type: Array,
            required: true
        },
        labels: {
            type: Array,
            required: true
        },
        colors: {
            type: Array,
            default: () => ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694"]
        },
        height: {
            type: Number,
            default: 330
        }
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
        this.renderChart();
    },
    methods: {
        selectPeriod(period) {
            this.selectedPeriod = period.key;
            this.$emit('updatePeriod', { chartId: this.chartId, period: period.key });
        },
        downloadData() {
            this.$emit('download')
        },
        renderChart() {
            const options = {
                series: this.series,
                labels: this.labels,
                colors: this.colors,
                chart: {
                    type: 'donut',
                    height: this.height,
                    width: '100%'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '80%',
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    offsetY: 20,
                                    fontFamily: 'Inter, sans-serif'
                                },
                                value: {
                                    show: true,
                                    offsetY: -20,
                                    fontFamily: 'Inter, sans-serif',
                                    formatter: val => val + 'k'
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Unique visitors',
                                    fontFamily: 'Inter, sans-serif',
                                    formatter: w => '$' + w.globals.seriesTotals.reduce((a, b) => a + b, 0) + 'k'
                                }
                            }
                        }
                    }
                },
                legend: {
                    position: 'bottom',
                    fontFamily: 'Inter, sans-serif'
                },
                stroke: {
                    colors: ['transparent']
                },
                dataLabels: {
                    enabled: false
                }
            };

            const chartEl = document.getElementById(this.chartId);
            if (chartEl && typeof ApexCharts !== 'undefined') {
                const chart = new ApexCharts(chartEl, options);
                chart.render();

                const checkboxes = document.querySelectorAll(`#${this.filtersId} input[type="checkbox"]`);
                checkboxes.forEach(cb => {
                    cb.addEventListener('change', (event) => {
                        this.$emit('filterChange', { value: event.target.value, checked: event.target.checked });
                    });
                });
            }
        }
    }
}
</script>
