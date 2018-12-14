<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:08
 */

namespace Application\Controllers;
use Bramus\Router\Router;

class ApplicationController extends BaseController {

    public function Start(  ){

        $router = new Router();

        $router->setNamespace('Application\\Controllers');
        $router->get('/movies/(\w+)/(\d+)' , "HomeController@indexAction" );

        $router->run();

    }//Start

}//Application