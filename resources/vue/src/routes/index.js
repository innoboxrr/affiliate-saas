const modules = import.meta.glob('../**/routes/index.js', { eager: true });

console.log('[AffiliateApp] Loaded route modules:', modules);

const appRoutes = Object.values(modules).flatMap(m => m.default || []);

console.log('[AffiliateApp] Compiled appRoutes:', appRoutes);

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
