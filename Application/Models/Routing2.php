<?php


return array(
    'get' => [
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
        '/books' => 'BookController@bookListAction',
        '/new-book' => 'BookController@newBookAction',
        '/genres' => 'GenresController@getGenresAction',
        '/genre_books/(\d+)' => 'GenresController@getGenreBooksAmountAction',
        '/genre/(\d+)' => 'GenresController@getGenreAction',
        '/add_genre' => 'GenresController@addGetGenreAction',
    ],
    'post' => [
        '/add-book' => 'BookController@addBookAction',
        '/author' => 'AuthorController@addAuthorAction',
        '/genre' => 'GenresController@updateGenreAction',
        '/add_genre' => 'GenresController@addPostGenreAction',
    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
        '/genre/(\d+)' => 'GenresController@deleteGenreAction',
    ],
    'put' => [
        '/author/(\d+)' => 'AuthorController@updateAuthorAction',
    ]

);

