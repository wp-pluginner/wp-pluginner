<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/*
|--------------------------------------------------------------------------
| Global functions
|--------------------------------------------------------------------------
|
| Here you can insert your global function loaded by composer settings.
|
*/

if (!function_exists('wp_pluginner')) {
    /**
     * Get Plugin container instance.
     *
     * @return WpPluginium\Framework\Container
     */
    function wp_pluginner()
    {
        return WpPluginium\Framework\Loader::getInstance('WpPluginner');
    }
}
