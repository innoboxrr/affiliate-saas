import * as middleware from '@router/middleware'

export default [
	{
		path: 'affiliate-payout',
		name: "AdminAffiliatePayouts",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'AffiliatePayouts',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffiliatePayout",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear AffiliatePayouts',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffiliatePayout",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver AffiliatePayouts',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffiliatePayout",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar AffiliatePayouts',
							middleware: [
								middleware.auth
							]
						}
					},
				]
			},
		]
	},
]