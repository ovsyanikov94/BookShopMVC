<?php
/**
 * Created by PhpStorm.
 * User: teacher
 * Date: 10.01.2019
 * Time: 10:54
 */

return array(

    'get' => [
        '/home' => 'HomeController@indexAction',
        '/authorize' => 'AuthorizeController@authorizeAction',
        '/registration'=>'UserController@registration',
    ],
    'post' => [
        '/addUser'=>'UserController@addUser',
        '/login' => 'AuthorizeController@LoginAction',
    ],
    'put' => [

    ],
    'delete' => [

    ]

);