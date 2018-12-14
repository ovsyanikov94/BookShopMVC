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

abstract class BaseController{

    protected $request;
    protected $storage;

    public function __construct(){

        $this->request = new Request();
        $this->storage = new Storage();

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



}//BaseController