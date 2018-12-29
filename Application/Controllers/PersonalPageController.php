<?php
/**
 * Created by PhpStorm.
 * User: dreamcast
 * Date: 29.12.2018
 * Time: 2:01
 */

namespace Application\Controllers;


class PersonalPageController extends BaseController {

    //загрузка странички личного кабинета
    public function personalPageAction(){

        $template = $this->twig->load('PersonalPage/personal-page.twig');

        try{

            if( isset($_COOKIE["cookie_user"]) ){

                $CookieUser = unserialize($_COOKIE["cookie_user"]);
                echo $template->render( array( 'user' => $CookieUser ) );

            }//if
            else{

                echo $template->render( array( 'user' => $_SESSION["session_user"] ) );

            }//else

        }//try
        catch (\Exception $ex){

            echo "<pre>";
            print_r($ex);
            echo "<pre>";

            include '../Application/Views/Errors/InternalError.php';

        }//catch

    }//personalPageAction



}//PersonalPageController