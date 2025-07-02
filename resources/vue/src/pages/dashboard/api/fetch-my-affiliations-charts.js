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
                id: 'affiliate-earnings',
                component: AreaChart,
                data: {
                    chartId: 'affiliate-earnings',
                    chartHeight: 255,
                    label: 'Ganancias esta semana',
                    value: '$1,240',
                    percentage: 12,
                    categories: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                    series: [
                        {
                            name: 'Ganancias',
                            data: [120, 150, 180, 200, 250, 190, 150],
                            color: '#16a34a' // verde
                        }
                    ],
                    color: '#16a34a',
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
                id: 'affiliate-stats',
                component: BarChart,
                data: {
                    chartId: 'affiliate-stats',
                    profitLabel: 'Ganancia por afiliaciones',
                    profitValue: '$2,310',
                    rateLabel: 'Crecimiento',
                    rateValue: 12.5,
                    ratePositive: true,
                    metrics: [
                        {
                            label: 'Comisiones ganadas',
                            value: '$6,840'
                        },
                        {
                            label: 'Clicks no convertidos',
                            value: '-$4,530'
                        }
                    ],
                    reportLabel: 'Ver detalle de afiliaciones',
                    periods: [
                        { key: 'today', label: 'Hoy' },
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' }
                    ],
                    defaultPeriod: 'last_7_days',
                    categories: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                    series: [
                        {
                            name: 'Comisiones',
                            data: [600, 740, 820, 910, 990, 960, 820],
                            color: '#0ea5e9'
                        },
                        {
                            name: 'Pérdidas',
                            data: [300, 410, 450, 500, 530, 490, 410],
                            color: '#f97316'
                        }
                    ],
                    horizontal: true,
                    columnWidth: '100%',
                    borderRadius: 6,
                    borderRadiusApplication: 'end',
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
                id: 'affiliate-performance',
                component: ColumnChart,
                data: {
                    chartId: 'affiliate-performance',
                    value: '$2,980',
                    label: 'Comisiones obtenidas',
                    percentage: 9.3,
                    metrics: [
                        { label: 'Referidos únicos', value: '680' },
                        { label: 'Tasa de conversión', value: '7.1%' }
                    ],
                    colors: ["#1A56DB", "#FDBA8C"],
                    series: [
                        {
                            name: 'Comisiones',
                            data: [320, 400, 390, 430, 460, 420, 560]
                        },
                        {
                            name: 'Clics sin conversión',
                            data: [150, 180, 170, 160, 155, 200, 190]
                        }
                    ],
                    reportLabel: 'Ver detalle de mis afiliaciones',
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
                id: 'affiliate-traffic-sources',
                component: DonutChart,
                data: {
                    chartId: 'affiliate-traffic-sources',
                    title: 'Origen de tráfico de afiliados',
                    labels: ['YouTube', 'TikTok', 'Facebook', 'Email'],
                    series: [18.2, 34.7, 22.6, 24.5],
                    colors: ['#3B82F6', '#EC4899', '#10B981', '#F59E0B'],
                    height: 250,
                    reportLabel: 'Reporte de tráfico',
                    defaultPeriod: 'last_30_days',
                    periods: [
                        { key: 'today', label: 'Hoy' },
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' },
                        { key: 'last_90_days', label: 'Últimos 90 días' }
                    ],
                    filterOptions: [
                        { value: 'edu', label: 'Afiliados educativos' },
                        { value: 'salud', label: 'Afiliados salud' },
                        { value: 'tech', label: 'Afiliados tecnología' }
                    ],
                    filtersId: 'affiliate-filters'
                }
            }
        ],
        [
            {
                id: 'affiliate-clicks-heatmap',
                component: HeatmapChart,
                data: {
                    chartId: 'affiliate-clicks-heatmap',
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
                id: 'affiliate-performance-line',
                component: LineChart,
                data: {
                    chartId: 'affiliate-performance-line',
                    reportLabel: 'Mi desempeño semanal',
                    categories: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                    series: [
                        {
                            name: 'Clics',
                            data: [220, 310, 290, 410, 380, 360, 330]
                        },
                        {
                            name: 'Conversiones',
                            data: [22, 30, 27, 39, 32, 35, 31]
                        },
                        {
                            name: 'Comisiones',
                            data: [120, 180, 170, 220, 210, 200, 195]
                        }
                    ],
                    metrics: [
                        {
                            label: 'Total de clics',
                            value: '1,900'
                        },
                        {
                            label: 'Conversiones',
                            value: '216'
                        },
                        {
                            label: 'Comisiones ganadas',
                            value: '$1,295'
                        }
                    ],
                    defaultPeriod: 'last_7_days',
                    periods: [
                        { key: 'today', label: 'Hoy' },
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' }
                    ],
                    formatValue: (serie, value) => {
                        if (serie === 'Comisiones') return `$${value}`;
                        if (serie === 'Conversiones') return `${value} conv.`;
                        return `${value} clics`;
                    }
                }
            },
            {
                id: 'affiliate-traffic-sources-pie',
                component: PieChart,
                data: {
                    chartId: 'affiliate-traffic-sources-pie',
                    title: 'Fuentes de tráfico',
                    series: [45, 30, 25],
                    labels: ['Redes sociales', 'Correo', 'Referencias directas'],
                    colors: ['#1C64F2', '#16BDCA', '#FBBF24'],
                    chartHeight: 350,
                    defaultPeriod: 'last_7_days',
                    periods: [
                        { key: 'today', label: 'Hoy' },
                        { key: 'yesterday', label: 'Ayer' },
                        { key: 'last_7_days', label: 'Últimos 7 días' },
                        { key: 'last_30_days', label: 'Últimos 30 días' }
                    ],
                    reportLabel: 'Ver desglose',
                    tooltipTitle: '¿Qué representa este gráfico?',
                    tooltipDescription: 'Este gráfico muestra de dónde provienen tus visitantes. Ayuda a entender cuáles canales están generando más tráfico a tus enlaces de afiliado.',
                    tooltipCalcTitle: '¿Cómo se calcula?',
                    tooltipCalcText: 'La distribución se basa en las visitas únicas atribuidas por fuente durante el periodo seleccionado.',
                    tooltipLink: '#',
                    tooltipLinkLabel: 'Leer más'
                }
            }
        ], 
        [
            {
                id: 'affiliate-radial-progress',
                component: RadialChart,
                data: {
                    chartId: 'affiliate-radial-progress',
                    title: 'Mi desempeño',
                    series: [82, 65, 33],
                    labels: ['Visitas', 'Referencias', 'Conversión'],
                    colors: ['#6366F1', '#06B6D4', '#F97316'],
                    statuses: [
                        { value: '82%', label: 'Visitas', bg: 'indigo-50', circleBg: 'indigo-200', text: 'indigo-700', textDark: 'indigo-400' },
                        { value: '65%', label: 'Referencias', bg: 'cyan-50', circleBg: 'cyan-200', text: 'cyan-700', textDark: 'cyan-400' },
                        { value: '33%', label: 'Conversión', bg: 'orange-50', circleBg: 'orange-200', text: 'orange-700', textDark: 'orange-400' },
                    ],
                    details: [
                        { label: 'Clics únicos', value: 245 },
                        { label: 'Leads generados', value: 55 },
                        { label: 'Comisiones ganadas', value: '$780 MXN', class: 'text-green-600 dark:text-green-400' }
                    ],
                    collapseLabel: 'Ver detalles',
                    tooltipTitle: 'Desempeño como afiliado',
                    tooltipDescription: 'Visualiza tu rendimiento individual como promotor de programas en el sistema.',
                    tooltipCalcTitle: 'Cómo se calcula',
                    tooltipCalcText: 'Los valores muestran el porcentaje de efectividad basado en visitas únicas, leads generados y compras atribuidas.',
                    tooltipLink: '#',
                    tooltipLinkLabel: 'Saber más',
                    reportLabel: 'Mi reporte',
                    defaultPeriod: 'last_7_days'
                }
            }
        ]
    ];
};
