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
        ],
        affiliateList: [
            /*
            {
                id: 1,
                name: 'Affiliate 1 ',
                description: 'Affiliate description',
                status: 'active',
                route: { name: 'AffiliateDashboard' },
                createdAt: '2023-01-23T11:00',
                updatedAt: '2023-01-23T11:00',
            },
            {
                id: 2,
                name: 'Affiliate 2',
                description: 'Affiliate 2 description',
                status: 'inactive',
                route: { name: 'AffiliateDashboard' },
                createdAt: '2023-01-23T11:00',
                updatedAt: '2023-01-23T11:00',
            },
            */
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
