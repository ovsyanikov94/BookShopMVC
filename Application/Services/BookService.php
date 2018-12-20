<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.12.2018
 * Time: 17:21
 */

namespace Application\Services;

use Application\Utils\MySQL;

class BookService{

    public function GetBooks( $limit = 10 , $offset = 0 ){

        $stm = MySQL::$db->prepare("SELECT * FROM books LIMIT :offset, :limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//GetBooks

    public function GetBookById( $id ){


        $stm = MySQL::$db->prepare("SELECT * FROM books WHERE bookID = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);

    }//GetBookById

    public function AddBook( $bookTitle , $bookISBN , $bookPages , $bookPrice , $bookAmount ){

        $stm = MySQL::$db->prepare("INSERT INTO books VALUES( DEFAULT  , :bookTitle , :bookISBN , :bookPages, :bookPrice, :bookAmount)");
        $stm->bindParam(':bookTitle' , $bookTitle , \PDO::PARAM_STR);
        $stm->bindParam(':bookISBN' , $bookISBN , \PDO::PARAM_INT);
        $stm->bindParam(':bookPages' , $bookPages , \PDO::PARAM_INT);
        $stm->bindParam(':bookPrice' , $bookPrice , \PDO::PARAM_INT);
        $stm->bindParam(':bookAmount' , $bookAmount , \PDO::PARAM_INT);

        $stm->execute();

        $bookID =  MySQL::$db->lastInsertId();

        if( isset( $_FILES['bookImage'] ) ){


            $name =  $_FILES['bookImage']['name'];

            $name = time() . "_$name";

            if( !file_exists("images")){
                mkdir("images");
            }//if

            mkdir("images/{$bookID}");

            //$path = "/BookShopMVC/public/images/{$bookID}/{$name}";
            $path = "images/{$bookID}/{$name}";

            if( !move_uploaded_file($_FILES['bookImage']['tmp_name'] , $path) ){

                throw new \Exception('File upload error!');

            }//if

        }//if

        return $bookID;


    }//AddBook

    public function DeleteBookById($id){

        $stm = MySQL::$db->prepare("DELETE FROM books WHERE bookID = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $result = $stm->execute();

        return $result;

    } // DeleteBookById


}//BookService