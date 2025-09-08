import { TranslatePlugin, TitlePlugin } from './plugins';
import AffiliateApp from './app'

export { AffiliateApp };

export default {
    install(app, options = {}) {
        app.use(TranslatePlugin, options.translateOptions || {});
        app.use(TitlePlugin);
    }
};
