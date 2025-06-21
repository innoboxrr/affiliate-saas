import * as middleware from '@router/middleware'

export default [
	{
		path: 'affiliate-link',
		name: "AdminAffiliateLinks",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'AffiliateLinks',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffiliateLink",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear AffiliateLinks',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffiliateLink",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver AffiliateLinks',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffiliateLink",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar AffiliateLinks',
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