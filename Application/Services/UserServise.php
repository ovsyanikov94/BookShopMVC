<?php
/**
 * Created by PhpStorm.
 * User: YukaSan
 * Date: 17.12.2018
 * Time: 20:12
 */

namespace Application\Services;

use Application\Utils\MySQL;
use Bcrypt\Bcrypt;

class UserServise
{
    public function addUser($login, $password, $email){

        $isUser = MySQL::$db->prepare("SELECT * FROM users WHERE userLogin = :userLogin OR userEmail=:userEmail");
        $isUser->bindParam(':userLogin', $login,\PDO::PARAM_STR);
        $isUser->bindParam(':userEmail', $email,\PDO::PARAM_STR);
        $isUser->execute();

        $result = $isUser->fetchAll(\PDO::FETCH_OBJ);
        if($result == null){
            $bcrypt = new Bcrypt();
            $bcrypt_version = '2y';
            $heshPassword = $bcrypt->encrypt($password,$bcrypt_version);

            $stm = MySQL::$db->prepare("INSERT INTO users VALUES( DEFAULT, :login,:password,:email) ");
            $stm->bindParam(':login' , $login , \PDO::PARAM_STR);
            $stm->bindParam(':email' , $email , \PDO::PARAM_STR);
            $stm->bindParam(':password' , $heshPassword , \PDO::PARAM_STR);
            $stm->execute();

            return  MySQL::$db->lastInsertId();
        }//if

        return null;
//        // Проверка открытого текста и зашифрованного текста
//        if ( $ bcrypt -> verify ( $ не зашифрованый пароль  , $ пароль из бд  )) {
//            print_r ( " \ n Пароль подтвержден! " ); }
//        else { print_r ( " \ n Пароль не совпадает! " ); }


    }//addUser

    public function getUsers($limit = 10, $offset = 0){

        $stm = MySQL::$db->prepare("SELECT * FROM users LIMIT :offset, :limit ");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//getUsers

    public function getSingleUser($identifier){

        $stm = MySQL::$db->prepare("SELECT * FROM users WHERE userLogin = :userLogin OR userID=:userID ");

        $type = gettype($identifier);
        if($type == "string"){
            $stm->bindParam(':userLogin', $identifier,\PDO::PARAM_STR);
            $stm->bindParam(':userID', -1,\PDO::PARAM_STR);
        }//if
        if($type == "integer"){

            $stm->bindParam(':userLogin',(string)$identifier,\PDO::PARAM_STR);
            $stm->bindParam(':userID', $identifier,\PDO::PARAM_STR);
        }//id

        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//getSingleUser

}//UserServise