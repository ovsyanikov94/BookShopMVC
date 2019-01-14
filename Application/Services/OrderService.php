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

    public function UserDealInfoById($userId,$limit, $offset){


        $orders = MySQL::$db->prepare("SELECT * FROM orders WHERE userID = :userId LIMIT :offset,:limit");
        $orders->bindParam(':userId', $userId,\PDO::PARAM_INT);
        $orders->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $orders->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $orders->execute();

        $result = $orders->fetchAll(\PDO::FETCH_OBJ);




        if($result){

            for($i=0;$i<count($result);$i++){
                $id = $result[$i]->orderStatus;
                $statueTitle =  $orders = MySQL::$db->prepare("SELECT statusTitle FROM `orderstatus` WHERE statusID =$id ");
                $statueTitle->execute();
                $statueTitleResult = $orders->fetch(\PDO::FETCH_OBJ);
                $result[$i]->orderStatus = $statueTitleResult;
            }//for

        return $result;

        }//if
       return null;

    }//UserDealInfoById

    public function getDealDetail($id, $limit, $offset){
        $detail = MySQL::$db->prepare("SELECT * FROM orderdetails WHERE orderID = :orderID LIMIT :offset,:limit");
        $detail->bindParam(':orderID', $id,\PDO::PARAM_INT);
        $detail->bindParam(':offset' , $offset , \PDO::PARAM_INT);
        $detail->bindParam(':limit' , $limit , \PDO::PARAM_INT);
        $detail->execute();

        $result = $detail->fetch(\PDO::FETCH_OBJ);

        return $result;
    }//getDealDetail

}//OrderService