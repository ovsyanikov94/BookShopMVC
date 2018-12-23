<?php
/**
 * Created by PhpStorm.
 * User: YukaSan
 * Date: 23.12.2018
 * Time: 21:09
 */

namespace Application\Controllers;


class messageConst{

    public $verificationSubject = "Book-shop";
    public $verificationTemplate = null;

    public $header = "Content-type: text/html; charset=iso-8859-1\r\n";
    public function tuneTemplate($userName,$hesh){

        $this->verificationTemplate = '<h3> ВОВА </h3> </br> <a href="/BookShopMVC/public/verification/sdfagsdfgsdfghsdfhdfh"></a>';
    }//
}//messageConst