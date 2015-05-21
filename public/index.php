<?php
$now = $_SERVER['REQUEST_TIME'];
$to = strtotime('28-07-2011');
if ($now > $to) {
    echo file_get_contents("index.html");
} else {
    require __DIR__ . '/../bootstrap/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/start.php';
    $app->run();
}