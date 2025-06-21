import * as middleware from '@router/middleware'

export default [
	{
		path: 'affiliate-click',
		name: "AdminAffiliateClicks",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'AffiliateClicks',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffiliateClick",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear AffiliateClicks',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffiliateClick",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver AffiliateClicks',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffiliateClick",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar AffiliateClicks',
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