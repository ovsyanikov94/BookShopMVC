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

    public function Action404(  ){

        try {

            $template = $this->twig->load('ErrorPages/404-not-found.twig');
            echo $template->render( );

        }//try
        catch (\Exception $ex) {

        }//catch

    }

}//HomeController