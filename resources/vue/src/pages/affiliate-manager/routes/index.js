export default [
    {
        path: 'affiliate-manager',
        name: "AffiliateManager",
        component: () => import("../layout/AffiliateManagerLayout.vue"),
        redirect: { name: "AffiliateManagerDashboard" },
        meta: {
            title: "Affiliate Manager",
        },
        children: [
            {
                path: 'dashboard',
                name: "AffiliateManagerDashboard",
                component: () => import("../views/DashboardView.vue"),
            }
        ]
    }
];
