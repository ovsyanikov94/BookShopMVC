<?php
/**
 * Created by PhpStorm.
 * User: teacher
 * Date: 10.01.2019
 * Time: 10:54
 */

return array(

    'get' => [
        '/' => 'HomeController@indexAction',
        '/home' => 'HomeController@indexAction',
        '/cart' => 'CartController@cartAction',
        '/orders' => 'CartController@ordersAction',
        '/authorize' => 'AuthorizeController@authorizeAction',
        '/registration'=>'UserController@registration',
        '/person' => 'PersonController@getPersonAction',
        '/book/(\d+)' => 'BookController@getPublicBookAction',
        '/ordersUser' => 'OrdersController@UserDealInfoByIdAction',
        '/ordersByUser'=> 'OrdersController@UserDealInfoById'
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