export default [
    {
        path: 'affiliate-program',
        name: "AffiliateProgram",
        component: () => import("../layout/AffiliateProgramLayout.vue"),
        redirect: { name: "AffiliateProgramDashboard" },
        meta: {
            title: "Affiliate Manager",
        },
        children: [
            {
                path: 'darshboard',
                name: "AffiliateProgramDashboard",
                component: () => import("../views/DashboardView.vue"),
            }
        ]
    }
];
