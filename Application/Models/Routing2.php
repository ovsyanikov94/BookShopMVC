<?php


return array(
    'get' => [
        '/authorize' => 'AuthorizeController@authorizeAction',
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
        '/genres' => 'GenresController@getGenresAction',
        '/genre_books/(\d+)' => 'GenresController@getGenreBooksAmountAction',
        '/genre/(\d+)' => 'GenresController@getGenreAction',
        '/add_genre' => 'GenresController@addGetGenreAction',
    ],
    'post' => [
        '/book' => 'BookController@createBookAction',
        '/author' => 'AuthorController@addAuthorAction',
        '/genre' => 'GenresController@updateGenreAction',
        '/add_genre' => 'GenresController@addPostGenreAction',
        '/login' => 'AuthorizeController@LoginAction'
    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
        '/genre/(\d+)' => 'GenresController@deleteGenreAction',
    ],
    'put' => [
        '/author/(\d+)' => 'AuthorController@updateAuthorAction',
    ]

);

