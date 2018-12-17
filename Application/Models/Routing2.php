<?php


return array(
    'get' => [
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
        '/users'=>'UserController@getUsers',
        '/user/([a-zА-Я0-9]{1,})'=>'UserController@getSingleUser',
        '/registration'=>'UserController@registration'
    ],
    'post' => [
        '/book' => 'BookController@createBookAction',
        '/author' => 'AuthorController@addAuthorAction',
        '/addUser'=>'UserController@addUser'
    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
    ]
);

