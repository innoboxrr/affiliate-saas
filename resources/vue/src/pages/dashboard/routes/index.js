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
			}
		]
	}
];