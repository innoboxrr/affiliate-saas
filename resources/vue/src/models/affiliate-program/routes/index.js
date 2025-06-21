import * as middleware from '@router/middleware'

export default [
	{
		path: 'affiliate-program',
		name: "AdminAffiliatePrograms",
		component: () => import ("./../views/AdminView.vue"),
		meta: {
			title: 'AffiliatePrograms',
			middleware: [
				middleware.auth
			]
		},
		children: [
			{
				path: 'create',
				name: "AdminCreateAffiliateProgram",
				component: () => import ("./../views/CreateView.vue"),
				meta: {
					title: 'Crear AffiliatePrograms',
					middleware: [
						middleware.auth
					]
				}
			},
			{
				path: ':id',
				name: "AdminShowAffiliateProgram",
				component: () => import ("./../views/ShowView.vue"),
				meta: {
					title: 'Ver AffiliatePrograms',
					middleware: [
						middleware.auth
					]
				},
				children: [
					{
						path: 'edit',
						name: "AdminEditAffiliateProgram",
						component: () => import ("./../views/EditView.vue"),
						meta: {
							title: 'Editar AffiliatePrograms',
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