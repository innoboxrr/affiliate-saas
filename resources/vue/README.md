# InnoboxRR Affiliate SaaS

`innoboxrr-affiliate-saas` es un sistema completo para la gestión de afiliados en plataformas Laravel. Permite integrar funcionalidades clave para manejar programas de afiliados, links, clics, conversiones, pagos y más. Su arquitectura está orientada a microservicios con extensión modular, y aprovecha filtros, relaciones personalizadas, y un sistema robusto de metadatos.

---

## Características

### 🔎 Seguimiento de Actividad

* Seguimiento de clics, links y conversiones.
* Relación completa entre afiliados, programas, clics y pagos.

### 🎁 Sistema de Programas

* Creación de programas de afiliación por workspace.
* Asignación automática de links.

### 💰 Pagos

* Registro y seguimiento de pagos a afiliados.
* Metadatos editables para registrar detalles bancarios, condiciones o estados de revisión.

### 📈 Métricas e Informes

* Total de clics, conversiones, payout pendientes y aprobados.
* Integración con dashboards.

---

## Instalación

### 1. Instalar el paquete

```bash
composer require innoboxrr/affiliate-saas
```

### 2. Publicar archivos

```bash
php artisan vendor:publish --tag=affiliate-saas-config
php artisan vendor:publish --tag=affiliate-saas-migrations
```

### 3. Ejecutar migraciones

```bash
php artisan migrate
```

### 4. Configurar clases relacionadas en `config/affiliate.php`

```php
return [
    'user_class' => App\Models\User::class,
    'workspace_class' => App\Models\Workspace::class,
];
```

---

## Estructura de Modelos

### 🔗 `Affiliate`

Representa al usuario afiliado. Tiene relación con `User`, `Workspace`, `AffiliateLink`, `AffiliateConversion` y `AffiliateMeta`.

### 🖐️ `AffiliateLink`

Contiene la URL personalizada de cada afiliado dentro de un programa. Pertenece a un `AffiliateProgram` y `Affiliate`.

### ✨ `AffiliateClick`

Guarda los clics realizados sobre los links de afiliado. Relaciona con `AffiliateLink` y contiene `AffiliateConversion`.

### 🏛️ `AffiliateConversion`

Registra una conversión (ej. compra). Puede estar relacionada con un `AffiliateClick`, `AffiliateLink`, `AffiliatePayout`, y mediante `BelongsToThrough` con el `Affiliate`.

### 💳 `AffiliatePayout`

Contiene el pago a uno o más afiliados. Puede tener metas y conversiones asociadas.

### 📅 `AffiliateProgram`

Definición de un programa de afiliación. Tiene links, assets y afiliados asociados.

### 🖊️ `AffiliateAsset`

Recursos publicitarios (banners, videos, PDF) relacionados a un programa.

---

## Traits

Todos los modelos tienen sus propios Traits de relaciones, organizados en:

```
Innoboxrr\AffiliateSaas\Models\Traits\Relations
```

Esto permite desacoplar la lógica y mantener los modelos limpios.

---

## Filtros para Busquedas y Eager Loading

Cada modelo tiene su filtro `EagerLoadingFilter` para cargar relaciones condicionalmente con base en los datos entrantes.

Ejemplo:

```php
if ($data->load_relation == true) {
    $query->with(['affiliate', 'link']);
}
```

Esto se genera automáticamente según las relaciones del modelo y permite una carga flexible.

---

## Políticas (Traits)

El paquete define políticas reutilizables para acciones como:

* Crear programas
* Gestionar links
* Ver conversiones

Se encuentran en:

```
App\Services\User\Affiliate\Traits
```

Y se importan desde un trait general:

```php
use App\Services\User\Affiliate\AffiliatePolicies;
```

---

## API e Integración

Puedes exponer estos modelos vía API para integrarlos a frontends como Vue o Inertia, usando recursos, policies y autorizaciones.

Ejemplo de estructura de rutas:

```php
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('affiliate-programs', AffiliateProgramController::class);
    Route::apiResource('affiliate-links', AffiliateLinkController::class);
});
```

Aquí tienes la sección **Instalación** adaptada de forma profesional, clara y completa para el paquete `innoboxrr-vue-affiliate`, con todos los nombres, rutas y componentes cambiados y organizados con precisión:

---

## 🚀 Instalación

### 1. Instalar el Paquete

Instala el paquete desde npm o usando un enlace local:

```bash
npm install innoboxrr-vue-affiliate
```

> También puedes usar `npm link` si estás trabajando en desarrollo local del paquete.

---

### 2. Registrar el Paquete en tu Bootstrap de Vue

Agrega el paquete `AffiliateApp` a tu aplicación principal:

```javascript
import { createApp } from 'vue';
import AffiliateApp from 'innoboxrr-vue-affiliate';

const app = createApp(App);
app.use(AffiliateApp);
```

---

### 3. Traducciones Personalizadas (Opcional)

Puedes sobrescribir los textos por defecto en distintos idiomas con tu propio archivo de traducciones:

```javascript
import AffiliatePackage from 'innoboxrr-vue-affiliate';

const customLocales = {
    es: {
        'Affiliate Program': 'Programa de Afiliados',
        'Create Affiliate': 'Crear Afiliado',
        // ...otros textos
    },
};

app.use(AffiliatePackage, {
    translateOptions: {
        defaultLang: 'es',
        locales: customLocales,
    }
});
```

---

### 4. Crear la Vista Principal

Genera una vista específica para la sección de afiliados:

**Archivo: `AffiliateView.vue`**

```vue
<template>
    <AffiliateApp />
</template>

<script>
export default {
    name: 'AffiliateView',
};
</script>
```

---

### 5. Registrar las Rutas

Incluye las rutas del paquete como hijos de tu ruta principal `/affiliate`:

**Archivo: `routes/index.js`**

```javascript
import affiliateRoutes from 'innoboxrr-vue-affiliate/routes';

export default [
    {
        path: '/affiliate',
        name: 'AdminAffiliate',
        component: () => import('./../views/AffiliateView.vue'),
        meta: {
            title: 'Afiliados',
        },
        children: [
            ...affiliateRoutes,
        ],
    },
];
```

---

### 6. Configurar Aliases en `vite.config.js`

Agrega alias personalizados para facilitar las importaciones desde el paquete:

```javascript
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@affiliate': path.resolve(__dirname, 'node_modules/innoboxrr-vue-affiliate/'),
            '@affiliateComponents': path.resolve(__dirname, 'node_modules/innoboxrr-vue-affiliate/src/components'),
            '@affiliateModels': path.resolve(__dirname, 'node_modules/innoboxrr-vue-affiliate/src/models'),
            '@affiliatePages': path.resolve(__dirname, 'node_modules/innoboxrr-vue-affiliate/src/pages'),
            '@affiliateStore': path.resolve(__dirname, 'node_modules/innoboxrr-vue-affiliate/src/store'),
        },
    },
});
```

---

### 7. Configurar `tailwind.config.js`

Asegúrate de que Tailwind procese también los archivos del paquete:

```javascript
const { addDynamicIconSelectors } = require('@iconify/tailwind');
const colors = require('tailwindcss/colors');
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './node_modules/innoboxrr-vue-affiliate/**/*.vue',
        './node_modules/innoboxrr-vue-affiliate/**/*.js',
        './node_modules/innoboxrr-vue-affiliate/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {},
    },
    plugins: [],
};
```

---

## Roadmap

* [x] Relaciones completas entre modelos
* [x] Métricas de actividad
* [x] Sistema de payout
* [ ] Dashboard interactivo
* [ ] Integración con Stripe/PayPal
* [ ] Interfaz frontend en Vue

---

## Contribución

Sigue los pasos de instalación local para desarrollo. Las PRs y sugerencias son bienvenidas.

---

## Licencia

`innoboxrr-affiliate-saas` está licenciado bajo MIT License.

---
