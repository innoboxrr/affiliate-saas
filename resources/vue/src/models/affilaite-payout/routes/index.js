import * as middleware from '@router/middleware'

export default [
	{
		path: 'affilaite-payout',
		name: "AdminAffilaitePayouts",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'AffilaitePayouts',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffilaitePayout",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear AffilaitePayouts',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffilaitePayout",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver AffilaitePayouts',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffilaitePayout",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar AffilaitePayouts',
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