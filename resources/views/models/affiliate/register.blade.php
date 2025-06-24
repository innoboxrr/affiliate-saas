<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $program->name }} - Registro de Afiliados</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script>
            function showStep(step) {
                document.querySelectorAll('[data-step]').forEach(el => el.classList.add('hidden'));
                document.querySelector(`[data-step="${step}"]`).classList.remove('hidden');
                document.getElementById('currentStep').value = step;
            }

            function validateStep(step) {
                const stepElement = document.querySelector(`[data-step="${step}"]`);
                const requiredInputs = stepElement.querySelectorAll('input[required], select[required], textarea[required]');
                let valid = true;

                console.log(requiredInputs);

                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('border-red-500');
                        valid = false;
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });

                return valid;
            }

            function nextStep() {
                console.log('Next Step');
                const current = parseInt(document.getElementById('currentStep').value);
                if (validateStep(current)) {
                    showStep(current + 1);
                }
            }

            function prevStep() {
                const current = parseInt(document.getElementById('currentStep').value);
                showStep(current - 1);
            }
        </script>

    </head>
    <body class="min-h-screen bg-gray-100 flex items-center justify-center">

        <div 
            class="relative w-full min-h-screen bg-gray-900 bg-cover bg-center" 
            style="background-image: url('{{ asset($program->payload['registration_image']) }}');">

            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <div class="relative z-10 flex items-center justify-center min-h-screen px-4">
                <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg p-8">
                    <div class="text-center mb-6">
                        <h2 class="text-3xl font-extrabold text-gray-900">
                            {{ $program->payload['registration_title'] ?? 'Únete al programa de afiliados' }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600">
                            {{ $program->payload['registration_description'] ?? 'Regístrate y gana comisiones recomendando nuestros productos.' }}
                        </p>
                    </div>

                    <form 
                        method="POST" 
                        action="{{ route('api.innoboxrr.affiliatesaas.affiliate.create') }}">
                        
                        @csrf

                        <input type="hidden" name="affiliate_program_id" value="{{ $program->id }}">
                        <input type="hidden" name="workspace_id" value="{{ $program->workspace_id }}">
                        <input type="hidden" name="current_step" id="currentStep" value="1">

                        {{-- Paso 1: Datos del usuario --}}
                        <div data-step="1">
                            <div class="mb-4">
                                <label 
                                    for="user_name" 
                                    class="block text-sm font-medium text-gray-700">
                                    Nombre Completo
                                </label>
                                <input 
                                    type="text" 
                                    name="user_name" 
                                    id="user_name" 
                                    placeholder="Ingresa tu nombre completo"
                                    required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm w-full">
                            </div>

                            <div class="mb-4">
                                <label 
                                    for="user_email" 
                                    class="block text-sm font-medium text-gray-700">
                                    Correo electrónico
                                </label>
                                <input 
                                    type="email" 
                                    name="user_email" 
                                    id="user_email" 
                                    placeholder="Ingresa tu correo electrónico"
                                    required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm w-full">
                            </div>

                            <div class="mb-4">
                                <label 
                                    for="dial_code" 
                                    class="block text-sm font-medium text-gray-700">
                                    Código de pais
                                </label>
                                <input 
                                    type="number" 
                                    name="dial_code" 
                                    id="dial_code" 
                                    placeholder="52 (No coloques el +)"
                                    required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm w-full">
                            </div>

                            <div class="mb-4">
                                <label 
                                    for="user_phone" 
                                    class="block text-sm font-medium text-gray-700">
                                    Teléfono
                                </label>
                                <input 
                                    type="text" 
                                    name="user_phone" 
                                    id="user_phone" 
                                    placeholder="Ingresa tu número de teléfono"
                                    required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm w-full">
                            </div>

                            <div class="flex justify-end">
                                <button 
                                    type="button" 
                                    onclick="nextStep()" 
                                    class="bg-blue-600 text-white px-4 py-2 rounded">
                                    Siguiente →
                                </button>
                            </div>
                        </div>

                        {{-- Paso 2: Contacto y redes --}}
                        <div data-step="2" class="hidden">

                            <h3 class="text-lg font-semibold mb-4">Información de Contacto</h3>
                            <div class="grid grid-cols-2 gap-4 mb-4">

                                <div>
                                    <label 
                                        for="address_street" 
                                        class="block text-sm font-medium text-gray-700">
                                        Calle
                                    </label>
                                    <input 
                                        type="text" 
                                        name="address_street" 
                                        id="address_street"
                                        placeholder="Ej. Av. Reforma 123"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="address_city" 
                                        class="block text-sm font-medium text-gray-700">
                                        Ciudad
                                    </label>
                                    <input 
                                        type="text" 
                                        name="address_city" 
                                        id="address_city"
                                        placeholder="Ej. Ciudad de México"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="address_state" 
                                        class="block text-sm font-medium text-gray-700">
                                        Estado
                                    </label>
                                    <input 
                                        type="text" 
                                        name="address_state" 
                                        id="address_state"
                                        placeholder="Ej. Jalisco"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="address_country" 
                                        class="block text-sm font-medium text-gray-700">
                                        País
                                    </label>
                                    <input 
                                        type="text" 
                                        name="address_country" 
                                        id="address_country"
                                        placeholder="Ej. México"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="address_zip" 
                                        class="block text-sm font-medium text-gray-700">
                                        Código Postal
                                    </label>
                                    <input 
                                        type="text" 
                                        name="address_zip" 
                                        id="address_zip"
                                        placeholder="Ej. 01000"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <h3 class="text-lg font-semibold mb-4">Redes Sociales y Sitios Web</h3>
                            <div class="grid grid-cols-2 gap-4 mb-4">

                                <div>
                                    <label 
                                        for="links_website" 
                                        class="block text-sm font-medium text-gray-700">
                                        Sitio Web
                                    </label>
                                    <input 
                                        type="url" 
                                        name="links_website" 
                                        id="links_website"
                                        placeholder="https://www.tusitio.com"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="links_facebook" 
                                        class="block text-sm font-medium text-gray-700">
                                        Facebook
                                    </label>
                                    <input 
                                        type="url" 
                                        name="links_facebook" 
                                        id="links_facebook"
                                        placeholder="https://facebook.com/tuperfil"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="links_twitter" 
                                        class="block text-sm font-medium text-gray-700">
                                        Twitter
                                    </label>
                                    <input 
                                        type="url" 
                                        name="links_twitter" 
                                        id="links_twitter"
                                        placeholder="https://twitter.com/tuusuario"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="links_instagram" 
                                        class="block text-sm font-medium text-gray-700">
                                        Instagram
                                    </label>
                                    <input 
                                        type="url" 
                                        name="links_instagram" 
                                        id="links_instagram"
                                        placeholder="https://instagram.com/tuusuario"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="links_linkedin" 
                                        class="block text-sm font-medium text-gray-700">
                                        LinkedIn
                                    </label>
                                    <input 
                                        type="url" 
                                        name="links_linkedin" 
                                        id="links_linkedin"
                                        placeholder="https://linkedin.com/in/tuusuario"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="links_youtube" 
                                        class="block text-sm font-medium text-gray-700">
                                        YouTube
                                    </label>
                                    <input 
                                        type="url" 
                                        name="links_youtube" 
                                        id="links_youtube"
                                        placeholder="https://youtube.com/tuusuario"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="links_tiktok" 
                                        class="block text-sm font-medium text-gray-700">
                                        TikTok
                                    </label>
                                    <input 
                                        type="url" 
                                        name="links_tiktok" 
                                        id="links_tiktok"
                                        placeholder="https://tiktok.com/@tuusuario"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="flex justify-between">
                                <button 
                                    type="button" 
                                    onclick="prevStep()" 
                                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded">
                                    ← Atrás
                                </button>

                                <button 
                                    type="button" 
                                    onclick="nextStep()" 
                                    class="bg-blue-600 text-white px-4 py-2 rounded">
                                    Siguiente →
                                </button>
                            </div>

                        </div>

                        {{-- Paso 3: Datos financieros --}}
                        <div data-step="3" class="hidden">

                            <div class="mb-4">
                                <label 
                                    for="financial_affiliate_type" 
                                    class="block text-sm font-medium text-gray-700">
                                    Tipo de afiliado
                                </label>
                                <select 
                                    name="financial_affiliate_type" 
                                    id="financial_affiliate_type" 
                                    required
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="influencer">Influencer</option>
                                    <option value="empresa">Empresa</option>
                                    <option value="particular">Particular</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label 
                                        for="financial_tax_id" 
                                        class="block text-sm font-medium text-gray-700">
                                        RFC / Tax ID
                                    </label>
                                    <input 
                                        type="text" 
                                        name="financial_tax_id" 
                                        id="financial_tax_id"
                                        placeholder="RFC o ID fiscal"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label 
                                        for="financial_comercial_name" 
                                        class="block text-sm font-medium text-gray-700">
                                        Nombre comercial
                                    </label>
                                    <input 
                                        type="text" 
                                        name="financial_comercial_name" 
                                        id="financial_comercial_name"
                                        placeholder="Ej. Mi Marca SA de CV"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <h3 class="text-lg font-semibold mb-4">Información Bancaria para Transferencias</h3>

                            <div class="mb-4" hidden>
                                <label 
                                    for="financial_payment_method" 
                                    class="block text-sm font-medium text-gray-700">
                                    Método de pago
                                </label>
                                <select 
                                    name="financial_payment_method" 
                                    id="financial_payment_method" 
                                    required 
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                        focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    disabled>
                                    <option value="bank_transfer" selected>Transferencia bancaria</option>
                                </select>
                                <input 
                                    type="hidden" 
                                    name="financial_payment_method" 
                                    value="bank_transfer">
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">

                                <div>
                                    <label 
                                        for="financial_bank_name" 
                                        class="block text-sm font-medium text-gray-700">
                                        Banco
                                    </label>
                                    <input 
                                        type="text" 
                                        name="financial_bank_name" 
                                        id="financial_bank_name" 
                                        placeholder="Ej. BBVA, Banorte, Citibanamex"
                                        required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="financial_account_holder" 
                                        class="block text-sm font-medium text-gray-700">
                                        Titular de la cuenta
                                    </label>
                                    <input 
                                        type="text" 
                                        name="financial_account_holder" 
                                        id="financial_account_holder" 
                                        placeholder="Nombre del beneficiario"
                                        required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="financial_clabe" 
                                        class="block text-sm font-medium text-gray-700">
                                        CLABE interbancaria
                                    </label>
                                    <input 
                                        type="text" 
                                        name="financial_clabe" 
                                        id="financial_clabe" 
                                        placeholder="18 dígitos"
                                        maxlength="18"
                                        required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="financial_swift" 
                                        class="block text-sm font-medium text-gray-700">
                                        Código SWIFT
                                    </label>
                                    <input 
                                        type="text" 
                                        name="financial_swift" 
                                        id="financial_swift" 
                                        placeholder="Código internacional del banco"
                                        required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="financial_tax_id" 
                                        class="block text-sm font-medium text-gray-700">
                                        RFC del beneficiario
                                    </label>
                                    <input 
                                        type="text" 
                                        name="financial_tax_id" 
                                        id="financial_tax_id" 
                                        placeholder="RFC o equivalente"
                                        required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                                <div>
                                    <label 
                                        for="financial_country" 
                                        class="block text-sm font-medium text-gray-700">
                                        País de la cuenta
                                    </label>
                                    <input 
                                        type="text" 
                                        name="financial_country" 
                                        id="financial_country" 
                                        placeholder="Ej. México"
                                        required
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2 
                                            focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>

                            </div>

                            <div class="flex justify-between">
                                <button 
                                    type="button" 
                                    onclick="prevStep()" 
                                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded">
                                    ← Atrás
                                </button>

                                <button 
                                    type="submit" 
                                    class="bg-green-600 text-white px-4 py-2 rounded">
                                    Finalizar
                                </button>
                            </div>

                        </div>


                        @if ($errors->any())
                            <div class="mt-4 text-sm text-red-600">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
