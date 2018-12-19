<?php


return array(
    'get' => [
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
        '/users'=>'UserController@getUsers',
        '/user/([a-zА-Я0-9]{1,})'=>'UserController@getSingleUser',
        '/registration'=>'UserController@registration',
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
    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
        '/genre/(\d+)' => 'GenresController@deleteGenreAction',
    ],
    'put' => [
        '/author/(\d+)' => 'AuthorController@updateAuthorAction',
    ]
);

