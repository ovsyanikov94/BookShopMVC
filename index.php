<?php

function CustomLoadClasses( $class ){

    if( file_exists("{$class}.php") ){

        $class = str_replace('\\','/' , $class);

        include_once "{$class}.php";

    }//if

}//CustomLoadClasses

spl_autoload_register('CustomLoadClasses');

use Classes\User;
use Classes\Config\Router;

$router = new Router();

$router->get('/');
