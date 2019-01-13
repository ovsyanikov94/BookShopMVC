<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 11.01.2019
 * Time: 10:11
 */

namespace Application\Controllers;
use Application\Services\BookService;
use Application\Services\CartService;

class CartController extends BaseController{

    public function cartAction(  ){


        $template = $this->twig->load( 'public\\OrderAndCart\\cart.twig');

        $cartService = new CartService();
        $bookService = new BookService();

        $cart = $cartService->getCart();
        $books = [];

        $cartTotal = 0;

        foreach ($cart as $cartItem) {

            $book = $bookService->GetBookById( $cartItem->bookID );
            $book->amount = $cartItem->amount;
            $book->totalPrice = $book->amount * $book->bookPrice;

            $cartTotal += $book->totalPrice;

            array_push($books , $book);

        }//foreach

        echo $template->render( array(
            'cart' => $books,
            'cartTotal' => $cartTotal
        ) );


    }//

    public function ordersAction(  ){


        $template = $this->twig->load( 'public\\OrderAndCart\\orders.twig');

        echo $template->render( array(
        ) );


    }//

}