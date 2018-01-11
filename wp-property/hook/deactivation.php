<?php

/*
|--------------------------------------------------------------------------
| Plugin deactivation
|--------------------------------------------------------------------------
|
| This file is included when the plugin is deactivated.
| Usually here you may enter a flush_rewrite_rules();
|
*/

//Remove sample table 'wp_pluginner_string' from database
$this->plugin->schema()->dropIfExists('wp_pluginner_example');

flush_rewrite_rules();
