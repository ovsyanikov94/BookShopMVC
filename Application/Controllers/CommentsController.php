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

            $dateStr = date("d-m-Y H:i:s", $comments[$i]->created);
            $commentWithUser[$i] = [
                'comment' => $comments[$i],
                'user' => $commentService->GetUser($comments[$i]->userID),
                'date' => $dateStr
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
        if (preg_match('/^[а-я\s\d\s\w]{4,1500}$/iu', $text) &&
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

    }//addGenreAction

    public function deleteCommentAction($id){

        $commentService = new CommentsService();

        $commentService->DeleteCommentByID( $id );

        $this->json( 200 , array(
            'code' => 200,
            'authorID' => $id
        ) );


    }//deleteCommentAction

    public function updateCommentAction(   ){



        $commentText = $this->request->GetPutValue('text');
        $commentID = $this->request->GetPutValue('commentID');
        $currentUser = $this->request->GetPutValue('userId');

        $commentService = new CommentsService();

        $result = $commentService->UpdateCommentByID($commentID, $commentText);

        $this->json( 200 ,array(
            'code' => 200,
            'result' => $result,
            'text' => $commentText
        ) );

    }//authorListAction
}//CommentsController