<template>
    <div class="border rounded-lg">
        <!-- Header collapsible -->
        <div 
            class="flex justify-between items-center px-4 py-4 border-b bg-gray-50 dark:bg-gray-700 cursor-pointer"
            :class="{
                'rounded-lg': collapsed,
                'rounded-t-lg': !collapsed
            }" 
            @click="collapsed = !collapsed">
            <span class="text-base font-semibold text-gray-800 dark:text-white">
                📘 Documentación Técnica de Integración de Afiliados
            </span>
            <i :class="['fa-solid', collapsed ? 'fa-chevron-down' : 'fa-chevron-up', 'text-gray-400']"></i>
        </div>

        <!-- Contenido -->
        <div v-show="!collapsed" class="p-6 bg-white dark:bg-gray-900 space-y-8 text-sm text-gray-700 dark:text-gray-300">

            <!-- Paso 1: Incluir script -->
            <section>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">1️⃣ Instalación del script</h4>
                <p class="mb-3">Agrega el siguiente script antes del cierre de la etiqueta <code>&lt;/body&gt;</code> de tu sitio web:</p>
                <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gradient-to-br from-black to-gray-800 text-green-400">&lt;script src="https://seguropro.app/affiliate/client.js"&gt;&lt;/script&gt;</pre>
            </section>

            <!-- Paso 2: Comportamiento automático -->
            <section>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">2️⃣ Funcionamiento automático del pixel</h4>
                <p class="mb-3">Cuando un visitante accede a tu sitio con un enlace de afiliado, el sistema realiza lo siguiente:</p>
                <ul class="list-disc ml-6 space-y-1">
                    <li>Detecta el parámetro <code>?sp-aff=CODE</code> en la URL.</li>
                    <li>Envía una solicitud <code>POST</code> a <code>/affiliate/track/click</code> con el código y URL actual.</li>
                    <li>Recibe un <code>click_id</code> y guarda una cookie llamada <code>sp_click_id</code>.</li>
                    <li>Redirige automáticamente a la URL destino configurada.</li>
                </ul>
            </section>

            <!-- Paso 3: Registrar conversión desde frontend -->
            <section>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">3️⃣ Conversión desde el frontend</h4>
                <p class="mb-3">
                    Es posible registrar conversiones directamente desde el frontend activando la opción
                    <strong>"Enable frontend conversions"</strong> dentro de la configuración del programa de afiliación.
                </p>
                <p class="mb-3">
                    Este método permite que el navegador del usuario envíe la conversión tras una acción como una compra, suscripción o registro exitoso.
                    Para ejecutarlo, debes llamar a:
                </p>
                <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gradient-to-br from-black to-gray-800 text-orange-400">spAff.sendConversion({
    order_id: 'ORD-1234',
    user_id: 'USR-5678',
    amount: 100,
    currency: 'USD'
})</pre>
                <p class="mt-3">
                    Es obligatorio proporcionar <code>order_id</code>, <code>user_id</code>, <code>amount</code> y <code>currency</code> para que la conversión sea válida.
                </p>
                <p class="text-sm text-yellow-600 dark:text-yellow-400 mt-2">
                    ⚠️ Las conversiones desde frontend son susceptibles a abuso. Aunque el sistema implementa validaciones como tokens y control de TTL,
                    se recomienda monitorear su uso y evaluar si realmente se necesita este tipo de conversión.
                </p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    ✅ Solo se permite una conversión por cookie por hora para prevenir duplicaciones.
                </p>
                <p class="mt-4">
                    Para entornos más seguros y controlados, recomendamos utilizar la conversión desde el servidor descrita en la siguiente sección.
                </p>
            </section>

            <!-- Paso 4: Registrar conversión desde backend -->
            <section>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">4️⃣ Conversión desde el backend</h4>
                <p class="mb-3">Envía un <code>POST</code> a <code>/affiliate/track/conversion</code> con el siguiente payload:</p>
                <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gradient-to-br from-black to-gray-800 text-orange-400">{
    "click_id": "fe12d938-a12f-4c68-b889-b1f8cc8d1ad1",
    "token": "fe12d938.1719239382.x1p9sl.q8e92c",
    "order_id": "ORD-1234",
    "user_id": "USR-5678",
    "amount": 100,
    "currency": "USD"
}</pre>
                <p class="mt-2">El <code>token</code> debe generarse desde el frontend con <code>generateClientToken(click_id)</code>. Esto asegura que la conversión provenga de una fuente legítima.</p>
            </section>

            <!-- Ejemplos por lenguaje -->
            <section>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">🧪 Ejemplos por lenguaje</h4>

                <p class="mb-1 font-medium">Con <strong>cURL</strong>:</p>
                <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gray-100 dark:bg-gray-800 text-blue-500">curl -X POST https://seguropro.test.com/affiliate/track/conversion \
  -H "Content-Type: application/json" \
  -d '{
        "click_id": "...",
        "token": "...",
        "order_id": "ORD-1234",
        "user_id": "USR-5678",
        "amount": 100,
        "currency": "USD"
      }'</pre>

                <p class="mb-1 font-medium mt-4">Con <strong>PHP (Guzzle)</strong>:</p>
                <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gray-100 dark:bg-gray-800 text-blue-400">
$client = new \GuzzleHttp\Client();
$client->post('https://seguropro.test.com/affiliate/track/conversion', [
    'json' => [
        'click_id' => '...',
        'token' => '...',
        'order_id' => 'ORD-1234',
        'user_id' => 'USR-5678',
        'amount' => 100,
        'currency' => 'USD'
    ]
]);</pre>
            </section>

            <!-- Validaciones -->
            <section>
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">✅ Validaciones y respuestas esperadas</h4>
                <ul class="list-disc ml-10 space-y-1">
                    <li><code>200 OK</code>: Conversión registrada correctamente.</li>
                    <li><code>400</code>: Faltan campos obligatorios como <code>click_id</code>.</li>
                    <li><code>403</code>: Token inválido o manipulado.</li>
                    <li><code>404</code>: No se encontró el click.</li>
                    <li><code>409</code>: Ya existe una conversión previa registrada.</li>
                </ul>
            </section>

        </div>
    </div>
</template>

<script>
export default {
    name: 'AffiliatePixelDocumentation',
    props: {
        code: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            collapsed: true
        }
    }
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
}
</style>