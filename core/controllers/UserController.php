<?php
/**
 * Часть ядра отвечающая за сущность USER
 * Logined - Статичный метод проверяющий залогинен ли наш пользователь
 * UserInfo - Статичный метод возвращающий информацию по пользователю
 *
 */

namespace core\controllers;


class UserController
{
    public static function Logined(){
        if(!isset($_SESSION['LOGIN'])||($_SESSION['LOGIN']===false)){
            return false;
            }
        else{
            return true;
        }
    }

    public static function UserInfo($info='all'){
        if($info == 'img'){
            if((isset($_SESSION['USER']['INFO']['img']))&&(!is_null($_SESSION['USER']['INFO']['img']))){
                $result =  $_SESSION['USER']['INFO']['img'];
            }
            else{
                $result =  '/assets/img/usericon.png';
            }
        }
        return $result;
    }

    public static function CreateUser($config = []){
        foreach ($config as $key=>$value){
            $_SESSION[$key] = $value;
            $_SESSION['LOGIN'] = true;
        }
    }
}