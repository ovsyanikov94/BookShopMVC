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
    }//GetCommentsByBookId

    public function GetCommentById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM comments WHERE commentID=:id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);
    }//GetCommentsByBookId

    public function GetBookTitle($id){

        $stm = MySQL::$db->prepare("SELECT * FROM books WHERE bookID=:id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);
    }//GetBookTitle

    public function GetUser($id){

        $stm = MySQL::$db->prepare("SELECT * FROM users WHERE userID=:id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);
    }//GetUser

    public function AddComment( $text, $bookId, $userId, $time  ){

        $status = 1;
        $updete = 0;

        $stm = MySQL::$db->prepare("INSERT INTO comments VALUES( DEFAULT  , :userId, :bookId, :text, :status, :create, :updete)");
        $stm->bindParam(':userId' , $userId , \PDO::PARAM_INT);
        $stm->bindParam(':bookId' , $bookId , \PDO::PARAM_INT);
        $stm->bindParam(':text' , $text , \PDO::PARAM_STR);
        $stm->bindParam(':status' , $status , \PDO::PARAM_INT);
        $stm->bindParam(':create' , $time , \PDO::PARAM_INT);
        $stm->bindParam(':updete' , $updete , \PDO::PARAM_INT);
        $stm->execute();

        return  MySQL::$db->lastInsertId();


    }//AddComment

    public function DeleteCommentByID( $id ){

        $stm = MySQL::$db->prepare("DELETE FROM comments WHERE commentID = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $result = $stm->execute();

        return $result;

    }//DeleteAuthorByID


}