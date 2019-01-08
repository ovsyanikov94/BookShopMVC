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

                $User = unserialize($_COOKIE["cookie_user"]);

            }//if
            else{

                $User = unserialize($_SESSION["session_user"]);

            }//else

            echo $template->render( array( 'user' => $User ) );

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

            if( isset($_COOKIE["cookie_user"])){
                $CookieUser = unserialize($_COOKIE["cookie_user"]);
            }//if
            else if ( isset($_SESSION['session_user']) ){
              $CookieUser = unserialize($_SESSION['session_user']);
            }//else if
            else {
                $CookieUser = null;
            }//else

            if(!$CookieUser){

                return $this->json( 200 , array(
                    'code' => 401
                ) );

            }//if

            $userID = $CookieUser['userID'];
            $userLogin = $CookieUser['userLogin'];

            $result = $personalPageService->ChangeUserAvatar(
                [
                    'userID' => $userID ,
                    'userLogin' => $userLogin
                ]
            );

            if($result['status']){

                $this->json( 200 , array(
                    'code' => 200,
                    'path' => $result['path']
                ) );

            }//if
            else{
                $this->json( 500 , array(
                    'code' => 500,
                    'path' => null
                ) );
            }



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

    //страница смены пароля пользователя
    public function ChangePasswordAction(){

        $template = $this->twig->load('PersonalPage/change-password.twig');

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

    }//ChangePasswordAction

    //отправка новых данных для изменения пароля
    public function ChangePassword(){

        if( isset($_COOKIE["cookie_user"]) ){

            $user = unserialize($_COOKIE["cookie_user"]);

        }//if
        else if( isset($_SESSION["session_user"]) ) {

            $user = unserialize($_SESSION["session_user"]);

        }//else if
        else{
            $user = null;
        }//else

        if( !$user ){


            $this->json( 401 ,
                array(
                    'code' => 401
                ) );

        }//if

        $userID = $user['userID'];

        $oldPassword = $this->request->GetPutValue('oldPassword');
        $newPassword = $this->request->GetPutValue('newPassword');
        $confirmNewPassword = $this->request->GetPutValue('confirmNewPassword');

        $personalPageService = new PersonalPageService();

        try{

            $result = $personalPageService->UpdateUserPassword( [

                    'userID' => $userID,
                    'oldPassword' => $oldPassword,
                    'newPassword' => $newPassword,
                    'confirmNewPassword' => $confirmNewPassword

                ]);

            $this->json( $result['code'],
                array(
                    'code' => $result['code']
                ) );

        }//try
        catch(\Exception $ex){

            $this->json( 500 , array(
                'code' => 500,
                'avatarException' => $ex
            ) );

        }//catch

    }//ChangePassword

}//PersonalPageController