<?php
/**
 * Created by PhpStorm.
 * User: YukaSan
 * Date: 13.01.2019
 * Time: 1:54
 */

namespace Application\Services;
use Application\Utils\MySQL;

class OrderService{

    public function UserDealInfoById($userId,$limit=1, $offset=0){


        $orders = MySQL::$db->prepare("SELECT * FROM orders WHERE userID = :userId LIMIT :offset,:limit");
        $orders->bindParam(':userId', $userId,\PDO::PARAM_INT);
        $orders->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $orders->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $orders->execute();

        $result = $orders->fetchAll(\PDO::FETCH_OBJ);

        if($result){
            return $result;
        }
       return null;

    }//UserDealInfoById

    public function getDealDetail($id){
        $detail = MySQL::$db->prepare("SELECT * FROM orderdetails WHERE orderID = :orderID");
        $detail->bindParam(':orderID', $id,\PDO::PARAM_INT);
        $detail->execute();

        $result = $detail->fetch(\PDO::FETCH_OBJ);

        return $result;
    }//getDealDetail

    public function UserDealInfoByDate($userId,$date, $limit, $offset){

    }//UserDealInfoData



}//OrderService