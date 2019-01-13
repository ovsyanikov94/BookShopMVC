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

    public function AddOrder( $time , $userID, $orderStatus ){

        $stm = MySQL::$db->prepare("INSERT INTO orders(userID, orderDatetime, orderStatus) VALUES(  :userID , :timeOrder, :orderStatusID)");
        $stm->bindParam(':userID' , $userID , \PDO::PARAM_INT);
        $stm->bindParam(':orderStatusID' , $orderStatus , \PDO::PARAM_INT);
        $stm->bindParam(':timeOrder' , $time , \PDO::PARAM_INT);
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


    public function GetOrderByID( $id ){

        $stm = MySQL::$db->prepare("SELECT orderID, userID, orderDatetime, orderStatus 
                                    FROM orders WHERE orderID = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);

    }//GetOrderByID



}//OrderService
