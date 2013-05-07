<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Siro\Application(array('environment' => 'prod'));
$app['http_cache']->run();