import { TranslatePlugin, TitlePlugin } from './plugins';

export default {
    install(app, options = {}) {
        app.use(TranslatePlugin, options.translateOptions || {});
        app.use(TitlePlugin);
    }
};
