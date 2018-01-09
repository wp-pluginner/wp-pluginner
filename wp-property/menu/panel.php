<?php
/**
 * @var \WpPluginner\Framework\Loader $this
 **/

$this->plugin->admin()->addMenu([
    'page_title' => 'WP Pluginner',
    'menu_title' => 'WP Pluginner',
    'capability' => 'manage_options',
    'menu_slug' => 'thewppluginner',
    'icon_url' => 'dashicons-tickets'
]);

$this->plugin->admin()->addSubMenu([
    'parent_slug' => 'thewppluginner',
    'page_title' => 'WP Pluginner Sub 1',
    'menu_title' => 'Sub 1',
    'capability' => 'manage_options',
    'menu_slug' => 'thewppluginner',
    'controller' => 'WpPluginner\Http\Controllers\Admin\DashboardController@index'
]);
$this->plugin->admin()->addSubMenu([
    'parent_slug' => 'thewppluginner',
    'page_title' => 'WP Pluginner Sub 2',
    'menu_title' => 'Sub 2',
    'capability' => 'manage_options',
    'menu_slug' => 'thewppluginner_2',
    'controller' => 'WpPluginner\Http\Controllers\Admin\DashboardController@index'
]);
