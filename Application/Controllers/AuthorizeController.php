<?php


namespace Application\Controllers;

use Application\Services\AuthorizeService;


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

    public function LoginAction(){

        $authorizeService = new AuthorizeService();

        $login = $_POST['login'];
        $password = $_POST['password'];

        echo $login, $password;

        $result = $authorizeService->LogIn($login, $password);

        $this->json( array(
            'authorID' => $result
        ) );

    }//LoginAction

}//AuthorizeController