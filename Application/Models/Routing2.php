<?php


return array(
    'get' => [
        '/authorize' => 'AuthorizeController@authorizeAction',
        '/login' => 'AuthorizeController@LoginAction',
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
        '/books' => 'BookController@bookListAction',
        '/new-book' => 'BookController@newBookAction',
        '/genres' => 'GenresController@getGenresAction',
        '/genre_books/(\d+)' => 'GenresController@getGenreBooksAmountAction',
        '/genre/(\d+)' => 'GenresController@getGenreAction',
        '/info-book/(\d+)' => 'BookController@infoBookAction'
    ],
    'post' => [
        '/new-book' => 'BookController@addBookAction',
        '/author' => 'AuthorController@addAuthorAction',
        '/add_genre' => 'GenresController@addGenreAction',
        '/genre' => 'GenresController@updateGenreAction',

    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
        '/delete-book/(\d+)' => "BookController@deleteBookAction",
        '/genre/(\d+)' => 'GenresController@deleteGenreAction',
    ],
    'put' => [
        '/author/(\d+)' => 'AuthorController@updateAuthorAction',
    ]

);

