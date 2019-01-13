<?php


namespace Application\Controllers;


use Application\Services\BookService;
use Application\Services\OrderDetailsService;
use Application\Services\OrderService;

class OrderDetailsController extends BaseController {



    public function orderDetailsListAction( $orderID ){

        $odService = new OrderDetailsService();
        $orderDetails = $odService->GetOrdersDetailsByOrderId($orderID);

        $orderService  = new OrderService();
        $orderController = new OrderController();

        $order = $orderService->GetOrderByID($orderID);

        $orderFull = $orderController->GetFullOrder($order);

        $bookService = new BookService();

        $ODFull = [];

        for($i=0;$i < count($orderDetails); $i++ ){

            $ODFull[$i] = [
                'od'=>$orderDetails[$i],
                'book'=>$bookService->GetBookById($orderDetails[$i]->bookID),
            ];

        }//for

        $template = $this->twig->load('Order/orderDetails.twig');

        echo $template->render( array(
            'orderdetails' => $ODFull,
            'order'=>$orderFull
        ) );

    }//orderDetailsListAction



}//OrderDetailsController