<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 14.12.2018
 * Time: 11:12
 */

namespace Application\Utils;


class Request{

    public function GetGetValue( $key ){

        //$_GET[ $key ]

        if( isset($_GET[$key]) ){
            return $_GET[$key];
        }//if

        return null;

    }//GetGetValue

    public function GetPostValue( $key ){

        if( isset($_POST[$key]) ){
            return $_POST[$key];
        }//if

        return null;

    }//GetPostValue

}//Request