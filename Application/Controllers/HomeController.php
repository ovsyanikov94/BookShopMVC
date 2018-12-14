<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:09
 */

namespace Application\Controllers;

class HomeController extends BaseController{

    public function indexAction(  ){

        $this->storage->langs = array(
            'RU',
            'EN',
            'DE'
        );

        return '../Application/Views/Home/index.pug';

    }//indexAction

}//HomeController