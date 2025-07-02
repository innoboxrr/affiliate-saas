import AreaChart from '@affiliateComponents/charts/AreaChart.vue';
import LineChart from '@affiliateComponents/charts/LineChart.vue';
import ColumnChart from '@affiliateComponents/charts/ColumnChart.vue';
import BarChart from '@affiliateComponents/charts/BarChart.vue';
import PieChart from '@affiliateComponents/charts/PieChart.vue';
import DonutChart from '@affiliateComponents/charts/DonutChart.vue';
import RadialChart from '@affiliateComponents/charts/RadialChart.vue';
import HeatmapChart from '@affiliateComponents/charts/HeatmapChart.vue';

export const fetchCharts = async () => {
    return [
        [
            {
                id: 'owner-clicks',
                component: AreaChart,
                data: {
                    chartId: 'owner-clicks',
                    chartHeight: 255,
                    label: 'Clics esta semana',
                    value: '32.4k',
                    percentage: 8,
                    categories: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                    series: [
                        {
                            name: 'Clics',
                            data: [4500, 4800, 5000, 5200, 4900, 4700, 4300],
                            color: '#3b82f6' // azul
                        }
                    ],
                    color: '#3b82f6',
                    defaultPeriod: 'last_7_days',
                    periods: [
                        { key: 'today', label: 'Hoy' },
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' }
                    ]
                }
            },
            {
                id: 'owner-conversions',
                component: BarChart,
                data: {
                    chartId: 'owner-stats',
                    profitLabel: 'Utilidad',
                    profitValue: '$8,120',
                    rateLabel: 'Crecimiento',
                    rateValue: 28.4,
                    ratePositive: true,
                    metrics: [
                        {
                            label: 'Ingresos',
                            value: '$28,200',
                        },
                        {
                            label: 'Gastos',
                            value: '-$20,080',
                        }
                    ],
                    reportLabel: 'Ver reporte de ingresos',
                    categories: ['Abr', 'May', 'Jun'],
                    series: [
                        {
                            name: 'Ingresos',
                            data: [10200, 9100, 10900],
                            color: '#16a34a'
                        },
                        {
                            name: 'Gastos',
                            data: [7000, 6900, 8180],
                            color: '#dc2626'
                        }
                    ],
                    horizontal: true,
                    columnWidth: '100%',
                    borderRadius: 6,
                    borderRadiusApplication: 'end',
                    defaultPeriod: 'last_7_days',
                    periods: [],
                    defaultPeriod: 'last_7_days',
                    periods: [
                        { key: 'today', label: 'Hoy' },
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' }
                    ]
                }
            }
        ], 
        [
            {
                id: 'owner-affiliate-performance',
                component: ColumnChart,
                data: {
                    chartId: 'owner-affiliate-performance',
                    value: '$12,480',
                    label: 'Ingresos por afiliados',
                    percentage: 18.7,
                    metrics: [
                        { label: 'Clicks totales', value: '42,300' },
                        { label: 'Conversión promedio', value: '5.2%' }
                    ],
                    colors: ["#1A56DB", "#FDBA8C", "#10B981"],
                    series: [
                        {
                            name: 'Ingresos',
                            data: [3200, 3900, 4100, 4600, 5500, 4900, 4800]
                        },
                        {
                            name: 'Pérdidas',
                            data: [900, 1100, 1000, 950, 880, 1200, 1100]
                        },
                        {
                            name: 'Comisiones',
                            data: [600, 740, 820, 910, 990, 960, 820],
                        }
                    ],
                    reportLabel: 'Ver reporte de afiliaciones',
                    defaultPeriod: 'last_7_days',
                    periods: [
                        { key: 'today', label: 'Hoy' },
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' }
                    ]
                }
            },
            {
                id: 'owner-traffic-sources',
                component: DonutChart,
                data: {
                    chartId: 'owner-traffic-sources',
                    title: 'Website traffic',
                    labels: ['Direct', 'Sponsor', 'Affiliate', 'Email marketing'],
                    series: [35.1, 23.5, 2.4, 5.4],
                    colors: ['#1C64F2', '#16BDCA', '#FDBA8C', '#E74694'],
                    height: 250,
                    reportLabel: 'Users Report',
                    defaultPeriod: 'last_7_days',
                    periods: [
                        { key: 'today', label: 'Today' },
                        { key: 'yesterday', label: 'Yesterday' },
                        { key: 'last_7_days', label: 'Last 7 days' },
                        { key: 'last_30_days', label: 'Last 30 days' },
                        { key: 'last_90_days', label: 'Last 90 days' }
                    ],
                    filterOptions: [
                        { value: 'desktop', label: 'Desktop' },
                        { value: 'tablet', label: 'Tablet' },
                        { value: 'mobile', label: 'Mobile' }
                    ],
                    filtersId: 'traffic-filters'
                }
            }
        ],
        [
            {
                id: 'owner-clicks-heatmap',
                component: HeatmapChart,
                data: {
                    chartId: 'owner-clicks-heatmap',
                    title: 'Actividad de Clicks',
                    subtitle: 'Cantidad diaria de clicks en el año',
                    height: 200,
                    color: '#1A56DB',
                    yearsRange: 2,
                    valueFormatter: (val) => `${val} clicks`
                }
            }
        ],
        [
            {
                id: 'owner-line-performance',
                component: LineChart,
                data: {
                    chartId: 'owner-line-performance',
                    reportLabel: 'Ver reporte de rendimiento',
                    categories: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                    series: [
                        {
                            name: 'Ingresos',
                            data: [1200, 1600, 1400, 1800, 1500, 1700, 1900]
                        },
                        {
                            name: 'Conversión',
                            data: [300, 500, 450, 600, 520, 580, 610]
                        }
                    ],
                    metrics: [
                        {
                            label: 'Total ingresos',
                            value: '$9,300'
                        },
                        {
                            label: 'Total conversiones',
                            value: '3,560'
                        }
                    ],
                    defaultPeriod: 'last_7_days',
                    periods: [
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'today', label: 'Hoy' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' },
                        { key: 'last_90_days', label: 'Últimos 90 días' }
                    ],
                    formatValue: (serie, value) => {
                        return serie === 'Ingresos' ? `$${value}` : `${value} conv.`;
                    }
                }
            },
            {
                id: 'owner-traffic-sources-pie',
                component: PieChart,
                data: {
                    chartId: 'owner-traffic-sources-pie',
                    title: 'Origen del tráfico total',
                    series: [52, 28, 20],
                    labels: ['Facebook Ads', 'Google Ads', 'Afiliados'],
                    colors: ['#1C64F2', '#10B981', '#F59E0B'],
                    chartHeight: 350,
                    defaultPeriod: 'last_7_days',
                    periods: [
                        { key: 'today', label: 'Hoy' },
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' },
                        { key: 'last_90_days', label: 'Últimos 90 días' }
                    ],
                    reportLabel: 'Reporte completo',
                    tooltipTitle: 'Distribución por canal',
                    tooltipDescription: 'Representa la proporción del tráfico total generado por cada canal de adquisición configurado dentro del sistema.',
                    tooltipCalcTitle: 'Fuente de los datos',
                    tooltipCalcText: 'El sistema analiza las visitas únicas provenientes de cada fuente durante el periodo seleccionado y calcula el porcentaje relativo.',
                    tooltipLink: '#',
                    tooltipLinkLabel: 'Ver cómo se mide'
                }
            }
        ],
        [
            {
                id: 'owner-radial-progress',
                component: RadialChart,
                data: {
                    chartId: 'owner-radial-progress',
                    title: 'Progreso del equipo',
                    series: [75, 58, 43],
                    labels: ['Leads contactados', 'Cierres logrados', 'Seguimientos activos'],
                    colors: ['#1C64F2', '#10B981', '#F59E0B'],
                    statuses: [
                        { value: '75%', label: 'Contactados', bg: 'blue-50', circleBg: 'blue-200', text: 'blue-700', textDark: 'blue-400' },
                        { value: '58%', label: 'Cierres', bg: 'green-50', circleBg: 'green-200', text: 'green-700', textDark: 'green-400' },
                        { value: '43%', label: 'Seguimiento', bg: 'yellow-50', circleBg: 'yellow-200', text: 'yellow-700', textDark: 'yellow-400' },
                    ],
                    details: [
                        { label: 'Leads nuevos', value: 123 },
                        { label: 'Contactos fallidos', value: 31, class: 'text-red-500 dark:text-red-400' },
                        { label: 'Citas agendadas', value: 40, class: 'text-green-500 dark:text-green-400' }
                    ],
                    collapseLabel: 'Ver más detalles',
                    tooltipTitle: 'Progreso del equipo de ventas',
                    tooltipDescription: 'Mide el avance del equipo en relación a los objetivos semanales de conversión y contacto.',
                    tooltipCalcTitle: 'Cálculo del progreso',
                    tooltipCalcText: 'Cada porcentaje refleja el avance respecto al total de leads asignados durante el período.',
                    tooltipLink: '#',
                    tooltipLinkLabel: 'Leer más',
                    reportLabel: 'Reporte de equipo',
                    defaultPeriod: 'last_7_days'
                }
            }

        ]
    ];
};
