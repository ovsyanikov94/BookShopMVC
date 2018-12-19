<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 17.12.2018
 * Time: 11:47
 */

namespace Application\Controllers;

use Application\Services\AuthorService;

class AuthorController extends BaseController{
    
    public function authorListAction(  ){

        $authorService = new AuthorService();
        $authors = $authorService->GetAuthors();

        $template = $this->twig->load('Author/authors-list.twig');

        echo $template->render( array(
            'authors' => $authors
        ) );

    }//authorListAction

    public function getAuthorAction( $id ){

        $authorService = new AuthorService();

        $author = $authorService->GetAuthorByID( $id );

        $template = $this->twig->load('Author/author.twig');

        echo $template->render( array(
            'author' => $author
        ) );

    }//getAuthorAction
    
    //AJAX-METHOD
    public function addAuthorAction(  ){

        $authorFirstname = $this->request->GetPostValue('authorFirstname');
        $authorLastname = $this->request->GetPostValue('authorLastname');

        $authorService = new AuthorService();

        $result = $authorService->AddAuthor($authorFirstname , $authorLastname);

        $data = array('code' => '200',
                      'authorID' => $result);
        $this->json( 200 , $data );

    }//authorListAction

    public function deleteAuthorAction( $id ){

        $authorService = new AuthorService();

        $authorService->DeleteAuthorByID( $id );

        $this->json( 200 , array(
            'code' => '200',
            'authorID' => $id
        ) );

    }//deleteAuthorAction


    public function updateAuthorAction($id){

        //$this->json( 200 , $params);

        $authorFirstname = $this->request->GetPutValue('authorFirstname');
        $authorLastname = $this->request->GetPutValue('authorLastname');

        $authorService = new AuthorService();

        $result = $authorService->UpdateAuthorByID($id, $authorFirstname , $authorLastname);

        $this->json( 200 ,array(
            'code'=> 200,
            'result' => $result
        ) );

    }//authorListAction
}//AuthorController