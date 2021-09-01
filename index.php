<?php
session_start();

// Les constants 
define('ROOT', __DIR__);
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") ."://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));


// Import autoload
require './vendor/autoload.php';

// Import ToolBox
require './core/Toolbox.php';

// Gestionnaire d'erreurs
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// Routeur
$router = new \Bramus\Router\Router();
$router->setNamespace('\App\Controllers');

$router->get('/', 'MainController@index');

$router->get('/articles', 'ArticlesController@index');
$router->get('/articles/(\d+)', 'ArticlesController@show');
$router->get('/articles/new', 'ArticlesController@new');
$router->post('/articles/new', 'ArticlesController@newPost');
$router->get('/articles/edit/(\d+)', 'ArticlesController@edit');
$router->post('/articles/edit/(\d+)', 'ArticlesController@editPost');
$router->get('/articles/delete/(\d+)', 'ArticlesController@delete');

$router->get('/login', 'UsersController@login');
$router->post('/auth-login', 'UsersController@loginPost');
$router->get('/register', 'UsersController@register');
$router->post('/auth-register', 'UsersController@registerPost');
$router->get('/logout', 'UsersController@logout');
$router->get('/profile', 'UsersController@profil');


$router->get('/date', 'MainController@date'); // Route test date

$router->set404('MainController@notFound');

$router->run();

