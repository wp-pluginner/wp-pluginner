<?php

 /*
 |--------------------------------------------------------------------------
 | Custom URL for Frontend User
 |--------------------------------------------------------------------------
 |
 | @var \Illuminate\Routing\Router $route
 |
 */

 
$route->get('/about', 'WpPluginner\Http\Controllers\FrontendController@about')->name('directory');
