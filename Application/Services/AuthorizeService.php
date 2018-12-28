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

        $userForSessionAndCookies = array(

            'userID' => $result->userID,
            'userLogin' => $result->userLogin,
            'userEmail' => $result->userEmail,

        );

        //есди пользователь не найден
        if(!$result){
            return array(
                'code' => 401
            );
        }//if

        //проверяем пароль пользователя
        $verifyPassword = $bcrypt->verify($password, $result->userPassword);

        //даём разрешение на авторизацию
        if($verifyPassword){

            //проверка на подтверждение своего email
            $isEmailVerified = $result->verification;

            //пользователь не подтвердил свой email
            if(!$isEmailVerified){

                $result = array(
                    'code' => 405,
                    'emailVerify' => $isEmailVerified
                );

                return $result;

            }//if

            //если "Запомнить меня" НЕ отмечена
            if(!$rememberMe){

                //начинаем сессию
                session_start();

                //записываем пользователя в сессию
                $_SESSION['session_user'] = $result;

            }//if
            else{

                //если "Запомнить меня" отмечена
//                $userSerializeResult = serialize(array(
//                    'userID' => $result->userID,
//                    'userLogin' => $result->userLogin
//                ));

                //если "Запомнить меня" отмечена
                $userSerializeResultForCookie = serialize($userForSessionAndCookies);

                //сетим данные пользователя в cookie
                setcookie(
                    'cookie_user' ,
                    $userSerializeResultForCookie ,
                    time()+60*60*24*30
                );

            }//else

           //авторизируем пользователя
           return array(
               'code' => 200
           );

        }//if
        else{

            //если парооли не совпадают
            return array(
                'code' => 401
            );

        }//else


    }//LogIn

}//AuthorizeService