<?php
/**
 * Created by PhpStorm.
 * User: dreamcast
 * Date: 29.12.2018
 * Time: 2:01
 */

namespace Application\Controllers;


use Application\Services\PersonalPageService;

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

    //смена аватара(фотографии) пользователя
    public function ChangeUserAvatar(){

        $personalPageService = new PersonalPageService();

        try{

            $CookieUser = unserialize($_COOKIE["cookie_user"]);

            $userID = $CookieUser['userID'];
            $userLogin = $CookieUser['userLogin'];

            $result = $personalPageService->ChangeUserAvatar(['userID' => $userID , 'userLogin' => $userLogin]);

            $this->json( 200 , array(
                'code' => 200,
                'avatarResult' => $result
            ) );

        }//try
        catch(\Exception $ex){

            $this->json( 500 , array(
                'code' => 500,
                'avatarException' => $ex
            ) );

        }//catch

    }//ChangeUserAvatar

    //страница изменения личной информации пользователя
    public function EditPersonalDataAction(){

        $template = $this->twig->load('PersonalPage/edit-personal-data.twig');

        try{

            if( isset($_COOKIE["cookie_user"]) ){

                $CookieUser = unserialize($_COOKIE["cookie_user"]);
                echo $template->render( array( 'user' => $CookieUser ) );

            }//if
            else{

                echo $template->render( array( 'user' => $_SESSION["session_user"] ) );

            }//else

        }//try
        catch(\Exception $ex){

            echo "<pre>";
            print_r($ex);
            echo "<pre>";

            include '../Application/Views/Errors/InternalError.php';

        }//catch

    }//EditPersonalDataAction

    //сохранение новой личной информации пользователя
    public function SaveNewPersonalData(){

        $CookieUser = unserialize($_COOKIE["cookie_user"]);

        $userID = $CookieUser['userID'];
        $userLogin = $this->request->GetPutValue('newLogin');
        $userEmail= $this->request->GetPutValue('newEmail');

        $personalPageService = new PersonalPageService();

        try{

           $result = $personalPageService->UpdateUserPersonalData( ['userID' => $userID , 'userLogin' => $userLogin , 'userEmail' => $userEmail ]);

            $this->json( $result['code'],
                array(
                'result' => $result['code']
            ) );

        }//try
        catch(\Exception $ex){

            $this->json( 500 , array(
                'code' => 500,
                'avatarException' => $ex
            ) );

        }//catch

    }//SaveNewPersonalData

}//PersonalPageController