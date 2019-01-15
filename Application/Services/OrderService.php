<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 17.12.2018
 * Time: 11:53
 */

namespace Application\Services;

use Application\Utils\MySQL;

class OrderService{

    public function GetOrders( $limit = 10 , $offset = 0 ){

        $stm = MySQL::$db->prepare("SELECT orderID, userID, orderDatetime, orderStatus
                                   FROM orders LIMIT :offset, :limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//GetOrders

    public function AddOrder( $userID, $orderStatus, $adress ){

        $stm = MySQL::$db->prepare("INSERT INTO orders(userID, orderDatetime, orderStatus, adressOrder) 
                                    VALUES(  :userID , NOW(), :orderStatusID, :adress)");
        $stm->bindParam(':userID' , $userID , \PDO::PARAM_INT);
        $stm->bindParam(':orderStatusID' , $orderStatus , \PDO::PARAM_INT);
        $stm->bindParam(':adress' , $adress , \PDO::PARAM_STR);
        $stm->execute();

        return  MySQL::$db->lastInsertId();

    }//AddOrder


    public function GetTitleStatusOrderByID($statusId){

        $stm = MySQL::$db->prepare("SELECT  statusTitle
                                   FROM orderstatus WHERE statusID = :statusId");
        $stm->bindParam(':statusId' , $statusId , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);
    }//GetTitleStatusByID


    public function GetOrderStatuses(){

        $stm = MySQL::$db->prepare("SELECT statusID, statusTitle
                                 FROM orderstatus");
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//GetOrderStatuses

    public function GetOrderByID( $id ){

        $stm = MySQL::$db->prepare("SELECT orderID, userID, orderDatetime, orderStatus, adressOrder 
                                    FROM orders WHERE orderID = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);

    }//GetOrderByID


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

    public function UpdateStatusOrder($orderID, $statusID){

        $stm = MySQL::$db->prepare("UPDATE orders
                                    SET orderStatus = :statusID
                                    WHERE orderID = :orderID;");
        $stm->bindParam(':orderID' , $orderID , \PDO::PARAM_INT);
        $stm->bindParam(':statusID' , $statusID , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);
    }//UpdateStatusOrder

}//OrderService
