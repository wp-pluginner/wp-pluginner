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
  function wp_pluginner()
  {
    return WpPluginner\Framework\Loader::getInstance('WpPluginner');
  }
}
