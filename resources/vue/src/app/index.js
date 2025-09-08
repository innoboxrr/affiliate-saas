import affiliateRoutes from './../routes';

export default [
    {
        path: 'affiliate',
        name: 'AdminAffiliateApp',
        component: () => import('./AffiliateApp.vue'),
        redirect: { name: 'AffiliateDashboard' },
        meta: { title: 'Affiliate' },
        children: affiliateRoutes
    }
];