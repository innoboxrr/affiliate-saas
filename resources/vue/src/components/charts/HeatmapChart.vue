<template>
    <div 
        v-flowbite 
        class="w-full bg-white rounded-lg shadow-sm dark:bg-gray-800 p-4 md:p-6">

        <div class="flex justify-between items-center mb-4">
            <div>
                <h5 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ title }}
                </h5>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ subtitle }}</p>
            </div>
            <select 
                class="border border-gray-300 rounded px-2 py-1 text-sm dark:bg-gray-700 dark:text-white"
                v-model="selectedYear" 
                @change="updateChart">
                <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
            </select>
        </div>

        <div :id="chartId"></div>
    </div>
</template>

<script>
import ApexCharts from 'apexcharts'
import dayjs from 'dayjs'
import isoWeek from 'dayjs/plugin/isoWeek'
import weekday from 'dayjs/plugin/weekday'
import isLeapYear from 'dayjs/plugin/isLeapYear'

dayjs.extend(isoWeek)
dayjs.extend(weekday)
dayjs.extend(isLeapYear)

export default {
    name: 'LeadsAnnualHeatmap',
    props: {
        chartId: {
            type: String,
            default: 'commits-chart'
        },
        title: {
            type: String,
            default: 'Annual Heatmap'
        },
        subtitle: {
            type: String,
            default: 'Actividad anual por día'
        },
        height: {
            type: Number,
            default: 200
        },
        color: {
            type: String,
            default: '#1A56DB'
        },
        valueFormatter: {
            type: Function,
            default: val => `${val} leads`
        },
        yearsRange: {
            type: Number,
            default: 2 // años hacia atrás
        }
    },
    data() {
        const currentYear = new Date().getFullYear()
        return {
            selectedYear: currentYear,
            years: Array.from({ length: this.yearsRange + 1 }, (_, i) => currentYear - i),
            chart: null
        }
    },
    mounted() {
        if (window.requestIdleCallback) {
            requestIdleCallback(() => this.renderChart())
        } else {
            setTimeout(this.renderChart, 50)
        }
    },
    methods: {
        generateAnnualHeatmapData(year) {
            const weekCount = 53
            const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            const series = []

            for (let i = 0; i < days.length; i++) {
                const data = []
                for (let w = 1; w <= weekCount; w++) {
                    const date = dayjs().year(year).isoWeek(w).isoWeekday(i + 1)
                    data.push({
                        x: `W${w}`,
                        y: Math.floor(Math.random() * 20),
                        date: date.format('YYYY-MM-DD')
                    })
                }
                series.push({ name: days[i], data })
            }

            return series
        },

        getChartOptions() {
            return {
                chart: {
                    height: this.height,
                    type: 'heatmap',
                    animations: { enabled: false },
                    toolbar: { show: false }
                },
                colors: [this.color],
                dataLabels: { enabled: false },
                grid: {
                    padding: { top: 0, right: 0, bottom: 0, left: 0 }
                },
                plotOptions: {
                    heatmap: {
                        shadeIntensity: 0.4,
                        radius: 1,
                        useFillColorAsStroke: false
                    }
                },
                xaxis: {
                    type: 'category',
                    show: false,
                    labels: { show: false },
                    axisBorder: { show: false },
                    axisTicks: { show: false }
                },
                yaxis: {
                    show: false,
                    reversed: true
                },
                tooltip: {
                    enabled: true,
                    y: {
                        formatter: (val, { seriesIndex, dataPointIndex, w }) => {
                            const point = w.config.series[seriesIndex].data[dataPointIndex]
                            return `${this.valueFormatter(val)} el ${point.date}`
                        }
                    }
                },
                series: this.generateAnnualHeatmapData(this.selectedYear)
            }
        },

        renderChart() {
            const options = this.getChartOptions()
            this.chart = new ApexCharts(document.querySelector(`#${this.chartId}`), options)
            this.chart.render()
        },

        updateChart() {
            if (!this.chart) return
            const updatedSeries = this.generateAnnualHeatmapData(this.selectedYear)
            this.chart.updateOptions({ series: updatedSeries }, true, true)
        }
    }
}
</script>
