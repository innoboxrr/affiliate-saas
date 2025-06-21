import * as middleware from '@router/middleware'

export default [
	{
		path: 'affiliate-conversion',
		name: "AdminAffiliateConversions",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'AffiliateConversions',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffiliateConversion",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear AffiliateConversions',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffiliateConversion",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver AffiliateConversions',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffiliateConversion",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar AffiliateConversions',
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