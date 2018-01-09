<?php

return [

    'development' => true,


    /*
    |--------------------------------------------------------------------------
    | Slug & Namespace
    |--------------------------------------------------------------------------
    |
    | @slug : Use unique string for plugin identifier (no space, no special chars)
    | @namespace  : Your plugin namespace to access instance
    */

    'slug' => 'wp-pluginner',
    'namespace' => 'WpPluginner',

    /*
    |--------------------------------------------------------------------------
    | Illuminate Container
    |--------------------------------------------------------------------------
    |
    | @slug : Use unique string for plugin identifier (no space, no special chars)
    | @namespace  : Your plugin namespace to access instance
    */

    'session_enabled' => false,
    'cache_enabled' => true,
    'route_enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | init to your plugin. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [
        '\WpPluginner\Ajax\Import'
    ],

];
