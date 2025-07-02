export default [
	{
		path: 'dashboard',
		name: "AffiliateDashboard",
		component: () => import("./../layout/DashboardLayout.vue"),
		redirect: { name: "AffiliateDashboardHome" },
		meta: {
			title: "Affiliate Dashboard",
		},
		children: [
			{
				path: 'home',
				name: "AffiliateDashboardHome",
				component: () => import("./../views/HomeView.vue"),
			},
			{
				path: 'my-affiliations',
				name: "MyAffiliations",
				component: () => import("./../views/MyAffiliationsView.vue"),
			}
		]
	}
];