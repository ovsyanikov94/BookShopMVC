<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 9:23
 */

namespace Classes;

use Interfaces\ISerializeble;

class User implements ISerializeble
{

    public function ShowUser(  ){

        echo "<h1>User here!</h1>";

    }

    public function serialize(){
        echo "User was save!";
    }//serialize

}