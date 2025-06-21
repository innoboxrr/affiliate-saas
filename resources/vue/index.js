import AffiliateApp from './src/AffiliateApp.vue';
import affilaiteRoutes from './src/routes';
import { TranslatePlugin, TitlePlugin } from './src/plugins';
import PageHeader from './src/components/partials/PageHeader.vue';

export const routes = affilaiteRoutes;

export default {
    install(app, options = {}) {
        app.use(TranslatePlugin, options.translateOptions || {});
        app.use(TitlePlugin);
        app.component('PageHeader', PageHeader);
        app.component('AffiliateApp', AffiliateApp);
    }
};
