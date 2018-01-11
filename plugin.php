<?php

/**
 * Plugin Name: WpPluginner
 * Plugin URI: https://github.com/wp-pluginner/wp-pluginner
 * Description: Awesome Wordpress Plugin Framework for Laravel developers.
 * Version: 0.1.0
 * Author: Pijar Aji Pratama
 * Author URI: https://www.pijarajip.com
 * Text Domain: wp-pluginner
 * Domain Path: localization
 *
 */

define( 'WPPLUGINNER_TEXTDOMAIN', 'wp_pluginner' );

load_plugin_textdomain(WPPLUGINNER_TEXTDOMAIN, false, basename(dirname(__FILE__)) . '/localization');

wp_pluginner_start();


if (!function_exists('wp_pluginner')) {
  function wp_pluginner()
  {
    return Loader::getInstance('WpPluginner');
  }
}

//if (!function_exists('wp_pluginner_system_requirement')) {
	function wp_pluginner_system_requirement(){
		$result = array();
		if (!version_compare(PHP_VERSION,"5.6.4",">="))
			$result[] = __('PHP version 5.6.4 or greater required, Please update your PHP version', WPPLUGINNER_TEXTDOMAIN);

	    if (!extension_loaded('gd'))
			$result[] = __('GD PHP Library is required, Please install this PHP extension', WPPLUGINNER_TEXTDOMAIN);

	    if (!function_exists('curl_init')||!defined('CURLOPT_FOLLOWLOCATION'))
			$result[] = __('cURL PHP Extension is required, Please install this PHP extension', WPPLUGINNER_TEXTDOMAIN);

		return $result;
	}
//}

function wp_pluginner_start()
{
	$requirement = wp_pluginner_system_requirement();

	if (!empty($requirement)) {
		add_action(
            'admin_notices',
            function() use ($requirement)
            {
                $notice = '<div class="error">';
            	$notice .= '<h3>'. __('WpPluginner System Requirement!!!', WPPLUGINNER_TEXTDOMAIN) . '</h3>';
                $notice .='<ul>';
                foreach ($requirement as $error) {
            		$notice .= '<li>'.$error.'</li>';
            	}
                $notice .='</ul>';
            	$notice .='</div>';
            	echo $notice;
            }
        );
	} else {
        require_once __DIR__ . '/vendor/autoload.php';

        $loader = require_once __DIR__.'/bootstrap/loader.php';
        $loader->bootPlugin();
	}
}
