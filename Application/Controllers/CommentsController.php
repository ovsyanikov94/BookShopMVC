<?php

namespace Application\Controllers;

use Application\Services\CommentsService;


class CommentsController extends BaseController{

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
                'book' => $book
            )
         );
    }//commentListAction

}//CommentsController