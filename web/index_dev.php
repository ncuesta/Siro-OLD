<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Siro\Application(array('debug' => true));
$app['http_cache']->run();
