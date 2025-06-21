import * as middleware from '@router/middleware'

export default [
	{
		path: 'affiliate',
		name: "AdminAffiliates",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'Affiliates',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffiliate",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear Affiliates',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffiliate",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver Affiliates',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffiliate",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar Affiliates',
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