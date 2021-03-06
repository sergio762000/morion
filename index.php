<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once __DIR__ . '/coreapp/autoload.php';

use coreapp\Application;
use coreapp\Router;

$router = new Router();
$router->get('/index.php', array('coreapp\Controller', 'index'));
$router->get('/', array('coreapp\Controller', 'index'));

$application = new Application($router);
$application->run();
