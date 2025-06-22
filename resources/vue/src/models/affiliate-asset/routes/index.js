import * as middleware from '@router/middleware'

export default [
	{
		path: 'affiliate-asset',
		name: "AdminAffiliateAssets",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'AffiliateAssets',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffiliateAsset",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear AffiliateAssets',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffiliateAsset",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver AffiliateAssets',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffiliateAsset",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar AffiliateAssets',
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