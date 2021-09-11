<?php

namespace api;

use core\controllers\ResponseController;
use models\UserDB;

class authorization
{
    public function index($params = null){ // ринимает номер телефона - возвращает результат отправки кода
        $phone = null;
        $method = null;

        if(isset ($params[0][0])){ //Если у нас определен метод
            if($params[0][0]=='getCode'){ // Если у нас запросили код
                if(isset($params[0][1])){ // Если у нас есть строка телефона
                    $phone = $params[0][1];
                    // Проверка валидности номера телефона
                    $phone = str_replace('(','',$phone);
                    $phone = str_replace(')','',$phone);
                    $phone = str_replace('+','',$phone);
                    $phone = str_replace('-','',$phone);
                    $phone = str_replace(' ','',$phone);
                    if($phone[0]==8){
                        $phone[0]=7;
                    }
                    $phonelength=strlen($phone);
                    if($phonelength == 11){
                        // Пререгистрация телефона
                        $redis = new \Redis();
                        $redis->connect('127.0.0.1',6379);
                        $redis->select(10);
                        if($redis->exists($phone)){
                            $responsePhone = json_decode($redis->get($phone),true);
                            $redis->close();
                            new ResponseController([
                                'format' => 'JSON',
                                'data' => [
                                    'format'=>'JSON',
                                    'DATA'=>[
                                        'status'=>200,
                                        'message'=>'Код уже был отправлен Повторно получить код можно через '.$responsePhone['Exp']-time().' секунд',
                                        'length'=>0
                                    ]
                                ]
                            ]);
                        }
                        else{
                            $SMSCode = rand(1111,1111);
                            $SetData = json_encode(['Register'=>time(),'Exp'=>time()+180,'SMSCode'=>$SMSCode]);
                            $redis->set($phone,$SetData,180);
                            new ResponseController([
                                'format' => 'JSON',
                                'data' => [
                                    'format'=>'JSON',
                                    'DATA'=>[
                                        'status'=>200,
                                        'message'=>'Код отправлен по SMS, пожалуйста, ожидайте'.$SMSCode,
                                        'length'=>0
                                    ]
                                ]
                            ]);
                        }
                    }
                    else{
                        new ResponseController([
                            'format' => 'JSON',
                            'data' => [
                                'format'=>'JSON',
                                'DATA'=>[
                                    'status'=>400,
                                    'message'=>'Телефон имеет некорректную длину',
                                    'length'=>0
                                ]
                            ]
                        ]);
                    }
                }
                else{
                    new ResponseController([
                        'format' => 'JSON',
                        'data' => [
                            'format'=>'JSON',
                            'DATA'=>[
                                'status'=>400,
                                'message'=>'Не передан номер телефона',
                                'length'=>0
                            ]
                        ]
                    ]);
                }
            }

            if($params[0][0]=='checkCode'){ // Если у нас запросили код
                if(isset($params[0][1])){ // Если у нас есть строка телефона
                    $phone = $params[0][1];
                    // Проверка валидности номера телефона
                    $phone = str_replace('(','',$phone);
                    $phone = str_replace(')','',$phone);
                    $phone = str_replace('+','',$phone);
                    $phone = str_replace('-','',$phone);
                    $phone = str_replace(' ','',$phone);
                    if($phone[0]==8){
                        $phone[0]=7;
                    }
                    $phonelength=strlen($phone);
                    if($phonelength == 11){
                        // Пререгистрация телефона
                        $redis = new \Redis();
                        $redis->connect('127.0.0.1',6379);
                        $redis->select(10);
                        if($redis->exists($phone)){
                            $responsePhone = json_decode($redis->get($phone),true);
                            $redis->close();
                            $SMSCode = $responsePhone['SMSCode'];
                            // Проверяем пришел ли код подтверждения
                            if(isset($params[0][2])){ // Код пришел
                                if($params[0][2]==$SMSCode){
                                    $Bearer = uniqid('p-sport-',true);
                                    UserDB::CreateUpdateUser($phone,$Bearer); // Записали /Апдейтнули БД
                                    new ResponseController([
                                        'format' => 'JSON',
                                        'data' => [
                                            'format'=>'JSON',
                                            'DATA'=>[
                                                'status'=>200,
                                                'message'=>'Всё хорошо Пользователь был верифицирован ',
                                                'length'=>1,
                                                'content'=>[
                                                    'userToken'=>$Bearer
                                                ]
                                            ]
                                        ]
                                    ]);
                                }
                                else{
                                    new ResponseController([
                                        'format' => 'JSON',
                                        'data' => [
                                            'format'=>'JSON',
                                            'DATA'=>[
                                                'status'=>400,
                                                'message'=>'Неверный код подтверждения',
                                                'length'=>0
                                            ]
                                        ]
                                    ]);
                                }
                            }
                            else{
                                new ResponseController([
                                    'format' => 'JSON',
                                    'data' => [
                                        'format'=>'JSON',
                                        'DATA'=>[
                                            'status'=>400,
                                            'message'=>'Код подтверждения не был передан',
                                            'length'=>0
                                        ]
                                    ]
                                ]);
                            }

                        }
                        else{
                            new ResponseController([
                                'format' => 'JSON',
                                'data' => [
                                    'format'=>'JSON',
                                    'DATA'=>[
                                        'status'=>400,
                                        'message'=>'Время отведенное на регистрацию истекло повторите начало регистрации',
                                        'length'=>0
                                    ]
                                ]
                            ]);
                        }
                    }
                    else{
                        new ResponseController([
                            'format' => 'JSON',
                            'data' => [
                                'format'=>'JSON',
                                'DATA'=>[
                                    'status'=>400,
                                    'message'=>'Телефон имеет некорректную длину',
                                    'length'=>0
                                ]
                            ]
                        ]);
                    }
                }
                else{
                    new ResponseController([
                        'format' => 'JSON',
                        'data' => [
                            'format'=>'JSON',
                            'DATA'=>[
                                'status'=>400,
                                'message'=>'Не передан номер телефона',
                                'length'=>0
                            ]
                        ]
                    ]);
                }
            }
        }


    }
}