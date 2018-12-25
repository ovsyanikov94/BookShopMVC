<?php

namespace Application\Services;

use Application\Utils\MySQL;
use Bcrypt\Bcrypt;

class AuthorizeService{

    public function LogIn( $login, $password, $rememberMe){

        $bcrypt = new Bcrypt();

        //ищем пользователя
        $stm = MySQL::$db->prepare( "SELECT * FROM users WHERE userLogin = :login OR userEmail = :login" );
        $stm->bindParam(':login', $login, \PDO::PARAM_STR);
        $stm->execute();

        //возвращаем объект из базы данных
        $result = $stm->fetch(\PDO::FETCH_OBJ);

        //есди пользователь не найден
        if(!$result){
            return $result;
        }//if

        //проверка на подтверждение своего email
        $isEmailVerified = $result->verification;

        if($isEmailVerified){

            $result = array(
                'code' => 405,
                'emailVerify' => $isEmailVerified
            );

            return $result;

        }//if

        //проверяем пароль пользователя
        $verifyPassword = $bcrypt->verify($password, $result->userPassword);

        //даём разрешение на авторизацию
        if($verifyPassword){

            //если "Запомнить меня" отмечена
            if($rememberMe){

                //начинаем сессию
                session_start();

                //записываем пользователя в сессию
                $_SESSION['session_user'] = $result;

            }//if

           return true;

        }//if

    }//LogIn

}//AuthorizeService