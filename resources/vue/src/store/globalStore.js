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
        affiliateNav: [
            {
                id: 1,
                name: __affiliate('Programs'),
                description: __affiliate('View and manage your programs'),
                icon: 'fa-solid fa-cubes',
                status: 'active',
                route: { name: 'AdminAffiliateAssets', query: { view: 'affiliate' }},
                current: true,
            },
            {
                id: 2,
                name: __affiliate('Payouts'),
                description: __affiliate('View and manage your payouts'),
                icon: 'fa-solid fa-money-bill',
                status: 'active',
                route: { name: 'AffiliatePayout', query: { view: 'affiliate' } },
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
        },
    },
})
