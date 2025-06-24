<template>
    <div class="space-y-10 text-sm text-gray-700 dark:text-gray-300">

        <!-- Introducción -->
        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                🔄 Registro de conversiones desde el backend
            </h2>
            <p class="mb-4">
                Para que puedas atribuir correctamente conversiones a tus afiliados desde tu servidor, primero asegúrate de tener el siguiente script incluido en tu sitio. Aunque el proceso de backend no depende del navegador, el script es el que genera la cookie y token que usarás para validar la conversión:
            </p>
            <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gradient-to-br from-black to-gray-800 text-blue-400">
&lt;script src="https://seguropro.app/affiliate/client.js"&gt;&lt;/script&gt;</pre>
            <p class="mb-4">
                Este script gestiona la creación de la cookie <code>sp_click_id</code> y permite generar un token único que valida que la conversión proviene del navegador del usuario.
            </p>
        </section>

        <!-- ¿Cuándo deberías usar el backend? -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🧩 ¿Cuándo deberías usar el backend para registrar conversiones?
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>Cuando el evento ocurre fuera del navegador (una suscripción verificada, pago aprobado en Stripe, webhook de plataforma).</li>
                <li>Cuando necesitas mayor seguridad y control total de los datos enviados.</li>
                <li>Cuando registras la conversión días después del clic, desde un sistema CRM, ERP o LMS.</li>
                <li>Cuando usas lógica personalizada para validar condiciones del usuario o su historial.</li>
            </ul>
        </section>

        <!-- Payload requerido -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                📦 Payload mínimo necesario
            </h3>
            <p class="mb-3">El llamado debe ser un <code>POST</code> a <code>/affiliate/track/conversion</code> con el siguiente JSON:</p>
            <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gradient-to-br from-black to-gray-800 text-orange-400">{
    "click_id": "fe12d938-a12f-4c68-b889-b1f8cc8d1ad1",
    "token": "fe12d938.1719239382.x1p9sl.q8e92c",
    "order_id": "ORD-1234",
    "user_id": "USR-5678",
    "amount": 100,
    "currency": "USD"
}</pre>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                El <code>click_id</code> y el <code>token</code> deben generarse en el frontend con la función <code>generateClientToken(click_id)</code> antes de enviarse al servidor.
            </p>
        </section>

        <!-- Ejemplos por lenguaje -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                💻 Ejemplos en distintos lenguajes
            </h3>
            <div class="grid grid-cols-1 gap-6">

                <!-- PHP Guzzle -->
                <div>
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1">PHP (Guzzle)</h4>
                    <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gray-900 text-green-400">
$client = new \GuzzleHttp\Client();
$client->post('https://seguropro.app/affiliate/track/conversion', [
    'json' => [
        'click_id' => '...',
        'token' => '...',
        'order_id' => 'ORD-1234',
        'user_id' => 'USR-5678',
        'amount' => 100,
        'currency' => 'USD'
    ]
]);</pre>
                </div>

                <!-- Node.js Axios -->
                <div>
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1">Node.js (Axios)</h4>
                    <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gray-900 text-green-400">
const axios = require('axios');

await axios.post('https://seguropro.app/affiliate/track/conversion', {
    click_id: '...',
    token: '...',
    order_id: 'ORD-1234',
    user_id: 'USR-5678',
    amount: 100,
    currency: 'USD'
});</pre>
                </div>

                <!-- Python requests -->
                <div>
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1">Python (requests)</h4>
                    <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gray-900 text-green-400">
import requests

response = requests.post(
    'https://seguropro.app/affiliate/track/conversion',
    json={
        'click_id': '...',
        'token': '...',
        'order_id': 'ORD-1234',
        'user_id': 'USR-5678',
        'amount': 100,
        'currency': 'USD'
    }
)</pre>
                </div>

                <!-- Ruby HTTP -->
                <div>
                    <h4 class="font-semibold text-gray-800 dark:text-white mb-1">Ruby</h4>
                    <pre class="rounded-md p-4 overflow-auto text-sm font-mono bg-gray-900 text-green-400">
require 'net/http'
require 'uri'
require 'json'

uri = URI.parse("https://seguropro.app/affiliate/track/conversion")
request = Net::HTTP::Post.new(uri)
request.content_type = "application/json"
request.body = {
  click_id: '...',
  token: '...',
  order_id: 'ORD-1234',
  user_id: 'USR-5678',
  amount: 100,
  currency: 'USD'
}.to_json

response = Net::HTTP.start(uri.hostname, uri.port, use_ssl: true) do |http|
  http.request(request)
end</pre>
                </div>

            </div>
        </section>

        <!-- Validaciones -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                ✅ Validaciones del sistema y respuestas posibles
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li><code>200 OK</code>: Conversión registrada correctamente.</li>
                <li><code>400</code>: Faltan campos como <code>order_id</code> o <code>click_id</code>.</li>
                <li><code>403</code>: El token es inválido o manipulado.</li>
                <li><code>404</code>: No se encuentra el <code>click_id</code> en la base de datos.</li>
                <li><code>409</code>: Conversión duplicada (TTL activa).</li>
            </ul>
        </section>

        <!-- Buenas prácticas -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🧠 Buenas prácticas y consejos útiles
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>Valida siempre que el <code>click_id</code> venga desde el navegador del usuario (almacenado en cookie).</li>
                <li>Genera el token en frontend y pásalo al backend para su envío seguro.</li>
                <li>Nunca generes el token directamente desde backend.</li>
                <li>Evita enviar conversiones múltiples desde eventos automáticos.</li>
                <li>Para pruebas, usa el entorno <code>test</code> con la URL <code>https://seguropro.test.com</code>.</li>
            </ul>
        </section>

    </div>
</template>

<script>
export default {
    name: 'BackendEventsDocumentation'
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