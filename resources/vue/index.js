import AffiliateRoutes from './src/routes';
import { TranslatePlugin, TitlePlugin } from './src/plugins';

export const routes = AffiliateRoutes;

export default {
    install(app, options = {}) {
        app.use(TranslatePlugin, options.translateOptions || {});
        app.use(TitlePlugin);
    }
};
