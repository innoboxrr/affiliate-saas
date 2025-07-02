export const fetchCards = async () => {
    return [
        {
            title: 'Afiliados Activos',
            icon: 'fa-solid fa-user-check',
            count: 87,
            percentage: 12,
            percentageText: 'vs mes anterior'
        },
        {
            title: 'Clics Registrados',
            icon: 'fa-solid fa-mouse-pointer',
            count: 14230,
            percentage: 8,
            percentageText: 'vs mes anterior'
        },
        {
            title: 'Leads Generados',
            icon: 'fa-solid fa-user-plus',
            count: 2134,
            percentage: 5,
            percentageText: 'vs mes anterior'
        },
        {
            title: 'Comisiones Totales',
            icon: 'fa-solid fa-dollar-sign',
            count: 18650,
            percentage: 18,
            percentageText: 'crecimiento mensual'
        }
    ];
};
