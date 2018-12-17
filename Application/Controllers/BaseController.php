<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:10
 */

namespace Application\Controllers;

use Application\Utils\Request;
use Application\Utils\Storage;

use Twig_Loader_Filesystem;
use Twig_Environment;


abstract class BaseController{

    protected $request;
    protected $storage;

    protected $loader;
    protected $twig;

    public function __construct(){

        $this->request = new Request();
        $this->storage = new Storage();

        $this->loader = new Twig_Loader_Filesystem('../Application/Templates');
        $this->twig = new Twig_Environment($this->loader);

    }//__construct

    /**
     * @return mixed
     */
    protected function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param mixed $storage
     */
    protected  function setStorage($storage){
        $this->storage = $storage;
    }//setStorage

    protected function createUrl( $controller , $action ){

        return "?ctrl=$controller&act=$action";

    }

    protected function json( $data ){

        header('Content-type' , 'application/json');
        echo json_encode($data); //  res.send();
        exit();

    }//json

}//BaseController