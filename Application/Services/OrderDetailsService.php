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



    public function AddOrdersDetails( $orderID , $bookID, $bookPrice, $bookAmount){

        $stm = MySQL::$db->prepare("INSERT INTO orderdetails (orderID, bookID, bookPrice, bookAmount) 
                                    VALUES( :orderID , :bookID, :bookPrice, :bookAmount)");
        $stm->bindParam(':orderID' , $orderID , \PDO::PARAM_INT);
        $stm->bindParam(':bookID' , $bookID , \PDO::PARAM_INT);
        $stm->bindParam(':bookPrice' , $bookPrice , \PDO::PARAM_STR);
        $stm->bindParam(':bookAmount' , $bookAmount , \PDO::PARAM_INT);
        $stm->execute();

        return  MySQL::$db->lastInsertId();

    }//AddOrdersDetails

    public function GetCountBookInOrderByID($orderID){

        $stm = MySQL::$db->prepare("SELECT COUNT(orderID) FROM orderdetails WHERE orderID = :orderID");
        $stm->bindParam(':orderID' , $orderID , \PDO::PARAM_INT);

        $stm->execute();

        return $stm->fetch();

    }//GetCountBookInOrderByID


    public function GetOrdersDetailsByOrderId( $orderID){

        $stm = MySQL::$db->prepare("SELECT bookID,  bookPrice, bookAmount 
                                    FROM orderdetails 
                                    WHERE orderID = :orderID");
        $stm->bindParam(':orderID' , $orderID , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//GetOrdersDetails

}//OrderDetailsService
