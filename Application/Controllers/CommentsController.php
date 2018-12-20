<?php

namespace Application\Controllers;

use Application\Services\CommentsService;
use Application\Services\BookService;


class CommentsController extends BaseController{

    public $currentUser = 1;

    public function commentListAction($id){

        $commentService = new CommentsService();

        $comments = $commentService->GetCommentsByBookId($id);

        $book = $commentService->GetBookTitle($id);

        $template = $this->twig->load('Comment/comment-list.twig');

        $commentWithUser = [];

        for($i=0;$i < count($comments); $i++ ){

            $commentWithUser[$i] = [
                'comment' => $comments[$i],
                'user' => $commentService->GetUser($comments[$i]->userID)
            ];

        }//for

        echo $template->render(array(
                'comments' => $commentWithUser,
                'book' => $book,
                'currentUser' => $this->currentUser
            )
         );
    }//commentListAction

    public function addCommentAction(){

        $text = $this->request->GetPostValue('text');
        $bookId = $this->request->GetPostValue('bookId');
        $userId = $this->request->GetPostValue('userId');
        $bookService = new BookService();
        $commentsService = new CommentsService();
        if (preg_match('/^[а-я\s\d\s\w]{4,1500}$/i', $text) &&
            $bookService->GetBookById($bookId) &&
            isset($commentsService->GetUser($userId)[0])
        ) {

            $time = time();
            $result = $commentsService->AddComment( $text, $bookId, $userId, $time);

            $comment = $commentsService->GetCommentById($result);
            $user = $commentsService->GetUser($userId)[0];
            $this->json( 200, array(
                'status' => '200',
                'user' => $user,
                'comment' => $comment
            ) );
        } else {
            $this->json( 400, array(
                'status' => '400',
                'user' => null,
                'comment' => null
            ) );
        }



        // echo json_encode( $myVar );



    }//addGenreAction
}//CommentsController