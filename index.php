<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once __DIR__ . '/coreapp/autoload.php';

use coreapp\Application;
use coreapp\Controller;
use coreapp\Router;

$router = new Router();
$router->get('/index.php', array(Controller::class, 'index'));
$router->get('/', array(Controller::class, 'index'));

session_start(array(
    'name' => 'checkip'
));

$application = new Application($router);
$application->run();
