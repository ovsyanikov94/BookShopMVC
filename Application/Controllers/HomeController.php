<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:09
 */

namespace Application\Controllers;
//use Pug\Pug;

use Application\Services\UserService;

class HomeController extends BaseController{

    public function indexAction(  ){

        $userService = new UserService();
        $user = $userService->getCurrentUser();

        $template = $this->twig->load('public/home.twig');
        echo $template->render( [
            'user' => $user
        ] );

    }//indexAction

    public function Action404(  ){

        try {

            $template = $this->twig->load('ErrorPages/404-not-found.twig');
            echo $template->render( );

        }//try
        catch (\Exception $ex) {

        }//catch

    }

}//HomeController