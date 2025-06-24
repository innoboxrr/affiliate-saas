<template>
    <div class="space-y-10 text-sm text-gray-700 dark:text-gray-300">

        <!-- Introducción -->
        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                🎯 Eventos de conversión desde frontend
            </h2>
            <p class="mb-4">
                Si deseas que el sistema registre automáticamente las conversiones asociadas a tus afiliados, el primer paso es incluir el siguiente script en tu sitio web:
            </p>
            <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gradient-to-br from-black to-gray-800 text-blue-400">
&lt;script src="https://seguropro.app/affiliate/client.js"&gt;&lt;/script&gt;</pre>
            <p class="mb-4">
                Este script activa un sistema inteligente que identifica los clics en enlaces de afiliados y guarda una cookie especial llamada <code>sp_click_id</code>. Esa cookie es lo que permitirá más adelante atribuir correctamente cualquier conversión que ocurra en tu sitio.
            </p>
            <p class="mb-4">
                Esta solución es ideal para promocionar productos digitales como cursos, ebooks, membresías o incluso integrarse con plataformas externas que no controlas completamente. 
            </p>
        </section>

        <!-- ¿Qué hace spAff.sendConversion()? -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                ⚙️ ¿Qué hace <code>spAff.sendConversion()</code>?
            </h3>
            <p class="mb-4">
                Esta función es la encargada de reportar al sistema que una acción de valor ha sido completada: una compra, una suscripción o cualquier evento que tú consideres una conversión. 
            </p>
            <p class="mb-4">
                Si existe una cookie válida generada por un afiliado, el sistema relacionará esta conversión automáticamente con él y calculará su comisión.
            </p>
        </section>

        <!-- ¿Cuándo usarlo? -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                📌 ¿Cuándo deberías usar este método?
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>Cuando vendes productos digitales o servicios y todo el flujo ocurre en el navegador.</li>
                <li>Cuando no puedes o no quieres hacer integración técnica con tu backend.</li>
                <li>Cuando usas pasarelas de pago como Stripe, PayPal, MercadoPago, etc.</li>
                <li>En páginas de gracias, pantallas de éxito o confirmación de compra.</li>
                <li>Cuando integras tu curso o funnel en plataformas externas donde solo tienes control parcial.</li>
            </ul>
        </section>

        <!-- Requisitos -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                ✅ Requisitos mínimos del objeto enviado
            </h3>
            <p class="mb-3">Para que el sistema registre correctamente la conversión, debes enviar estos datos:</p>
            <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gradient-to-br from-black to-gray-800 text-orange-400">spAff.sendConversion({
    order_id: 'ORD-1234',
    user_id: 'USR-5678',
    amount: 100,
    currency: 'USD'
})</pre>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                Estos campos son esenciales para identificar la conversión, asociarla al afiliado correcto y calcular la comisión.
            </p>
        </section>

        <!-- TTL y protección -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🔐 Validaciones y protecciones automáticas
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>Solo se permite una conversión por cookie por hora (TTL de 3600 segundos).</li>
                <li>Se genera un token especial en el navegador que el servidor valida internamente.</li>
                <li>Si no existe cookie válida o hay manipulación, la conversión se rechaza.</li>
                <li>La conversión incluye además la URL donde ocurrió el evento y la hora exacta.</li>
            </ul>
        </section>

        <!-- Respuestas del servidor -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                📥 Posibles respuestas del servidor
            </h3>
            <ul class="list-disc ml-10 space-y-1">
                <li><code>200 OK</code>: Conversión registrada exitosamente.</li>
                <li><code>400</code>: Falta algún campo requerido como <code>order_id</code> o <code>amount</code>.</li>
                <li><code>403</code>: Token inválido o alterado.</li>
                <li><code>404</code>: No se encontró un <code>click_id</code> válido.</li>
                <li><code>409</code>: Ya se reportó una conversión recientemente para esta cookie.</li>
            </ul>
        </section>

        <!-- Buenas prácticas -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🧠 Buenas prácticas para conversiones desde frontend
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>Ubica el llamado justo después de confirmar una acción, no antes.</li>
                <li>Evita usarlo en múltiples lugares a la vez para prevenir conversiones duplicadas.</li>
                <li>Revisa en consola que no aparezcan errores al llamar la función.</li>
                <li>Para pruebas en modo sandbox, asegúrate que <code>CONFIG.ENV</code> esté en <code>'test'</code>.</li>
            </ul>
        </section>

        <!-- Ejemplo completo paso a paso -->
        <section>
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🛠️ Ejemplo completo con validación previa
            </h3>
            <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gradient-to-br from-black to-gray-800 text-green-400">const submitCheckout = async () => {
    // Validar que el pago fue exitoso
    const pagoExitoso = await confirmarPago();
    if (!pagoExitoso) return;

    // Reportar conversión
    spAff.sendConversion({
        order_id: 'ORD-20250623',
        user_id: 'user_8881',
        amount: 199,
        currency: 'MXN'
    });
};</pre>
        </section>

    </div>
</template>

<script>
export default {
    name: 'FrontendEventsDocumentation'
}
</script>

<style scoped>
pre {
    font-family: 'Fira Code', monospace;
    font-size: 0.875rem;
    line-height: 1.5;
    white-space: pre;
    border: 1px solid #333;
    box-shadow: 0 0 0 1px #00000020;
    background: #212121;
    margin-bottom: 10px;
}
</style>