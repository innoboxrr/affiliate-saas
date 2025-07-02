# Affiliate SaaS

# Requisitos para compilar el script

Este paquete requiere tener `javascript-obfuscator` disponible en el entorno. Instálalo en el proyecto principal así:

```bash
npm install javascript-obfuscator --save-dev
```

# Debes Añadir la URL de Tracking para evitar CORS

Añade la URL de tracking a la lista de URLs middleware de Laravel.
En `config/cors.php`, añade la URL de tracking a la lista de URLs permitidas:

```php
'paths' => ['api/*', 'affiliate/*'],
```

# Excentar de la verificación CSRF
Para evitar la verificación CSRF en las rutas de afiliados, añade las siguientes rutas al middleware `VerifyCsrfToken` en `app/Http/Middleware/VerifyCsrfToken.php`:

```php
protected $except = [
    'affiliate/*',
];
```

Test change minor