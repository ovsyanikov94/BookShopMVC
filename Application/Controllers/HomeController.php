<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:09
 */

namespace Application\Controllers;
//use Pug\Pug;

class HomeController extends BaseController{

    public function indexAction ( ){

        try {

            $template = $this->twig->load('Home/index.twig');
            echo $template->render( );

//
//            $pug = new Pug();
//            $output = $pug->renderFile('../Application/Views/Home/index.pug');

//            $output = $pug->render(
//                '../Application/Views/Home/index.pug',
//                $this->storage->getRawStorage()
//            );
//
//           echo $output;

        }//try
        catch (\Exception $ex) {

            echo "<pre>";
                print_r($ex);
            echo "<pre>";

            include '../Application/Views/Errors/InternalError.php';

        }//catch

    }//indexAction

}//HomeController