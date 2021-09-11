<?php


namespace controllers;

use core\controllers\ResponseController;
use core\controllers\SearchController;
use models\UserDB;

class IndexController
{
    public function index(){


        new ResponseController([

                                        'title'=>'Вход',
                                        'CSS'=>'index',
                                        'JS'=>'index',
                                        'NavbarSearch'=>false,
                                        'PAGE'=>'Главная'
                               ]);
    }
}