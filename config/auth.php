<?php

return [

    // ------------------------------------------------------------------
    // Authentication Defaults
    // ------------------------------------------------------------------

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'pengguna'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'pengguna'),
    ],

    // ------------------------------------------------------------------
    // Authentication Guards
    // ------------------------------------------------------------------

    'guards' => [
        'pengguna' => [
            'driver' => 'session',
            'provider' => 'pengguna',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],

        // ✅ tambahkan guard web untuk akses publik (form Post Donasi)
        'web' => [
            'driver' => 'session',
            'provider' => 'pengguna',
        ],
    ],

    // ------------------------------------------------------------------
    // User Providers
    // ------------------------------------------------------------------

    'providers' => [
        'pengguna' => [
            'driver' => 'eloquent',
            'model' => App\Models\pengguna::class,
        ],

        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\admin::class,
        ],
    ],

    // ------------------------------------------------------------------
    // Resetting Passwords
    // ------------------------------------------------------------------

    'passwords' => [
        'pengguna' => [
            'provider' => 'pengguna',
            'table' => 'password_reset_tokens_pengguna',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admin' => [
            'provider' => 'admin',
            'table' => 'password_reset_tokens_admin',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    // ------------------------------------------------------------------
    // Password Confirmation Timeout
    // ------------------------------------------------------------------

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
