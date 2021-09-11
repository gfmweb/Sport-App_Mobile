<?php


namespace controllers;


use core\controllers\ResponseController;
use core\controllers\UserController;
use models\Orders;

class LkController
{
    public function index(){
        if(UserController::Logined()){
            new ResponseController(
                [
                    'title'=>'Заказы '.date('d-m-Y'),
                    'JS'=>'orders',
                    'NavbarSearch'=>false,
                    'PAGE'=>'Заказы',
                    'view'=>'LK/index'
                ]
            );
        }
    }

    public function getOrders(){
        new ResponseController(['format'=>'JSON','data'=>Orders::getDayOrders()]);
    }

    public function logout(){
        session_destroy();
        header('Location: /');
    }
}