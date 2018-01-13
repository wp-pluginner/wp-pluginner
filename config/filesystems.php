<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the plugin.
    |
    */

    'default' => 'plugin',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local"
    |
    */

    'disks' => [

        'plugin' => [
            'driver' => 'local',
            'root' => realpath( __DIR__ . '/../storage/app' ),
        ],

        'wp-content' => [
            'driver' => 'local',
            'root' => WP_CONTENT_DIR,
            'url' => WP_CONTENT_URL,
            'visibility' => 'public',
        ],

    ],

];
