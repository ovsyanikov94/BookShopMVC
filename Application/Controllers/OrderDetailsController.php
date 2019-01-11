<?php


namespace Application\Controllers;


use Application\Services\BookService;
use Application\Services\OrderDetailsService;

class OrderDetailsController extends BaseController {

    public function getOrderDetailAction($id){

        $odService = new OrderDetailsService();

        $author = $odService->GetOrdersDetailsByID( $id );

        $template = $this->twig->load('Author/author.twig');

        echo $template->render( array(
            'author' => $author
        ) );

    }//getOrderDetailAction

    public function orderDetailsListAction(  ){

        $odService = new OrderDetailsService();
        $od = $odService->GetOrdersDetails();

        $template = $this->twig->load('OrderDetails/order-details-list.twig');

        echo $template->render( array(
            'orderdetails' => $od
        ) );

    }//orderDetailsListAction

    public function addOrderDetailsAction(  ){

        $bookService = new BookService();

        $books = $bookService->GetBooks();

        $template = $this->twig->load('OrderDetails/add-order-details.twig');

        echo $template->render(array(
            'books' => $books
        ) );

    }//addOrderDetailsAction

    public function addOrderDetailsDataAction(){

        $orderID = $this->request->GetPostValue('orderID');
        $bookID = $this->request->GetPostValue('bookID');

        $odService = new OrderDetailsService();
        $result = $odService->AddOrdersDetails($orderID, $bookID);

        header('Location: /BookShopMVC/public/orderdetails/');

    }//addOrderDetailsDataAction

    public function deleteOrderDetailsAction($id){

        $odService = new OrderDetailsService();
        $result = $odService->DeleteOrdersDetailsByID($id);

        $this->json(array(
            'orderdetails' => $result
        ));

    }//deleteOrderDetailsAction

}//OrderDetailsController