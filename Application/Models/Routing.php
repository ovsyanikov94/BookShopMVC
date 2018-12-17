<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 17.12.2018
 * Time: 9:19
 */

namespace Application\Models;

class Path{

    public $controller;
    public $path;
    public $action;

    public function __construct($path , $controller , $action){

        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;

    }//__construct

    public function GetControllerPath(  ){

        return "{$this->controller}@{$this->action}";

    }

}

class Routing{

    public static $HomeUrl;
    public static $BooksListUrl;

}

Routing::$HomeUrl = new Path(
    '/' ,
    'HomeController',
    'indexAction'
);

Routing::$BooksListUrl = new Path(
    '/books' ,
    'BookController',
    'indexAction'
);

Routing::$OrderDetailsListUrl = new Path(
    '/ordersdetails' ,
    'OrderDetailsController',
    'indexAction'
);