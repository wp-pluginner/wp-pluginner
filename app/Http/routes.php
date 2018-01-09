<?php
/**
 * @var \Illuminate\Routing\Router $route
 * @var \Illuminate\Http\Response $response
 **/
$route->get('/about', 'WpPluginner\Http\Controllers\FrontendController@about')->name('directory');
