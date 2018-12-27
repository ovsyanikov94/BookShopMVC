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
    public function commentModerationListAction($id){

        $commentService = new CommentsService();

        $comments = $commentService->GetCommentByStatusId($id);

        $template = $this->twig->load('Comment/moderated-comment-list.twig');

        $commentWithUser = [];

        for($i=0;$i < count($comments); $i++ ){
            $book = $commentService->GetBookTitle($comments[$i]->bookID);
            $dateStr = date("d-m-Y H:i:s", $comments[$i]->created);
            $commentWithUser[$i] = [
                'comment' => $comments[$i],
                'user' => $commentService->GetUser($comments[$i]->userID),
                'date' => $dateStr,
                'book' => $book,
            ];

        }//for

        echo $template->render(array(
                'comments' => $commentWithUser,

            )
         );
    }//commentListAction
    public function commentMoreAction($id){

        $commentService = new CommentsService();

        $limit = $this->request->GetGetValue('limit');
        $offset = $this->request->GetGetValue('offset');

        $comments = $commentService->GetCommentsByBookId((int)$id, (int)$limit , (int)$offset);

        $book = $commentService->GetBookTitle($id);

        $commentWithUser = [];

        for($i=0;$i < count($comments); $i++ ){

            $dateStr = date("d-m-Y H:i:s", $comments[$i]->created);
            $commentWithUser[$i] = [
                'comment' => $comments[$i],
                'user' => $commentService->GetUser($comments[$i]->userID),
                'date' => $dateStr,

            ];

        }//for

        $this->json( 200 , array(
            'status' => 200,
            'comments' => $commentWithUser,
            'book' => $book,

        ) );

    }//commentListAction

    public function addCommentAction(){

        $text = $this->request->GetPostValue('text');
        $bookId = $this->request->GetPostValue('bookId');
        $userId = $this->request->GetPostValue('userId');
        $bookService = new BookService();
        $commentsService = new CommentsService();
        if (iconv_strlen ( $text ) > 4 &&
            $bookService->GetBookById($bookId) &&
            $commentsService->GetUser($userId)
        ) {

            if(iconv_strlen ( $text ) > 1500){
                $text = substr ($text, 0 , 1495);
                $text .= "...";
            }

            $time = time();
            $result = $commentsService->AddComment( $text, $bookId, $userId, $time);

            $comment = $commentsService->GetCommentById($result);
            $user = $commentsService->GetUser($userId);
            $this->json( 200, array(
                'status' => '200',
                'user' => $user,
                'comment' => $comment,
                'date' =>  date("d-m-Y H:i:s", $comment->created),
            ) );
        } else {

            $error = [
                'smollLength' =>iconv_strlen ( $text ) > 4,
                'isBook' => (boolean)$bookService->GetBookById($bookId),
                'isUser' => $commentsService->GetUser($userId)
            ];

            $this->json( 400, array(
                'status' => '400',
                'user' => null,
                'comment' => null,
                'error' => $error
            ) );
        }

    }//addCommentAction

    public function deleteCommentAction($id){

        $commentService = new CommentsService();

        $commentService->DeleteCommentByID( $id );

        $this->json( 200 , array(
            'code' => 200,
            'commentID' => $id
        ) );


    }//deleteCommentAction

    public function updateCommentAction(   ){



        $commentText = $this->request->GetPutValue('text');
        $commentID = $this->request->GetPutValue('commentID');
        $currentUser = $this->request->GetPutValue('userId');

        $commentService = new CommentsService();

        if (iconv_strlen ( $commentText ) > 4
            ) {

            if (iconv_strlen($commentText) > 1500) {
                $commentText = substr($commentText, 0, 1495);
                $commentText .= "...";
            };
            $time = time();
            $result = $commentService->UpdateCommentByID($commentID, $commentText, $time);

            $this->json(200, array(
                'code' => 200,
                'result' => $result,
                'text' => $commentText
            ));
        }//if
    }//updateCommentAction

    public function updateCommentStatusAction(   ){




        $commentID = $this->request->GetPutValue('commentID');
        $commentStatus = $this->request->GetPutValue('commentStatus');


        $commentService = new CommentsService();


            $time = time();
            $result = $commentService->UpdateCommentStatusByID((int)$commentID, (int)$commentStatus, $time);

            $this->json(200, array(
                'code' => 200,
                'result' => $result,

            ));

    }//updateCommentStatusAction
}//CommentsController