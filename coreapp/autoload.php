<?php

require_once __DIR__ . '/AutoloadNamespace.php';

$autoloader = new \coreapp\AutoloadNamespace();
$autoloader->addNamespace('coreapp', __DIR__);
$autoloader->addNamespace('app', __DIR__ . '/../app');

$autoloader->register();
