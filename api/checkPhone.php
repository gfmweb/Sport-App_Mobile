<?php


namespace api;


use controllers\TransportController;
use core\controllers\ResponseController;
use models\UserDB;

class checkPhone // Создаем промежуточную запись в своей БД Для Взаимодейтвия пользователя и 1с
{
    public function index ($params = null){
            if(isset($params[0])){
                $RowPhone = $params[0][0];
            }
            $ceil=null;
            for($i=0,$imax=strlen($RowPhone); $i < $imax; $i++){
                    $ceil.= (int)$RowPhone[$i];


            }
            if (strlen($ceil)==11){

                    $PhoneResult = UserDB::FindUserByPhone($ceil);
                    echo'<pre>'.print_r($PhoneResult).'</pre>';
                    new ResponseController([
                       'format'=>'JSON',
                       'DATA'=>$PhoneResult
                    ]);
            }
            else{
                new ResponseController([
                   'format'=>'JSON',
                   'DATA'=>[
                       'status'=>406,
                       'message'=>'Не правильно передан номер телефона'
                   ]
                ]);
            }
    }
}