(function () {

    // Configuración
    const CONFIG = {
        ENV: 'test', // DO NOT CHANGE THIS LINE
        DEBUG: true, // DO NOT CHANGE THIS LINE
        AFF_PARAM: 'sp-aff',
        CLICK_COOKIE: 'sp_click_id',
        REDIRECTED_KEY: 'sp_redirect_done',
        TEST_API_BASE: 'https://seguropro.test.com',
        PROD_API_BASE: 'https://seguropro.app',
        ENDPOINT_CLICK: '/affiliate/track/click',
        ENDPOINT_EVENT: '/affiliate/track/event',
        ENDPOINT_CONVERSION: '/affiliate/track/conversion',
        CONVERSION_SENT_KEY: 'sp_conversion_sent',
        CONVERSION_TTL_MS: 3600 * 1000, // 1 hora en milisegundos
        HEADERS: {
            'Content-Type': 'application/json',
            'X-Affiliate-Tracker': 'SeguroProPixel/1.0'
        }
    };

    const API_BASE = CONFIG.ENV === 'test' ? CONFIG.TEST_API_BASE : CONFIG.PROD_API_BASE;

    // Utilidades
    const log = (...args) => CONFIG.DEBUG && console.log('[SeguroProPixel]', ...args);

    const getParam = (param) =>
        new URL(window.location.href).searchParams.get(param);

    const hasCookie = (name) =>
        document.cookie.split(';').some(c => c.trim().startsWith(name + '='));

    const setCookie = (name, value, days = 30) => {
        const maxAge = days * 24 * 60 * 60;
        document.cookie = `${name}=${value}; path=/; max-age=${maxAge}; samesite=lax`;
    };

    const cleanUrlParam = (param) => {
        const url = new URL(window.location.href);
        url.searchParams.delete(param);
        window.history.replaceState({}, '', url.toString());
    };

    const wasRedirected = () =>
        sessionStorage.getItem(CONFIG.REDIRECTED_KEY) === 'true';

    const setRedirectedFlag = () =>
        sessionStorage.setItem(CONFIG.REDIRECTED_KEY, 'true');

    // Función genérica de requests
    async function sendRequest(endpoint, payload, label) {

        payload = appendExtraParams(payload);

        try {
            log(`Enviando ${label}...`, payload);
            const response = await fetch(`${API_BASE}${endpoint}`, {
                method: 'POST',
                headers: CONFIG.HEADERS,
                body: JSON.stringify(payload)
            });
            const result = await response.json();
            log(`${label} registrada:`, result);
            return result;
        } catch (err) {
            log(`Error al enviar ${label.toLowerCase()}:`, err.message);
        }
    }

    // Agregar parámetros extra al payload
    function appendExtraParams(payload) {
        log('Agregando parámetros extra al payload:', payload);
        if (!payload || typeof payload !== 'object') {
            log('Payload inválido, no se agregan parámetros extra.');
            return payload;
        }
        return {
            ...payload,
            referer: document.referrer || null,
            location: window.location.href,
        }
    }

    // Tracking automático por redirección
    async function handleAffiliateTracking() {
        const affCode = getParam(CONFIG.AFF_PARAM);

        if (!affCode || hasCookie(CONFIG.CLICK_COOKIE) || wasRedirected()) {
            log('No se necesita redirección.');
            log('Código de afiliado:', affCode);
            log('Cookie existente:', hasCookie(CONFIG.CLICK_COOKIE));
            log('Redirección ya realizada:', wasRedirected());
            return;
        }

        const localUrl = window.location.href;

        const data = await sendRequest(
            CONFIG.ENDPOINT_CLICK,
            { code: affCode, url: localUrl },
            'click'
        );

        if (!data?.click_id || !data?.redirect_url) {
            log('Respuesta inválida o incompleta del servidor.');
            return;
        }

        setCookie(CONFIG.CLICK_COOKIE, data.click_id);
        setRedirectedFlag();
        cleanUrlParam(CONFIG.AFF_PARAM);

        log('Redirigiendo a:', data.redirect_url);
        window.location.href = data.redirect_url;
    }

    // Conversión con TTL (1 hora)
    function canSendConversion() {
        const lastSent = sessionStorage.getItem(CONFIG.CONVERSION_SENT_KEY);
        if (!lastSent) return true;

        const elapsed = Date.now() - parseInt(lastSent, 10);
        return elapsed > CONFIG.CONVERSION_TTL_MS;
    }

    function markConversionSent() {
        sessionStorage.setItem(CONFIG.CONVERSION_SENT_KEY, Date.now().toString());
    }

    // Extraer el click_id desde la cookie
    function getClickIdFromCookie() {
        const cookies = document.cookie.split(';');
        for (let cookie of cookies) {
            const [name, value] = cookie.trim().split('=');
            if (name === CONFIG.CLICK_COOKIE && value) {
                return decodeURIComponent(value);
            }
        }
        return null;
    }

    // Generar token random para que en el backend lo revirtamos pero que sea muy muy dificil
    function generateClientToken(clickId) {
        const timestamp = Date.now();
        const salt = Math.random().toString(36).substring(2, 10);
        const base = `${clickId}:${timestamp}:${salt}`;
        const hash = simpleHash(base);
        return `${clickId}.${timestamp}.${salt}.${hash}`;
    }

    function simpleHash(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i++) {
            hash = ((hash << 5) - hash) + str.charCodeAt(i);
            hash |= 0; // Convert to 32bit int
        }
        return Math.abs(hash).toString(36);
    }

    // API global expuesta
    window.spAff = {

        // Enviar eventos personalizados solo si hay click_id
        sendEvent: async (data) => {
            const clickId = getClickIdFromCookie();
            const token = generateClientToken(clickId);
            if (!clickId) {
                log('Evento bloqueado: no existe click_id válido.');
                return;
            }

            const payload = {
                ...data,
                click_id: clickId,
                location: window.location.href,
                mode: 'client_event',
                token
            };

            return await sendRequest(CONFIG.ENDPOINT_EVENT, payload, 'custom_event');
        },

        // Enviar conversión solo si hay click_id y TTL válido
        sendConversion: async (data) => {
            const clickId = getClickIdFromCookie();
            const token = generateClientToken(clickId);
            if (!clickId) {
                log('Conversión bloqueada: no existe click_id válido.');
                return;
            }

            if (!canSendConversion()) {
                log('Conversión bloqueada: ya se envió recientemente.');
                return;
            }

            // data debe tener, order_id, user_id, amount, currency
            if (!data || !data.order_id || !data.user_id || !data.amount || !data.currency) {
                log('Datos de conversión incompletos:', data);
                return;
            }

            const payload = {
                ...data,
                click_id: clickId,
                location: window.location.href,
                event_type: 'client_conversion',
                token
            };

            const result = await sendRequest(CONFIG.ENDPOINT_CONVERSION, payload, 'conversion');
            if (result?.success) {
                markConversionSent();
            }
            return result;
        }
    };

    // Ejecutar automáticamente al cargar
    handleAffiliateTracking();

})();
