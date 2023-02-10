<?php
ini_set('session.save_path', __DIR__ . '/../session');
require __DIR__ . '/../patternrouter.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();
$router->route($uri);
?>