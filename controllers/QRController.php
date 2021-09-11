<?php


namespace controllers;


class QRController
{
    public function index($params = null){
        ini_set('error_reporting', E_ALL);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);

        require_once 'core/qrsimple/qrlib.php';
        $text = null;
        $logo = false;
        $logosrc = false;

                $text=$params[0]['val'];




         \QRcode::png($text,false,'L',6,4,false);


    }




}