<?php


namespace Application\Controllers;


use Application\Services\BookService;
use Application\Services\OrderDetailsService;
use Application\Services\OrderService;
use Application\Services\UserService;

class OrderController extends BaseController {

    public function getOrderAction(){

        $orderService = new OrderService();
        $orders = $orderService->GetOrders();

        $userService = new UserService();

        $odService  = new OrderDetailsService();

        $ordersWithUser = [];

        for($i=0;$i < count($orders); $i++ ){

            $ordersWithUser[$i] = $this->GetFullOrder($orders[$i]);

        }//for

        $template = $this->twig->load('Order/order-list.twig');

        echo $template->render( array(
            'orders' => $ordersWithUser
        ) );

    }//getOrderAction

    public function GetFullOrder($order){

        $orderService = new OrderService();

        $userService = new UserService();

        $odService  = new OrderDetailsService();

        $dateStr = date("d-m-Y H:i:s", $order->orderDatetime);

        $countBook = $odService->GetCountBookInOrderByID($order->orderID);

        return [
            'order' => $order,
            'user' => $userService->getSingleUser($order->userID),
            'date' => $dateStr,
            'count' => $countBook,
            'statusTitle' => $orderService->GetTitleStatusOrderByID($order->orderStatus),

        ];
    }
    public function addOrder(){

        $cart = json_decode($this->request->GetPostValue('cart'));

        $time = time();

        $userService = new UserService();

        $user = $userService->getCurrentUser();

        if(!$user){
            $this->json( 401 , array(
                'code' => 401,
                'message' => "Вы не авторизированны"
            ) );
        }
        $const = new patternConst();

        $orderStatus = $const->statusOrderInProsess;

        $orderService  = new OrderService();

        try{
            $orderID = $orderService->AddOrder($time, $user['userID'], $orderStatus);

            $bookService = new BookService();
            $orderDetailsService = new OrderDetailsService();

            $bookByID= null;

            foreach($cart as $book){

                $bookByID = $bookService->GetBookById($book->bookID);

                $orderDetailsService->AddOrdersDetails($orderID, $book->bookID, $bookByID->bookPrice, $book->amount );

            }//foreach

            $this->json( 200 , array(
                'code' => 200,
                '$orderID' => $orderID,
            ) );

        }//try
        catch (\Exception $ex){
            $this->json( 500 , array(
                'code' => 500,
                'message' => $ex
            ) );
        }//catch

    }//addOrder
}//OrderController