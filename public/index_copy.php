<?php

// Les constants 
define('ROOT', dirname(__DIR__));
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
echo ROOT;
// Import autoload
require '../vendor/autoload.php';

// Gestionnaire d'erreurs
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// Routeur
$router = new \Bramus\Router\Router();
$router->setNamespace('\App\Controllers');

$router->get('/', 'MainController@index');
$router->get('/cars/(\d+)', 'ArticlesController@show');




$router->run();