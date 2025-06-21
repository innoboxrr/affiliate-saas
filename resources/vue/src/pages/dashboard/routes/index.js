export default [
	{
		path: 'dashboard',
		name: "AffiliatesDashboard",
		component: () => import("./../layout/DashboardLayout.vue"),
		redirect: { name: "AffiliatesDashboardHome" },
		meta: {
			title: "Affiliates Dashboard",
		},
		children: [
			{
				path: 'home',
				name: "AffiliatesDashboardHome",
				component: () => import("./../views/HomeView.vue"),
			}
		]
	}
];