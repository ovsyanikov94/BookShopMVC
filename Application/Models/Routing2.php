<?php


return array(

    'get' => [
        '/authorize' => 'AuthorizeController@authorizeAction',
        '/home' => 'HomeController@indexAction',
        '/' => 'HomeController@indexAction',
        '/authors' => 'AuthorController@authorListAction',
        '/author/(\d+)' => 'AuthorController@getAuthorAction',
        '/users'=>'UserController@getUsers',
        '/user/(\w+)'=>'UserController@getSingleUser',
        '/registration'=>'UserController@registration',
        '/genres' => 'GenresController@getGenresAction',
        '/genre_books/(\d+)' => 'GenresController@getGenreBooksAmountAction',
        '/genre/(\d+)' => 'GenresController@getGenreAction',
        '/books' => 'BookController@bookListAction',
        '/new-book' => 'BookController@newBookAction',
        '/info-book/(\d+)' => 'BookController@infoBookAction',
        '/verification'=>'UserController@verificationUser',
        '/comments/(\d+)' => 'CommentsController@commentListAction',
        '/comments-mod/(\d+)' => 'CommentsController@commentModerationListAction',
        '/more-comments/(\d+)' => 'CommentsController@commentMoreAction',
        '/get-books' => 'BookController@getMoreBooks',
        '/edit-books/(\d+)' => 'BookController@editBookAction',
        '/verification'=>'UserController@verificationUser'
        '/comments/new/(\d+)' => 'CommentsController@addCommentPageAction',
    ],
    'post' => [
        '/login' => 'AuthorizeController@LoginAction',
        '/new-book' => 'BookController@addBookAction',
        '/author' => 'AuthorController@addAuthorAction',
        '/add_genre' => 'GenresController@addGenreAction',
        '/genre' => 'GenresController@updateGenreAction',
        '/add_genre' => 'GenresController@addPostGenreAction',
        '/addUser'=>'UserController@addUser',
        '/edit-book/(\d+)' => 'BookController@acceptEditBookAction',
        '/add_comment' => 'CommentsController@addCommentAction',
    ],
    'delete' => [
        '/author/(\d+)' => 'AuthorController@deleteAuthorAction',
        '/delete-book/(\d+)' => "BookController@deleteBookAction",
        '/genre/(\d+)' => 'GenresController@deleteGenreAction',
        '/comment/(\d+)' => 'CommentsController@deleteCommentAction',
    ],
    'put' => [
        '/author/(\d+)' => 'AuthorController@updateAuthorAction',
        '/comment' => 'CommentsController@updateCommentAction',
        '/comment-status' => 'CommentsController@updateCommentStatusAction',
    ]

);

