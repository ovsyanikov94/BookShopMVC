<?php
// PSR-4 - PHP Standart Recomendation

require_once 'vendor/autoload.php';

use Classes\User;
use Classes\Author;
use Classes\Config\Router;

$user = new User();
$user->ShowUser();

$author = new Author();


$router = new Router();
$router->get('/home');