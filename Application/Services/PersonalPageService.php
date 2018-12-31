<?php
/**
 * Created by PhpStorm.
 * User: dreamcast
 * Date: 29.12.2018
 * Time: 2:01
 */

namespace Application\Services;


use Application\Controllers\BaseController;
use Application\Utils\MySQL;

class PersonalPageService  {

    //сохранение аватара(фотографии) пользователя
    public function ChangeUserAvatar( $params = [] ){

        $userID = +$params['userID'];
        $userLogin = $params['userLogin'];

        //получаем файл аватара(фоторграфии) пользователя
        if( isset( $_FILES['avatarFile'] ) ){

            //получаем расширение полученного файла
            $fileExtension = strrchr($_FILES['avatarFile']['name'], ".");

            //имя файла для аватара(фотографии) пользователя
            $fileName = "Avatar" . "_$userLogin" . "$fileExtension";

            //полный путь к аватарке(фотографии) пользователя
            $userAvatarDirectoryPath = "images/avatars/{$userID}/{$fileName}";

            //проверяем наличие аватара(фотографии) пользователя в базе
            $checkUserAvatarStm = MySQL::$db->prepare("SELECT userImagePath FROM useravatar WHERE userID = :userID");
            $checkUserAvatarStm->bindParam('userID', $userID, \PDO::PARAM_INT);
            $checkUserAvatarStm->execute();

            $userAvatar = $checkUserAvatarStm->fetch(\PDO::FETCH_OBJ);

            //если у пользователя есть аватар
            if($userAvatar){//обновляем текущий аватар(фотографию)

                if( !move_uploaded_file($_FILES['avatarFile']['tmp_name'] , $userAvatarDirectoryPath) ){

                    throw new \Exception('File upload error!');

                }//if

                //обновляем путь в базе данных
                $stm = MySQL::$db->prepare("UPDATE useravatar SET  userImagePath = :newUserAvatar WHERE userID = :userID");
                $stm->bindParam('newUserAvatar', $userAvatarDirectoryPath, \PDO::PARAM_STR);
                $stm->bindParam('userID', $userID, \PDO::PARAM_INT);
                $result = $stm->execute();

                return $result;

            }//if
            else{ //создаём новую директорию и сохраняем новый аватар(фотографию) пользователя

                //если дериктории аваторов не существует
                if( !file_exists("images/avatars") ){

                    //создаём директорию
                    mkdir("images/avatars");

                }//if

                //создаём папку с ID пользователя
                mkdir("images/avatars/{$userID}");

                if( !move_uploaded_file($_FILES['avatarFile']['tmp_name'] , $userAvatarDirectoryPath) ){

                    throw new \Exception('File upload error!');

                }//if

                //создаём запись в базе данных
                $stm = MySQL::$db->prepare("INSERT INTO useravatar VALUES ( DEFAULT , :userID , :userAvatarPath )");
                $stm->bindParam('userID', $userID , \PDO::PARAM_INT);
                $stm->bindParam('userAvatarPath', $userAvatarDirectoryPath , \PDO::PARAM_STR);
                $result = $stm->execute();

                //если создание записи не удалось
                if( $result === false ){

                    $exception = new \stdClass();
                    $exception->errorCode = MySQL::$db->errorCode ();
                    $exception->errorInfo = MySQL::$db->errorInfo ();

                    return $exception;

                }//if

            }//else

        }//if

    }//ChangeUserAvatar

    //обновление персональной информации пользователя
    public function  UpdateUserPersonalData( $params = [] ){

        //получаем новые персональные данные
        $userID = +$params['userID'];
        $userLogin = $params['userLogin'];
        $userEmail = $params['userEmail'];

        //проверяем входящие данные с уже имеющемися
        $checkUserStm = MySQL::$db->perepare("SELECT * FROM users WHERE (userLogin = :userLogin OR userEmail = :userEmail)");
        $checkUserStm->bindParam('userLogin', $userLogin, \PDO::PARAM_STR);
        $checkUserStm->bindParam('userEmail', $userEmail, \PDO::PARAM_STR);

        $checkUserResult = $checkUserStm->execute();

        //если совпадений нет - обновляем
        if(!$checkUserResult){

            //обновляем запись в базе данных
            $stm = MySQL::$db->prepare("UPDATE users SET userLogin = :userLogin, userEmail = :userLogin WHERE userID = :userID");
            $stm->bindParam('userLogin', $userLogin, \PDO::PARAM_STR);
            $stm->bindParam('userEmail', $userEmail, \PDO::PARAM_STR);
            $stm->bindParam('userID', $userID, \PDO::PARAM_INT);
            $result = $stm->execute();

            if($result){
                return array( 'code' => 200 );
            }//if
            else {
                return array( 'code' => 500 );
            }//else

        }//if
        else{

            //если пользователь с одним из параметров есть
            return array( 'code' => 301 );

        }//else

    }//UpdateUserPersonalData

}//PersonalPageService