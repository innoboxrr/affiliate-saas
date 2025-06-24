<template>
    <div class="space-y-10 text-sm text-gray-700 dark:text-gray-300">

        <!-- Introducción -->
        <section class="mb-6">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                📢 Invita a nuevos afiliados a tu programa
            </h2>
            <p class="mb-4">
                Comparte el siguiente enlace con las personas que deseas invitar. Ellos podrán registrarse como afiliados y empezar a generar comisiones por cada conversión atribuida a su referencia.
            </p>
        </section>

        <!-- Enlace de invitación -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🔗 Enlace único de invitación
            </h3>
            <p class="mb-2">
                Este es tu enlace de registro para nuevos afiliados:
            </p>
            <clipboard-input
                :value="program.affiliate_register_url"
                class="block w-full text-blue-600 hover:text-blue-800 hover:underline dark:text-blue-300 dark:hover:text-blue-400"
            />
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                Puedes acortarlo con herramientas como Bitly o usarlo directamente en tu sitio web, redes sociales, o campañas por correo.
            </p>
        </section>

        <!-- Beneficios para el afiliado -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                🎁 Beneficios para el afiliado
            </h3>
            <p class="mb-2">
                Al registrarse, los afiliados podrán:
            </p>
            <ul class="list-disc ml-6 space-y-1">
                <li>Acceder a su panel de afiliado personalizado.</li>
                <li>Obtener enlaces de seguimiento con su código único.</li>
                <li>Ver sus clics, conversiones y comisiones en tiempo real.</li>
                <li>Solicitar retiros de sus ganancias.</li>
            </ul>
        </section>

        <!-- Buenas prácticas para invitar -->
        <section class="mb-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-2">
                ✅ Buenas prácticas al invitar
            </h3>
            <ul class="list-disc ml-6 space-y-1">
                <li>Explica de forma clara qué es el programa y cómo se generan ingresos.</li>
                <li>Incluye testimonios, casos de éxito o cifras para motivar.</li>
                <li>Facilita la inscripción con una llamada a la acción directa.</li>
                <li>No prometas ingresos garantizados: sé transparente.</li>
            </ul>
        </section>

        <!-- Cierre -->
        <section class="mb-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Si necesitas ayuda para crear materiales de promoción para invitar afiliados, puedes contactar con nuestro equipo de soporte o revisar las plantillas sugeridas.
            </p>
        </section>
    </div>
</template>

<script>
export default {
    name: 'InviteAffiliatesDocumentation',
    props: {
        program: {
            type: Object,
            required: true
        }
    },
    emits: ['close'],
}
</script>

<style scoped>
pre {
    font-family: 'Fira Code', monospace;
    font-size: 0.875rem;
    line-height: 1.5;
    white-space: pre-wrap;
    word-break: break-word;
    background: #212121;
    border: 1px solid #333;
    box-shadow: 0 0 0 1px #00000020;
    color: #00ff99;
}
</style>