import AffiliateApp from './src/AffiliateApp.vue';
import AffiliateRoutes from './src/routes';
import { TranslatePlugin, TitlePlugin } from './src/plugins';
import PageHeader from './src/components/partials/PageHeader.vue';
import UnderConstruction from './src/components/partials/UnderConstruction.vue';

export const routes = AffiliateRoutes;

export default {
    install(app, options = {}) {
        app.use(TranslatePlugin, options.translateOptions || {});
        app.use(TitlePlugin);
        app.component('PageHeader', PageHeader);
        app.component('AffiliateApp', AffiliateApp);
        app.component('UnderConstruction', UnderConstruction);
    }
};
