<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Siro\Application(array('environment' => 'debug'));
$app['http_cache']->run();