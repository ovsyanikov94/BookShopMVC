<?php


return array(
    'get' => [
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
        '/books' => 'BookController@bookListAction',
        '/new-book' => 'BookController@newBookAction'
    ],
    'post' => [
        '/add-book' => 'BookController@addBookAction',
        '/author' => 'AuthorController@addAuthorAction',
    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
    ]
);

