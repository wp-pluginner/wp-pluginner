<?php


/*
|--------------------------------------------------------------------------
| Register Sample Ajax Handle
|--------------------------------------------------------------------------
|
| @var \WpPluginium\Framework\Loader $this
|
*/

$this->plugin->ajax()->addAjax([
    'action' => 'wp_pluginner',
    'controller' => 'WpPluginner\Http\Controller\Ajax\SampleController@execute'
]);
