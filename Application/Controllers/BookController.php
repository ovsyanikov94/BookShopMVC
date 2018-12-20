<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.12.2018
 * Time: 16:25
 */

namespace Application\Controllers;

use Application\Services\BookService;

class BookController extends BaseController{

    public function bookListAction(  ){

        $bookService = new BookService();

        $books = $bookService->GetBooks();

        $template = $this->twig->load( 'Book\book-list.twig');

        echo $template->render( array(
            'books' => $books
        ) );

    }//bookListAction

    public function getBookByIdAction( $id ){

        $bookService = new BookService();

        $book = $bookService->GetBookById( $id );

        $template = $this->twig->load( 'Book/book.twig');

        echo $template->render( array(
            'book' => $book
        ) );

    }//getBooksByIdAction

    public function newBookAction(  ){

        $template = $this->twig->load( 'Book/new-book.twig');

        echo $template->render();

    }//newBookAction

    public function addBookAction( ){

        $bookTitle = $this->request->GetPostValue('bookTitle');

        if(! filter_var($bookTitle , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^[а-яА-Я\w]{3,50}$/i"))
        )){

            $this->json( 400 , array(
                'title_err' => $bookTitle,
                'POST' => $_POST
            ) );

            return;

        }//if

        $bookISBN = $this->request->GetPostValue('bookISBN');

        if(! filter_var($bookISBN , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^\d{9}[\d|X]$/"))
        )){

            $this->json( 400 , array(
                'ISBN_err' => $bookISBN
            ) );

            return;

        }//if

        $bookPages = $this->request->GetPostValue('bookPages');

        if(! filter_var($bookPages , FILTER_VALIDATE_REGEXP , array(
            "options" => array("regexp"=>"/\d{1,10}$/"))
        )){

            $this->json( 400 , array(
                'Pages_err' => $bookPages
            ) );

            return;

        }//if

        $bookPrice = $this->request->GetPostValue('bookPrice');

        if(! filter_var($bookPrice , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^\d{1,7}/"))
        )){

            $this->json( 400 , array(
                'Price_err' => $bookPrice
            ) );

            return;

        }//if

        $bookAmount = $this->request->GetPostValue('bookAmount');

        if(! filter_var($bookAmount , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^\d{1,5}/"))
        )){

            $this->json( 400 , array(
                'Amount_err' => $bookAmount
            ) );

            return;

        }//if

        $bookService = new BookService();

        $result = $bookService->AddBook($bookTitle , $bookISBN , $bookPages , $bookPrice , $bookAmount);

        $this->json( 200 , array(
            'book' => $result
        ) );

    }//addBookAction

    public function acceptEditBookAction($id){

        $bookTitle = $this->request->GetPostValue('bookTitle');

        if(! filter_var($bookTitle , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^[а-яА-Я\w]{3,50}$/i"))
        )){

            $this->json( 400 , array(
                'title_err' => $bookTitle,
                'POST' => $_POST
            ) );

            return;

        } // If

        $bookISBN = $this->request->GetPostValue('bookISBN');

        if(! filter_var($bookISBN , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^\d{9}[\d|X]$/"))
        )){

            $this->json( 400 , array(
                'ISBN_err' => $bookISBN
            ) );

            return;

        }//if

        $bookPages = $this->request->GetPostValue('bookPages');

        if(! filter_var($bookPages , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/\d{1,10}$/"))
        )){

            $this->json( 400 , array(
                'Pages_err' => $bookPages
            ) );

            return;

        }//if

        $bookPrice = $this->request->GetPostValue('bookPrice');

        if(! filter_var($bookPrice , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^\d{1,7}/"))
        )){

            $this->json( 400 , array(
                'Price_err' => $bookPrice
            ) );

            return;

        }//if

        $bookAmount = $this->request->GetPostValue('bookAmount');

        if(! filter_var($bookAmount , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^\d{1,5}/"))
        )){

            $this->json( 400 , array(
                'Amount_err' => $bookAmount
            ) );

            return;

        }//if

        $bookID = $id;

        $bookService = new BookService();

        $result = $bookService->EditBookByID($bookTitle , $bookISBN , $bookPages , $bookPrice , $bookAmount, $bookID);

        $this->json( 200 , array(
            'book' => $result,
            'code' => 200
        ) );

    } // acceptEditBookAction

    public function infoBookAction($id){

        $bookService = new BookService();
        $bookForInfo = $bookService->GetBookById($id);

        $template = $this->twig->load( 'Book/info-book.twig');

        echo $template->render(array(
            'book' => $bookForInfo
        ));

    } // infoBookAction

    public function deleteBookAction($id){

        $bookService = new BookService();
        $result = $bookService->DeleteBookById($id);

        $this->json( 200 ,  array(
            'book' => $result,
            'code' => 200
        ));

    } // deleteBookAction

    public function editBookAction($id){

        $bookService = new BookService();
        $result = $bookService->GetBookById($id);

        $template = $this->twig->load( 'Book/edit-book.twig');

        echo $template->render(array(
            'book' => $result
        ));

    } // editBookAction

}//AuthorController