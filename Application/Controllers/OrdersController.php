<?php
/**
 * Created by PhpStorm.
 * User: YukaSan
 * Date: 13.01.2019
 * Time: 1:23
 */

namespace Application\Controllers;
use Application\Services\OrderService;
use Application\Services\BookService;
use Application\Services\UserService;

class OrdersController extends BaseController{

    public function UserDealInfoByIdAction(  ){

        $OrdersService = new OrderService();
        $userService = new UserService();
        $userId = $userService->getCurrentUser();

        $orders = $OrdersService->UserDealInfoById($userId['userID'], $limit=10, $offset=0);
        $template = $this->twig->load('public/OrderAndCart/ordersInfo.twig');


        if($offset!==null){
            echo $template->render( array(
                'orders' => $orders
            ) );
        }//if
        else{
            echo $template->render( array(
                'orders' => []
            ) );
        }//else

    }//UserDealInfoByIdAction

    public function UserDealInfoById($limit, $offset){

        $OrdersService = new OrderService();

        $orders = $OrdersService->UserDealInfoById($userId['userID'], $limit, $offset);

        if($orders !==null){
            $this->json( 200 , array(
                'code' => 200,
                'orders' => $orders
            ) );
        }//if
        else{
            $this->json( 200 , array(
                'code' => 200,
                'orders' => []
            ) );
        }//if
    }//UserDealInfoById

    public function userOrderDetailAction($orderId){

        $template = $this->twig->load('public/OrderAndCart/orders.twig');
        $BookService = new BookService();
        $OrdersService = new OrderService();
        $orderDetail = $OrdersService->getDealDetail($orderId,$limit=10,$offset=0);


        for($i=0; $i<count($orderDetail);$i++){

            $book = $BookService->GetBookById($orderDetail[$i]->bookID);

            $orderDetail[$i]->book = $book;
        }//for

        echo $template->render( array(
            'orderDetail' => $orderDetail
        ) );
    }//userOrderDetail
    public function userOrderDetail($orderId, $limit, $offset){
        $BookService = new BookService();
        $OrdersService = new OrderService();
        $orderDetail = $OrdersService->getDealDetail($orderId,$limit,$offset);


        for($i=0; $i<count($orderDetail);$i++){

            $book = $BookService->GetBookById($orderDetail[$i]->bookID);

            $orderDetail[$i]->book = $book;
        }//for

        $this->json( 200 , array(
            'code' => 200,
            'orderDetail' => $orderDetail
        ) );

    }//userOrderDetail

}