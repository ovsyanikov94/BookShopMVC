<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 17.12.2018
 * Time: 16:09
 */

namespace Application\Controllers;


use Application\Services\GenresService;


class GenresController extends BaseController
{

    public function getGenresAction(){

        $genresService = new GenresService();

        $genres = $genresService->GetGenres();

        $template = $this->twig->load('Genre/genres-list.twig');

        $genreWithAmount = [];

        for($i=0;$i<count($genres);$i++){

            $genreWithAmount[$i] = [
                'genres' =>$genres[$i],
                'amount' =>$this->getGenreBooksAmountAction($genres[$i]->genreID)
            ];

        }//for

        echo $template->render( array(
            'genres' =>  $genreWithAmount
        ) );
    }//getGenresAction

    private function getGenreBooksAmountAction($id){

        $genresService = new GenresService();

        $amount = $genresService->GetGenreBooksAmount($id);

        return $amount;
    }//getGenreBooksAmountAction

    public function getGenreAction( $id ){

        $genreService = new GenresService();

        $genre = $genreService->GetGenreByID( $id );

        $template = $this->twig->load('Genre/genre.twig');

        echo $template->render( array(
            'genre' => $genre
        ) );

    }//getAuthorAction

    public function updateGenreAction(){
        $id = $this->request->GetPostValue('id');
        $name = $this->request->GetPostValue('name');


        $genresService = new GenresService();

        $countRow = $genresService->UpdateGenreByID($id, $name);



    }//updateGenreAction

    public function deleteGenreAction( $id ){

        $genreService = new GenresService();

        $result = $genreService->DeleteGenreByID( $id );
echo "RESULT $result";
        if($result >0){
            $this->getGenresAction();
        }//if


    }//deleteA
    public function addGetGenreAction(){

        $template = $this->twig->load('Genre/genre-add.twig');
        echo $template->render();
    }//addGenreAction

    public function addPostGenreAction(){

        $name = $this->request->GetPostValue('name');


        $genresService = new GenresService();

        $result = $genresService->AddGenre( $name);

        $this->json( array(
            'authorID' => $result,
            '{$_SERVER[\'HTTP_USER_AGENT\']}' => $_SERVER['HTTP_USER_AGENT'],
            '{$_SERVER[\'REMOTE_HOST\']}' => $_SERVER['REMOTE_HOST'],
        ) );

    }//addGenreAction
}//GenresController