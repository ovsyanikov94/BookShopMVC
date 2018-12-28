<?php
/**
 * Created by PhpStorm.
 * User: dreamcast
 * Date: 29.12.2018
 * Time: 2:01
 */

namespace Application\Controllers;


class PersonalPageController extends BaseController {

//загрузка личного кабинета
    public function personalPageAction(){

        try{

            $template = $this->twig->load('PersonalPage/personal-page.twig');
            echo $template->render();

        }//try
        catch (\Exception $ex){

            echo "<pre>";
            print_r($ex);
            echo "<pre>";

            include '../Application/Views/Errors/InternalError.php';

        }//catch

    }//personalPageAction

}//PersonalPageController