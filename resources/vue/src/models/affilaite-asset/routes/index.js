import * as middleware from '@router/middleware'

export default [
	{
		path: 'affilaite-asset',
		name: "AdminAffilaiteAssets",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'AffilaiteAssets',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffilaiteAsset",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear AffilaiteAssets',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffilaiteAsset",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver AffilaiteAssets',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffilaiteAsset",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar AffilaiteAssets',
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