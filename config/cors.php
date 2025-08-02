<?php

return [

    'paths' => [
        'sanctum/csrf-cookie',
        'login',
        'logout',
        'me',
        'usuarios',
        'usuarios/*',
        'productos',
        'productos/*',
        'transaccion',
        'transacciones/dia',
        'caja/abrir',
        'caja/cerrar',
        'caja/actual',
        'roles',
        'roles/*',
        'permisos',
        'permisos/*',
        'reportes',
        'admin/dashboard',
    ],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:5173',
        'http://127.0.0.1:5173',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
