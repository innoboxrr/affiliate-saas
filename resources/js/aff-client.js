(function () {
    const AFF_PARAM = 'sp-aff'; // parámetro del link de afiliado
    const CLICK_COOKIE = 'sp_click_id'; // nombre de la cookie
    const REDIRECTED_KEY = 'sp_redirect_done'; // control por sesión
    const TEST_API_BASE = 'https://seguropro.test.com'; // tu API base
    const PROD_API_BASE = 'https://seguropro.app'
    const ENV = 'test' // prod
    const DEBUG = true;

    // 🔧 Utilidades
    const log = (...args) => DEBUG && console.log('[SeguroProPixel]', ...args);

    const getParam = (param) => {
        const url = new URL(window.location.href);
        return url.searchParams.get(param);
    };

    const hasCookie = (name) => {
        return document.cookie.split(';').some(c => c.trim().startsWith(name + '='));
    };

    const setCookie = (name, value, days = 30) => {
        const maxAge = days * 24 * 60 * 60;
        document.cookie = `${name}=${value}; path=/; max-age=${maxAge}; samesite=lax`;
    };

    const cleanUrlParam = (param) => {
        const url = new URL(window.location.href);
        url.searchParams.delete(param);
        window.history.replaceState({}, '', url.toString());
    };

    const wasRedirected = () => sessionStorage.getItem(REDIRECTED_KEY) === 'true';

    const setRedirectedFlag = () => sessionStorage.setItem(REDIRECTED_KEY, 'true');

    // 🚀 Lógica principal
    async function handleAffiliateTracking() {

        const affCode = getParam(AFF_PARAM);
        if (!affCode || hasCookie(CLICK_COOKIE) || wasRedirected()) {
            log('No se necesita redirección.');
            log('Código de afiliado:', affCode);
            log('Cookie existente:', hasCookie(CLICK_COOKIE));
            log('Redirección ya realizada:', wasRedirected());
            return;
        }

        try {
            log('Solicitando click ID para código:', affCode);

            let = localUrl = window.location.href;

            const res = await fetch(`${ENV == 'test' ? TEST_API_BASE : PROD_API_BASE}/track/click?code=${encodeURIComponent(affCode)}&url=${encodeURIComponent(localUrl)}`, {
                headers: {
                    'X-Affiliate-Tracker': 'SeguroProPixel/1.0'
                }
            });

            if (!res.ok) throw new Error('Error al obtener datos del clic');

            const data = await res.json();

            if (!data.click_id || !data.redirect_url) {
                log('Respuesta inválida o incompleta del servidor.');
                return;
            }

            // 🧠 Instalar cookie, marcar redirección, limpiar URL y redirigir
            setCookie(CLICK_COOKIE, data.click_id);
            setRedirectedFlag();
            cleanUrlParam(AFF_PARAM);

            log('Redirigiendo a:', data.redirect_url);
            window.location.href = data.redirect_url;

        } catch (e) {
            log('Error en el pixel de afiliados:', e.message);
        }
    }

    // 📦 Ejecutar
    handleAffiliateTracking();
})();
