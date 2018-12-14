<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:08
 */

namespace Application\Controllers;

use Pug\Pug;

class ApplicationController extends BaseController {

    public function Start(  ){

        $ctrl = $this->request->GetGetValue('ctrl');
        $act = $this->request->GetGetValue('act');

        $controllerString = "Application\\Controllers\\{$ctrl}Controller";

        $controllerInstance = new $controllerString();

        $actionString = "{$act}Action";

        $viewPath = $controllerInstance->$actionString();

        $this->storage = $controllerInstance->getStorage();

        try{

            $pug = new Pug();
            $output = $pug->render($viewPath , $this->storage->getRawStorage() );

            echo $output;

        }//try
        catch( \Exception $ex ){

            include '../Views/Errors/InternalError.php';

        }//catch



    }//Start

}//Application