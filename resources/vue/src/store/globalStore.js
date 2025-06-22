import { defineStore } from 'pinia'
import { __affiliate } from './../utils/translate.js'
import { 
    HomeIcon,
    CubeIcon,
    MegaphoneIcon,
    BriefcaseIcon,
    UserGroupIcon,
    ShareIcon,
    BuildingStorefrontIcon,
    DocumentTextIcon,
    UsersIcon,
} from '@heroicons/vue/24/outline'

export const useGlobalStore = defineStore('affiliate-global', {
    state: () => ({
        sidebarOpen: false,
        navigation: [
            { name: __affiliate('Dashboard'), route: { name: 'AffiliateDashboard' }, icon: HomeIcon, current: true },
            { name: __affiliate('Programs'), route: { name: 'AffiliateProgram' }, icon: CubeIcon, current: false },
            { name: __affiliate('Affiliates'), route: { name: 'AffiliateManager' }, icon: UserGroupIcon, current: false },
            { name: __affiliate('Payouts'), route: { name: 'AffiliatePayout' }, icon: ShareIcon, current: false },
            // { name: __affiliate('Reports'), route: { name: 'AffiliateReport' }, icon: DocumentTextIcon, current: false },
        ],
        modelsNav: [
            {
                id: 1,
                name: __affiliate('Affiliates'),
                description: __affiliate('View and manage your affiliates'),
                icon: 'fa-solid fa-users',
                status: 'active',
                route: { name: 'AdminAffiliates'},
                current: true,
            },
            {
                id: 2,
                name: __affiliate('Programs'),
                description: __affiliate('View and manage your affiliate programs'),
                icon: 'fa-solid fa-cubes',
                status: 'active',
                route: { name: 'AdminAffiliatePrograms' },
                current: false,
            },
            {
                id: 3,
                name: __affiliate('Assets'),
                description: __affiliate('View and manage your affiliate assets'),
                icon: 'fa-solid fa-file-image',
                status: 'active',
                route: { name: 'AdminAffiliateAssets' },
                current: false,
            },
            {
                id: 4,
                name: __affiliate('Payouts'),
                description: __affiliate('View and manage your affiliate payouts'),
                icon: 'fa-solid fa-money-bill-wave',
                status: 'active',
                route: { name: 'AdminAffiliatePayouts' },
                current: false,
            },
            {
                id: 5,
                name: __affiliate('Links'),
                description: __affiliate('View and manage your affiliate links'),
                icon: 'fa-solid fa-link',
                status: 'active',
                route: { name: 'AdminAffiliateLinks' },
                current: false,
            },
            {
                id: 6,
                name: __affiliate('Clicks'),
                description: __affiliate('View and manage your affiliate clicks'),
                icon: 'fa-solid fa-mouse-pointer',
                status: 'active',
                route: { name: 'AdminAffiliateClicks' },
                current: false,
            },
            {
                id: 7,
                name: __affiliate('Conversions'),
                description: __affiliate('View and manage your affiliate conversions'),
                icon: 'fa-solid fa-chart-line',
                status: 'active',
                route: { name: 'AdminAffiliateConversions' },
                current: false,
            },
        ],
        activityItems: [
            /*
            {
                user: {
                    name: 'Michael Foster',
                    imageUrl: 'https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                },
                action: 'Renovó el dominio example.com',
                date: 'Hace 1h',
                dateTime: '2023-01-23T11:00',
            },
            */
        ],
    }),
    actions: {
        setCurrentRoute(routeName) {
            this.navigation.forEach(item => {
                item.current = item.route.name === routeName;
            });
            this.modelsNav.forEach(item => {
                item.current = item.route.name === routeName;
            });
        },
    },
})
