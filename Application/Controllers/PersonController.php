<?php
/**
 * Created by PhpStorm.
 * User: elena
 * Date: 19.12.2018
 * Time: 19:41
 */

namespace Application\Controllers;


class PersonController extends BaseController
{

    public function getPersonAction(){



        $template = $this->twig->load('Person/person.twig');



        echo $template->render();
    }//getGenresAction
}