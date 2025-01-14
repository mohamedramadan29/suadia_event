<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Toastify CDN links
    |--------------------------------------------------------------------------
    |
    | Here you may specify the CDN links for the toastify library.
    |
    */

    'cdn' => [
        'js' => 'https://unpkg.com/toastify-js@1.12.0/src/toastify.js',
        'css' => 'https://unpkg.com/toastify-js@1.12.0/src/toastify.css',
    ],

    /*
    |--------------------------------------------------------------------------
    | Toastify Toastifiers Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the toastifiers options for the toastify library.
    | Each toastifier will be available as a method in the Toastify facade.
    |
    */

    'toastifiers' => [
        'toast' => [
            'style' => [
                'color' => '#fff',
                'background' => '#182433',
                'z-index'=>'999999'
            ],
        ],
        'error' => [
            'style' => [
                'color' => '#fff',
                'background' => '#d63939',
            ],
        ],
        'success' => [
            'style' => [
                'color' => '#fff',
                'background' => '#2fb344',
                'z-index'=>'999999'
            ],
        ],
        'info' => [
            'style' => [
                'color' => '#fff',
                'background' => '#4299e1',
            ],
        ],
        'warning' => [
            'style' => [
                'color' => '#fff',
                'background' => '#f76707',
            ],
        ],
    ],

    'defaults' => [
        'gravity' => 'toastify-top',
        'position' => 'left',
    ],
];
