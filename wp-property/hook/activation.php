<?php

/*
|--------------------------------------------------------------------------
| Plugin activation
|--------------------------------------------------------------------------
|
| This file is included when the plugin is activated the first time.
| Usually you will use this file to register your custom post types or
| to perform some db delta process.
|
*/
use Illuminate\Database\Schema\Blueprint;

global $wpdb;

if (!version_compare(mb_substr($wpdb->get_results( 'SELECT version() as version')[0]->version, 0, 6), '5.7.7') >= 0) {
    //Set Schema String Length
    $this->plugin->schema()->defaultStringLength(191);
}

//Add Session Table if Configured
if (!$this->plugin->schema()->hasTable('wp_pluginner_example')) {
    $this->plugin->schema()->create('wp_pluginner_example', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('key');
        $table->string('value')->nullable();
    });
}
