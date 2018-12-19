<?php


return array(
    'get' => [
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
        '/genres' => 'GenresController@getGenresAction',
        '/genre_books/(\d+)' => 'GenresController@getGenreBooksAmountAction',
        '/genre/(\d+)' => 'GenresController@getGenreAction',
    ],
    'post' => [
        '/book' => 'BookController@createBookAction',
        '/author' => 'AuthorController@addAuthorAction',
        '/add_genre' => 'GenresController@addGenreAction',
        '/genre' => 'GenresController@updateGenreAction',
    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
        '/genre/(\d+)' => 'GenresController@deleteGenreAction',
    ],
    'put' => [
        '/author/(\d+)' => 'AuthorController@updateAuthorAction',
    ]

);

