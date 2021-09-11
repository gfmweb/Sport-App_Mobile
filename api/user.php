<?php


namespace api;

use core\controllers\ResponseController;
use models\UserDB;

class user
{
    public function index($params = null){
        if($params[0]['REQUEST']=='POST'){ // Если пишем
            $token = $params[0][0];
            $operation = $params[0][1];
            $new_value = $params[0][2];
            if($operation=='PushToken'){ // Если операция связана с ПушТокеном (обновляем его)
                $responseBody = UserDB::setUserParam(['Token'=>$token,'Param'=>$operation,'Value'=>$new_value]);
                new ResponseController([
                    'format'=>'JSON',
                    'Data'=>$responseBody
                ]);
            }
        }
        elseif($params[0]['REQUEST']=='GET'){ // Если читаем
            $token = $params[0][0];
            $operation = $params[0][1];
            if($operation=='PushToken'){ // Если операция связана с ПушТокеном (читаем его)
               $responseBody = UserDB::getUserParam(['Token'=>$token,'Param'=>$operation]);
                new ResponseController([
                    'format'=>'JSON',
                    'Data'=>$responseBody
                ]);
            }
        }
        new ResponseController([
           'format'=>'JSON',
           'DATA'=>['status'=>404,'message'=>'Запрашиваемое свойство не найдено, либо не может быть обработано методом '.$params[0]['REQUEST'],'value'=>null]
        ]);
    }
}