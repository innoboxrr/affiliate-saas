<template>
    <div class="space-y-10 text-sm text-gray-700 dark:text-gray-300">

        <!-- Introducción -->
        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                🏷️ Conversión automática desde el sistema (eventos locales)
            </h2>
            <p class="mb-4">
                Si eres agente de seguros y utilizas SeguroPro, no necesitas hacer integraciones técnicas para registrar conversiones. El sistema ya cuenta con lógica integrada para atribuir conversiones a tus afiliados de manera automática.
            </p>
        </section>

        <!-- ¿Cómo funciona? -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                ⚙️ ¿Cómo funciona?
            </h3>
            <p class="mb-4">
                Cuando uno de tus referidos comparte su enlace de afiliado y una persona se registra en alguna de tus páginas, se crea un lead en tu CRM. Si ese lead fue referido, queda automáticamente vinculado al afiliado correspondiente.
            </p>
            <p class="mb-4">
                Cuando tú conviertes ese lead en cliente desde el panel de SeguroPro, el sistema registra la conversión y calcula automáticamente la comisión.
            </p>
        </section>

        <!-- Ventajas del sistema local -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🚀 Ventajas del sistema integrado
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>No necesitas incluir scripts ni realizar llamadas manuales a la API.</li>
                <li>Todo el proceso de conversión ocurre dentro del flujo natural del CRM.</li>
                <li>La conversión se puede activar automáticamente o manualmente según tu criterio.</li>
                <li>Compatible con leads que se importan, registran o generan vía formularios o endpoints.</li>
            </ul>
        </section>

        <!-- Opciones de configuración -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                ⚙️ Opciones disponibles para personalizar la conversión
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>Definir un monto fijo por conversión desde la configuración del programa.</li>
                <li>Modificar el monto de forma manual al momento de convertir el lead.</li>
                <li>Establecer porcentajes variables dependiendo del tipo de póliza o negociación.</li>
                <li>Asociar múltiples conversiones por lead si el cliente contrata varios servicios.</li>
            </ul>
        </section>

        <!-- Ejemplo práctico -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                📘 Ejemplo práctico
            </h3>
            <p class="mb-4">
                Tienes un afiliado que comparte su enlace en redes sociales. Un prospecto entra, se registra en tu landing page y aparece en tu CRM. Al hablar con el prospecto, logras cerrar una póliza. Solo necesitas ir a su ficha, dar clic en "Marcar como cliente" y automáticamente se dispara la conversión, calculando su comisión correspondiente.
            </p>
        </section>

        <!-- Recomendaciones -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🧠 Buenas prácticas
            </h3>
            <ul class="list-disc ml-10 space-y-2">
                <li>Habla con tus afiliados y explícales que lo importante es que sus referidos llenen el formulario de lead.</li>
                <li>Puedes validar manualmente que el cliente haya sido cerrado antes de registrar la comisión.</li>
                <li>Utiliza campañas de remarketing para convertir leads referidos que no compraron en su primer intento.</li>
                <li>Desde la vista del cliente puedes ver quién fue el afiliado que lo refirió, para revisar historial o ajustar comisiones.</li>
            </ul>
        </section>

        <!-- Conclusión -->
        <section>
            <p class="text-base">
                El sistema se adapta a tu flujo de trabajo: tú decides cuándo y cómo registrar la conversión. No necesitas programar nada ni hacer integraciones adicionales.
            </p>
        </section>

    </div>
</template>

<script>
export default {
    name: 'LocalConversionEventsDocumentation'
}
</script>
