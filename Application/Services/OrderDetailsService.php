<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 17.12.2018
 * Time: 11:53
 */

namespace Application\Services;

use Application\Utils\MySQL;

class OrderDetailsService{

    public function GetOrdersDetails( $limit = 10 , $offset = 0 ){

        $stm = MySQL::$db->prepare("SELECT * FROM orderdetails LIMIT :offset, :limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//GetOrdersDetails

    public function AddOrdersDetails( $orderID , $bookID, $bookPrice, $bookAmount){

        $stm = MySQL::$db->prepare("INSERT INTO orderdetails VALUES( DEFAULT  , :orderID , :bookID, :bookPrice, :bookAmount)");
        $stm->bindParam(':orderID' , $orderID , \PDO::PARAM_STR);
        $stm->bindParam(':bookID' , $bookID , \PDO::PARAM_STR);
        $stm->bindParam(':bookPrice' , $bookPrice , \PDO::PARAM_STR);
        $stm->bindParam(':bookAmount' , $bookAmount , \PDO::PARAM_STR);
        $stm->execute();

        return  MySQL::$db->lastInsertId();

    }//AddOrdersDetails

    public function UpdateOrdersDetails( $id, $orderID , $bookID, $bookPrice, $bookAmount ){

        $stm = MySQL::$db->prepare("UPDATE orderdetails SET orderID = :orderID, bookID = :bookID, bookPrice = :bookPrice, bookAmount = :bookAmount WHERE id = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_STR);
        $stm->bindParam(':orderID' , $orderID , \PDO::PARAM_STR);
        $stm->bindParam(':bookID' , $bookID , \PDO::PARAM_STR);
        $stm->bindParam(':bookPrice' , $bookPrice , \PDO::PARAM_STR);
        $stm->bindParam(':bookAmount' , $bookAmount , \PDO::PARAM_STR);
        $result = $stm->execute();

        return  $result;

    }//UpdateOrdersDetails

    public function GetOrdersDetailsByID( $id ){

        $stm = MySQL::$db->prepare("SELECT * FROM orderdetails WHERE id = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);

    }//GetOrdersDetailsByID

    public function DeleteOrdersDetailsByID( $id ){

        $stm = MySQL::$db->prepare("DELETE FROM orderdetails WHERE id = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $result = $stm->execute();

        return $result;

    }//DeleteOrdersDetailsByID

}//OrderDetailsService
