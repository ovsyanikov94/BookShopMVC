<?php


namespace Application\Services;


use Application\Utils\MySQL;

class AuthorizeService{

    public function LogIn( $login, $password ){

        $stm = MySQL::$db->prepare("SELECT * FROM users WHERE userLogin = :login or userEmail = :login and userPassword = :password");
        $stm->bindParam(':login', $login, \PDO::PARAM_STR);
        $stm->bindParam(':password', $password, \PDO::PARAM_STR);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);

    }//LogIn

}//AuthorizeService