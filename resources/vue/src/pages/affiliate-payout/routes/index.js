export default [
    {
        path: 'affiliate-payout',
        name: "AffiliatePayout",
        component: () => import("../layout/AffiliatePayoutLayout.vue"),
        redirect: { name: "AffiliatePayoutDashboard" },
        meta: {
            title: "Affiliate Payout",
        },
        children: [
            {
                path: 'dashboard',
                name: "AffiliatePayoutDashboard",
                component: () => import("../views/DashboardView.vue"),
            }
        ]
    }
];
