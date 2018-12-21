<?php
/**
 * Created by PhpStorm.
 * User: YukaSan
 * Date: 17.12.2018
 * Time: 20:12
 */

namespace Application\Controllers;

use Application\Services\UserService;
use Application\Controllers\patternConst;

class UserController extends BaseController{

    public function registration(){
        try{
            $template = $this->twig->load( 'User/registration.twig');
            echo $template->render( );
        }
        catch (\Exception $ex) {

            echo "<pre>";
            print_r($ex);
            echo "<pre>";

            include '../Application/Views/Errors/InternalError.php';

        }//catch

    }//registration

    public function addUser( ){

        $pattern = new patternConst();

        $userLogin = $this->request->GetPostValue('userLogin');

        if(!preg_match($pattern->LoginPattern,$userLogin)){
            $this->json(400,array(
                'res'=> 'неверный логин'
            ));
            return;
        }//if
        $userEmail= $this->request->GetPostValue('userEmail');
        if(!preg_match($pattern->EmailPattern,$userEmail)){
            $this->json(400,array(
                'res'=> 'неверный Email'
            ));
            return;
        }//if
        $usrPassword = $this->request->GetPostValue('userPassword');
        if(!preg_match($pattern->PasswordPattern,$usrPassword)){
            $this->json(400,array(
                'res'=> 'неверный пароль'
            ));
            return;
        }//if

        $userService = new UserService();

        $result = $userService->addUser($userLogin,$usrPassword,$userEmail);

        $this->json(200,array(
            'addUser'=> $result
        ));
     }//addUser

    public function getUsers (){

        $userService = new UserService();

        $users = $userService->getUsers();

        $template = $this->twig->load('User/users.twig');

        echo $template->render( array(
            'users' => $users
        ) );

    }//getUsers

    public function getSingleUser($identifier){

        $userService = new UserService();
        $user = $userService->getSingleUser($identifier);

        $template = $this->twig->load('User/singleUser.twig');

        echo $template->render( array(
            'user' => $user
        ) );

    }//getSingleUser

}//UserController