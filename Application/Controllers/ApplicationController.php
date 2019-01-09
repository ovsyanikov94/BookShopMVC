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

        session_start([
            'cookie_lifetime' => 86400,
        ]);

        MySQL::$db = new \PDO(
            "mysql:dbname=booksdb;host=127.0.0.1;charset=utf8",
            "books-admin",
            "123456"
        );

        $router = new Router();

        $routes = include_once '../Application/Models/Routing2.php';

        $router->setNamespace('Application\\Controllers');

        $router->set404(function (  ){

            try {

                $template = $this->twig->load('ErrorPages/404-not-found.twig');
                echo $template->render( );

            }//try
            catch (\Exception $ex) {

            }//catch

        });

        foreach ($routes as $key => $path ){

            foreach ($path as $subKey => $value){
                $router->$key( $subKey , $value );
            }//foreach

        }//foreach

        $router->run();

    }//Start

    //Выход из учётной записи пользователя
    public function LogoutAction(){

        //чистим сессию
        if(isset($_SESSION['session_user'])){

            $_SESSION = array();

        }//if

        //чистим cookie
        if( isset( $_COOKIE['cookie_user']) ){

            unset($_COOKIE['cookie_user']);
            setcookie("cookie_user", "", 1);

        }//if

        $this->json(200, array());

    }//LogoutAction

}//Application