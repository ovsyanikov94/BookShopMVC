<?php


return array(
    'get' => [
        '/authorize' => 'AuthorizeController@authorizeAction',
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
    ],
    'post' => [
        '/book' => 'BookController@createBookAction',
        '/author' => 'AuthorController@addAuthorAction',
        '/login' => 'AuthorizeController@LoginAction'
    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
    ]
);

