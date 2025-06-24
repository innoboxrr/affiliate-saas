<template>
    <div class="space-y-10 text-sm text-gray-700 dark:text-gray-300">

        <!-- Introducción -->
        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                ⚙️ ¿Cómo funciona el sistema de afiliados?
            </h2>
            <p class="mb-4">
                A través del sistema de afiliados, puedes invitar personas a promocionar tu producto. Ellos recibirán un código único para generar enlaces de seguimiento. Cada conversión atribuida les generará una comisión.
            </p>
            <p class="mb-4">
                El sistema está diseñado para adaptarse a diferentes modelos de negocio: puedes usarlo para promocionar productos físicos, recursos digitales, cursos en línea, membresías, servicios recurrentes y más.
            </p>
            <p class="mb-4">
                La integración es sencilla: solo debes instalar un pequeño script en tu sitio web o aplicación externa. Este script se encarga de registrar los clics y colocar una cookie con el ID del afiliado, lo cual permite rastrear futuras conversiones.
            </p>
        </section>

        <!-- Flujo general -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🔄 Flujo general del sistema
            </h3>
            <ol class="list-decimal ml-10 space-y-2">
                <li>Creas un programa de afiliados desde tu panel.</li>
                <li>Compartes el enlace de registro con tus afiliados.</li>
                <li>Ellos acceden a su panel y obtienen enlaces de promoción.</li>
                <li>Cuando alguien entra con ese enlace, se registra un click y se instala una cookie de seguimiento.</li>
                <li>Si el visitante realiza una acción (ej. compra, registro, suscripción), el sistema verifica si hay una cookie activa y reporta la conversión al afiliado correspondiente.</li>
                <li>Las comisiones se calculan en función de los parámetros definidos (valor fijo, porcentaje, categorías).</li>
                <li>Los resultados se muestran en tiempo real en el panel de cada afiliado.</li>
            </ol>
        </section>

        <!-- Escenarios de ejemplo -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                📌 Escenarios comunes de uso
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li><strong>Afiliados para cursos digitales:</strong> Permite que influencers compartan tu curso y ganen una comisión por cada venta.</li>
                <li><strong>Venta de software:</strong> Cada vez que un usuario se registra y paga una suscripción, se asigna automáticamente la comisión al afiliado.</li>
                <li><strong>Servicios externos:</strong> Un asesor comparte tu enlace, el cliente llega a tu sitio, y al contratar, se le otorga la comisión.</li>
                <li><strong>Afiliación interna:</strong> Automatiza la conversión cuando el sistema detecta que un lead fue cerrado por un afiliado.</li>
            </ul>
        </section>

        <!-- Configuraciones disponibles -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🛠️ Opciones de configuración
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>Puedes permitir que los afiliados se registren de forma automática o agregarlos manualmente desde el panel.</li>
                <li>Las conversiones pueden reportarse desde el frontend (flexible pero menos seguro) o desde el backend (seguro y preciso).</li>
                <li>También puedes disparar conversiones desde flujos internos, como cuando un lead en tu CRM cambia de etapa a "cliente".</li>
                <li>El valor de la conversión puede ser fijo, o porcentual en base al monto de una compra o ingreso asociado.</li>
                <li>Puedes definir cookies de duración limitada para establecer ventanas de atribución.</li>
                <li>Soporte para conversiones múltiples o únicas por clic, dependiendo de la lógica que desees aplicar.</li>
            </ul>
        </section>

        <!-- Ventajas del sistema -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🚀 Ventajas del sistema
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>No necesitas gestionar todo manualmente, el sistema automatiza el seguimiento y la atribución.</li>
                <li>Visualización clara de clics, conversiones y comisiones desde los paneles del afiliado y administrador.</li>
                <li>Soporte para acciones personalizadas, campañas, y filtros por origen o dispositivo.</li>
                <li>Funciona desde el frontend, backend o eventos internos, integrándose perfectamente con tu negocio.</li>
            </ul>
        </section>
    </div>
</template>

<script>
export default {
    name: 'HowItWorksDocumentation'
}
</script>
