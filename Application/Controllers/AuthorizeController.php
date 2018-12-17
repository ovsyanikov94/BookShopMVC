<?php


namespace Application\Controllers;


class AuthorizeController extends BaseController {

    public function authorizeAction(){

        try{

            $template = $this->twig->load('Authorize/authorize.twig');
            echo $template->render();

        }//try
        catch (\Exception $ex) {

            echo "<pre>";
            print_r($ex);
            echo "<pre>";

            include '../Application/Views/Errors/InternalError.php';

        }//catch

    }//authorizeAction

}//AuthorizeController