<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:09
 */

namespace Application\Controllers;
use Pug\Pug;

class HomeController extends BaseController{

    public function indexAction ( $word , $dec){

        echo "word : $word<br>";
        echo "dec  : $dec<br>";

        $this->storage->langs = array(
            'RU',
            'EN',
            'DE'
        );

        try {

            $pug = new Pug();
            $output = $pug->render(
                '../Application/Views/Home/index.pug',
                $this->storage->getRawStorage()
            );

            echo $output;

        }//try
        catch (\Exception $ex) {

            include '../Views/Errors/InternalError.php';

        }//catch

    }//indexAction

}//HomeController