const modules = import.meta.glob('../**/routes/index.js', { eager: true });
const appRoutes = Object.values(modules).flatMap(m => m.default || []);

// Validar que las rutas dinámicas sean un arreglo
if (!Array.isArray(appRoutes)) {
    console.error('[AffiliateApp] appRoutes is not an array.');
}

export default [{
	path: 'app',
	name: 'AffiliateApp',
	redirect: { name: 'AffiliateDashboard' },
	meta: {
		title: 'Domain Manager App',
	},
	children: [
		...appRoutes,
	],
}];
