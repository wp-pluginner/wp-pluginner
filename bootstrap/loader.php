<?php
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new plugin instance which serves
| as the "glue" for all the components, and is the IoC container for
| the system binding all of the various parts.
|
*/
$loader = new WpPluginium\Framework\Loader(
    realpath(__DIR__.'/../plugin.php')
);

/*
|--------------------------------------------------------------------------
| Return The Container Loader
|--------------------------------------------------------------------------
|
| This script returns the plugin loader instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the plugin and sending responses.
|
*/
return $loader;
