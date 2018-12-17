<?php
/**
 * Created by PhpStorm.
 * User: YukaSan
 * Date: 17.12.2018
 * Time: 20:12
 */

namespace Application\Controllers;

use Application\Services\UserServise;

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

        $userLogin = $this->request->GetPostValue('userLogin');
        echo $userLogin;
        $userEmail= $this->request->GetPostValue('userEmail');
        $usrPassword = $this->request->GetPostValue('userPassword');

        $userService = new UserServise();

        $result = $userService->addUser($userLogin,$usrPassword,$userEmail);

        $this->json(array(
            'addUser'=> $result
        ));
     }//addUser

    public function getUsers ($limit, $offset){
        $userService = new UserServise();

        $users = $userService->getUsers($limit, $offset);

        $template = $this->twig->load('User/users.twig');

        echo $template->render( array(
            'users' => $users
        ) );
    }//getUsers

    public function getSingleUser($identifier){
        $userService = new UserServise();
        $user = $userService->getSingleUser($identifier);

        $template = $this->twig->load('User/singleUser.twig');

        echo $template->render( array(
            'user' => $user
        ) );

    }
}//UserServise