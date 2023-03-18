<?php
define ('SITE_ROOT', realpath(dirname(__FILE__))); //Defines this file's directory as being the root directory
ini_set('session.save_path', __DIR__ . '/../session');
ini_set('allow_url_fopen', true); //Allows images to be saved from URL to file
require __DIR__ . '/../patternrouter.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();
$router->route($uri);
?>