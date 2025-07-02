export const fetchCards = async () => {
    return [
        {
            title: 'Programas Activos',
            icon: 'fa-solid fa-diagram-project',
            count: 4,
            percentage: 25,
            percentageText: 'vs mes anterior'
        },
        {
            title: 'Afiliados Registrados',
            icon: 'fa-solid fa-user-group',
            count: 153,
            percentage: 10,
            percentageText: 'nuevos este mes'
        },
        {
            title: 'Leads Generados',
            icon: 'fa-solid fa-bullseye',
            count: 3120,
            percentage: 7,
            percentageText: 'vs mes anterior'
        },
        {
            title: 'Comisiones Pagadas',
            icon: 'fa-solid fa-sack-dollar',
            count: 10250,
            percentage: -5,
            percentageText: 'vs mes anterior'
        }
    ];
};
