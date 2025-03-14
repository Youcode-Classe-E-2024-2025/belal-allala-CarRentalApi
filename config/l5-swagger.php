<?php

return [
    'api' => [
        'title' => 'Car Rental API',
        'description' => 'API for managing car rentals',
        'version' => '1.0.0',
        'contact' => [
            'email' => 'support@carrental.com',
        ],
        'license' => [
            'name' => 'MIT',
            'url' => 'https://opensource.org/licenses/MIT',
        ],
    ],
    'routes' => [
        'api' => 'api/*',
        'docs' => 'api/documentation',
        'json' => 'api/documentation.json',
        'yaml' => 'api/documentation.yaml',
    ],
    'paths' => [
        'annotations' => app_path('Http/Controllers'),
        'base' => base_path(),
        'docs' => public_path('api/documentation'),
        'json' => 'api-docs.json',
        'yaml' => 'api-docs.yaml',
    ],
    'servers' => [
        [
            'url' => 'http://127.0.0.1:8000',
            'description' => 'Car Rental API Server',
        ],
    ],
];