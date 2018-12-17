<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:08
 */

/*
 * Books
 *      id
 *      ISBN
 *      Title
 *      Pages
 *      Price
 *
 * Genres
 *      id
 *      Title
 *
 * Authors
 *      id
 *      FirstName
 *      LastName
 *
 * BookAuthors
 *      id
 *      authorId
 *      bookId
 *
 * BookGenres
 *      id
 *      bookId
 *      genreId
 *
 * Users
 *      id
 *      login
 *      email
 *      password
 *
 * Orders
 *      id
 *      userId
 *      orderDate
 *
 * OrderDetails
 *      id
 *      orderId
 *      bookId
 *      bookPrice
 *      amount
 */


namespace Application\Controllers;
use Bramus\Router\Router;
use Application\Utils\MySQL;


//use Application\Models\Path;
//use Application\Models\Routing;

class ApplicationController extends BaseController {

    public function Start(  ){

        MySQL::$db = new \PDO(
            "mysql:dbname=booksdb;host=127.0.0.1;charset=utf8",
            "books-admin",
            "123456"
        );

        $router = new Router();

        $routes = include_once '../Application/Models/Routing2.php';

        $router->setNamespace('Application\\Controllers');

        foreach ($routes as $key => $path ){

            foreach ($path as $subKey => $value){
                $router->$key( $subKey , $value );
            }//foreach

        }//foreach

//        $router->get(
//            Routing::$HomeUrl->path ,              //
//            Routing::$HomeUrl->GetControllerPath() // HomeController@indexAction
//        );
//
//        $router->get(
//            Routing::$BooksListUrl->path ,
//            Routing::$BooksListUrl->GetControllerPath()
//        );
        $router->run();

    }//Start

}//Application