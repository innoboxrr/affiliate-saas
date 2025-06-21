export default [
    {
        path: 'affiliate-manager',
        name: "AffilaiteManager",
        component: () => import("../layout/AffiliateManagerLayout.vue"),
        redirect: { name: "DealsAdsManagerAds" },
        meta: {
            title: "Affiliate Manager",
        },
        children: [
            {
                path: 'programs',
                name: "AffilaiteManagerPrograms",
                component: () => import("../views/ProgramsView.vue"),
            }
        ]
    }
];
