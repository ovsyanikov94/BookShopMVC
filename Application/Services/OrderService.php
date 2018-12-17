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

        $stm = MySQL::$db->prepare("SELECT * FROM orders LIMIT :offset, :limit");
        $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_OBJ);

    }//GetOrders

    public function AddOrder( $genreID , $userID ){

        $stm = MySQL::$db->prepare("INSERT INTO orders VALUES( DEFAULT  , :genreID , :userID)");
        $stm->bindParam(':genreID' , $genreID , \PDO::PARAM_STR);
        $stm->bindParam(':userID' , $userID , \PDO::PARAM_STR);
        $stm->execute();

        return  MySQL::$db->lastInsertId();

    }//AddOrder

    public function UpdateOrder( $orderID, $genreID , $userID ){

        $stm = MySQL::$db->prepare("UPDATE orders SET genreID = :genreID, userID = :userID WHERE orderID = :orderID");
        $stm->bindParam(':genreID' , $genreID , \PDO::PARAM_STR);
        $stm->bindParam(':userID' , $userID , \PDO::PARAM_STR);
        $stm->bindParam(':orderID' , $orderID , \PDO::PARAM_STR);
        $result = $stm->execute();

        return  $result;

    }//AddOrder

    public function GetOrderByID( $id ){

        $stm = MySQL::$db->prepare("SELECT * FROM orders WHERE orderID = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $stm->execute();

        return $stm->fetch(\PDO::FETCH_OBJ);

    }//GetOrderByID

    public function DeleteOrderByID( $id ){

        $stm = MySQL::$db->prepare("DELETE FROM orders WHERE orderID = :id");
        $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
        $result = $stm->execute();

        return $result;

    }//DeleteOrderByID

}//OrderService
