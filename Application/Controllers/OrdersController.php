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

    public function UserDealInfoByIdAction(   ){

        $OrdersService = new OrderService();
        $BookService=new BookService();
        $orders = $OrdersService->UserDealInfoById(10, $limit=10, $offset=0);
        $template = $this->twig->load('public/OrderAndCart/orders.twig');

        $detailArray=[];

        for ($i=0; $i< count($orders);$i++){

            $ans = $OrdersService->getDealDetail($orders[$i]->orderID);
            $booksInfo = $BookService->GetBookById($ans->bookID);
            $detailArray[$i]=[
                'detail'=> $ans,
                'bookInfo'=> $booksInfo,
                'date'=>$orders[$i]->orderDatetime,
            ];
        }//for

        echo $template->render( array(
            'orders' => $detailArray
        ) );
    }//UserDealInfoByIdAction

    public function UserDealInfoById(){

        $OrdersService = new OrderService();
        $BookService=new BookService();
        $orders = $OrdersService->UserDealInfoById(10, $limit=2, $offset=0);
        $detailArray=[];

        for ($i=0; $i< count($orders);$i++){

            $ans = $OrdersService->getDealDetail($orders[$i]->orderID);
            $booksInfo = $BookService->GetBookById($ans->bookID);
            $detailArray[$i]=[
                'detail'=> $ans,
                'bookInfo'=> $booksInfo,
                'date'=>$orders[$i]->orderDatetime,
            ];
        }//for

        $this->json( 200 , array(
            'code' => 200,
            'orders' => $detailArray
        ) );
    }//UserDealInfoById


    public function DealInfoByLoginOrEmail($string, $limit, $offset){

        $userService = new UserService();

        $userId = $userService->getSingleUser($string);

        $OrdersService = new OrderService();
        $BookService=new BookService();
        $orders = $OrdersService->UserDealInfoById($userId->userID, $limit, $offset);
        $template = $this->twig->load('public/OrderAndCart/orders.twig');

        $detailArray=[];

        for ($i=0; $i< count($orders);$i++){

            $ans = $OrdersService->getDealDetail($orders[$i]->orderID);
            $booksInfo = $BookService->GetBookById($ans->bookID);
            $detailArray[$i]=[
                'detail'=> $ans,
                'bookInfo'=> $booksInfo,
                'date'=>$orders[$i]->orderDatetime,
            ];
        }//for

        echo $template->render( array(
            'orders' => $detailArray
        ) );
    }//UserDealInfoByLoginOrEmail


    public function DealInfoByDate($date, $limit, $offset){

    }//DealInfoDate
}