<?php

header('Content-Type: text/html; charset=utf-8');

require_once "../vendor/autoload.php";
$config = require_once "../app/config/main.php";

$app = new \BSFramework\Application;
$app->setConfig($config);
$app->run();
