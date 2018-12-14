<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 9:24
 */

namespace Classes\Config;

use Classes\User;

class Router
{

    public function get( $url ){

        echo "GET: $url <br>";

        $user = new User();
        $user->ShowUser();

    }//get

}