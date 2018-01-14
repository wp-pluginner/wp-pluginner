<?php

/*
|--------------------------------------------------------------------------
| Register Plugin Menu for Admin
|--------------------------------------------------------------------------
|
| @var \WpPluginium\Framework\Loader $this
|
*/

$this->plugin->admin()->addMenu([
    'page_title' => 'WP Pluginner',
    'menu_title' => 'WP Pluginner',
    'capability' => 'manage_options',
    'menu_slug' => 'wp_pluginner',
    'icon_url' => 'dashicons-tickets'
]);

$this->plugin->admin()->addSubMenu([
    'parent_slug' => 'wp_pluginner',
    'page_title' => 'WP Pluginner: Dashboard',
    'menu_title' => 'Dashboard',
    'capability' => 'manage_options',
    'menu_slug' => 'wp_pluginner',
    'controller' => 'WpPluginner\Http\Controller\Admin\SampleController@dashboard'
]);
$this->plugin->admin()->addSubMenu([
    'parent_slug' => 'wp_pluginner',
    'page_title' => 'WP Pluginner: Model View',
    'menu_title' => 'Model',
    'capability' => 'manage_options',
    'menu_slug' => 'wp_pluginner_model',
    'controller' => 'WpPluginner\Http\Controller\Admin\SampleController@model'
]);
$this->plugin->admin()->addSubMenu([
    'parent_slug' => 'wp_pluginner',
    'page_title' => 'WP Pluginner: Model (Vue JS) View',
    'menu_title' => 'Model (Vue JS)',
    'capability' => 'manage_options',
    'menu_slug' => 'wp_pluginner_model_vue',
    'controller' => 'WpPluginner\Http\Controller\Admin\SampleController@modelVue'
]);
