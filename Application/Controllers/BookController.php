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
        $bookISBN = $this->request->GetPostValue('bookISBN');
        $bookPages = $this->request->GetPostValue('bookPages');
        $bookPrice = $this->request->GetPostValue('bookPrice');
        $bookAmount = $this->request->GetPostValue('bookAmount');

        $bookService = new BookService();

        $result = $bookService->AddBook($bookTitle , $bookISBN , $bookPages , $bookPrice , $bookAmount);

        $this->json( array(
            'book' => $result
        ) );

    }//addBookAction

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

        $this->json(array(
            'book' => $result
        ));

    } // deleteBookAction

}//AuthorController