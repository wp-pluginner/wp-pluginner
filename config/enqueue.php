<?php

return [
    'admin_enqueue_styles' => [
        [
            'handle' => 'wp_pluginner-css',
            'src' => '/css/app.css'
        ]
    ],
    'admin_enqueue_scripts' => [
        [
            'handle' => 'wp_pluginner-js',
            'src' => '/js/app.js',
            'deps' => ['jquery'],
            'in_footer' => true
        ]
    ],
    'ngetest' => [
        'bodo' => [
            'amat' => [
                'emang' => [
                    'gue' => 'pikirin'
                ]
            ]
        ]
    ]
];
