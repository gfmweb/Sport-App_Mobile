<?php


namespace controllers;


use core\SimpleImage;

class GetPhotoController
{
    public function index($params){

        header("Content-type: image/jpeg");
        $img = new SimpleImage();
        $img->load($params[0]['val']);
        $img->resizeToWidth($params[1]['val']);
        $img->output();
    }
}