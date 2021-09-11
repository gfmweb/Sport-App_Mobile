<?php


namespace controllers;

use core\controllers\ResponseController;
use core\controllers\LoginCoreController;
use core\controllers\UserController;

class LoginController
{
    public function InitRegistration(){
        new ResponseController(['format'=>'JSON','DATA'=>LoginCoreController::InitRegistration()]);
    }

    public function AdminLogin($params = null){
        $request=[];
        foreach ($params as $param){
            if(isset($param['param'])){
                $incomeDATA[$param['param']]=$param['val'];
                array_push($request,$incomeDATA);
            }

        }

        if($request[0]['password']==ADMIN_Password){
            UserController::CreateUser(['role'=>'Admin']);
            header('Location: /Lk');
        }
        else{
            session_destroy();
            header('Location: /');
        }

    }
}