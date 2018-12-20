<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 19.12.2018
 * Time: 21:28
 */

namespace Application\Services;

use Application\Utils\MySQL;
class CommentsService
{

    public function GetCommentsByBookId($id, $limit = 10 , $offset = 0){

        $stm = MySQL::$db->prepare("SELECT * FROM comments WHERE bookID=:id LIMIT :offset, :limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);
    }//GetGenres

    public function GetBookTitle($id){

        $stm = MySQL::$db->prepare("SELECT * FROM books WHERE bookID=:id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);
    }//GetGenres

    public function GetUser($id){

        $stm = MySQL::$db->prepare("SELECT * FROM users WHERE userID=:id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);
    }//GetGenres

}