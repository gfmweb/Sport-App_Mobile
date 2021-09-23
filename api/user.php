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
			elseif ($operation == 'getUserTrainingsByCard'){ // Забрать тренировки пользователя
					if(!isset($params[0][3])){
						new ResponseController([
							'format'=>'JSON',
							'DATA'=>['status'=>404,'message'=>'После указания ID клуба ожидается ID карты пользователя']
						]);
					}
				if(!isset($params[0][2])){
					new ResponseController([
						'format'=>'JSON',
						'DATA'=>['status'=>404,'message'=>'После указания метода ожидается ID клуба']
					]);
				}
					$CardID=$params[0][2];
					$count = rand(8,24); // Количество Элементов тренировок в массиве ответов
					$treners    =   ['trener1.jpg','trener3.jpeg','trener5.jpg'];
					$Titles     =   ['Йога','Силовая','Кардио','Другая'];
					$TrainType  =   ['Индивидуальная','Групповая'];
					$days       =   ['Завтра','16.09','18.09','19.09','20.09','21.09','22.09','23.09','24.09','25.09','26.09','27.09','28.09','29.09'];
					$times      =   ['12:00','14:30','15:30','18:20'];
					$rooms      =   ['Основной зал', 'Левый зал', 'Правый зал'];
					$price      =   [0,900,1200,300,500];
					$discount   =   [0,2,5,10];
					$element    =   [ // Массив одной тренировки
						'TrainingId'=>rand(12,320),
						'Img'=>'content/upload/treners/'.$treners[rand(0,2)],
						'Title'=>$Titles[rand(0,3)],
						'Type'=>$TrainType[rand(0,1)],
						'Remain'=>rand(1,7),
						'Next'=>$days[rand(0,13)],
						'Action'=>'showTraningInfo',
						'Target'=>$token,
						'Time'=>$times[rand(0,3)],
						'Date'=>$days[rand(0,13)],
						'IsRecommended'=>rand(0,1),
						'IsNew'=>rand(0,1),
						'Room'=>$rooms[rand(0,2)],
						'IsPaid'=>rand(0,1),
						'Price'=>$price[rand(0,4)],
						'Discount'=>$discount[rand(0,3)],
						'BalanceOnShop'=>rand(1,5),
						'CategoryId'=>rand(1,4),
						'CategoryName'=>$Titles[rand(0,3)],
						'HasMaster'=>rand(0,1),
						'Masters'=>[
							'MasterId'=>rand(10,43),
							'MasterFirstName'=>'Имя',
							'MasterLastName'=>'Фамилия',
							'MasterPatronymic'=>'Отчество'
						],
						
					];
					$ResponceBody = [];
					for ($i=0; $i <$count; $i++){
						array_push($ResponceBody,$element);
					}
					$response =	[
						'status'=>200,
						'message'=>'Ok',
						'UserTrainings'=>$ResponceBody
					];
					new ResponseController([
						'format'=>'JSON',
						'DATA'=>$response
					]);
			}
            elseif ($operation == 'getUserTrainingByID'){ // Забрать тренировки пользователя

	            if(!isset($params[0][2])){
		            new ResponseController([
			            'format'=>'JSON',
			            'DATA'=>['status'=>404,'message'=>'После указания метода ожидается ID тренировки']
		            ]);
	            }

	            $count = rand(8,24); // Количество Элементов тренировок в массиве ответов
	            $treners    =   ['trener1.jpg','trener3.jpeg','trener5.jpg'];
	            $Titles     =   ['Йога','Силовая','Кардио','Другая'];
	            $TrainType  =   ['Индивидуальная','Групповая'];
	            $days       =   ['Завтра','16.09','18.09','19.09','20.09','21.09','22.09','23.09','24.09','25.09','26.09','27.09','28.09','29.09'];
	            $times      =   ['12:00','14:30','15:30','18:20'];
	            $rooms      =   ['Основной зал', 'Левый зал', 'Правый зал'];
	            $price      =   [0,900,1200,300,500];
	            $discount   =   [0,2,5,10];
	            $element    =   [ // Массив одной тренировки
		            'TrainingId'=>$params[0][2],
		            'Img'=>'content/upload/treners/'.$treners[2],
		            'Title'=>$Titles[2],
		            'Type'=>$TrainType[1],
		            'Remain'=>rand(1,7),
		            'Next'=>$days[3],
		            'Action'=>'showTraningInfo',
		            'Target'=>$token,
		            'Time'=>$times[rand(0,3)],
		            'Date'=>$days[3],
		            'IsRecommended'=>0,
		            'IsNew'=>0,
		            'Room'=>$rooms[1],
		            'IsPaid'=>1,
		            'Price'=>$price[3],
		            'Discount'=>$discount[0],
		            'BalanceOnShop'=>4,
		            'CategoryId'=>1,
		            'CategoryName'=>$Titles[2],
		            'HasMaster'=>1,
		            'Masters'=>[
			            'MasterId'=>10,
			            'MasterFirstName'=>'Имя',
			            'MasterLastName'=>'Фамилия',
			            'MasterPatronymic'=>'Отчество'
		            ],

	            ];
	            $ResponceBody = [];
	            for ($i=0; $i <1; $i++){
		            array_push($ResponceBody,$element);
	            }
	            $response =	[
		            'status'=>200,
		            'message'=>'Ok',
		            'UserTrainings'=>$ResponceBody
	            ];
	            new ResponseController([
		            'format'=>'JSON',
		            'DATA'=>$response
	            ]);
            }
        }
        new ResponseController([
           'format'=>'JSON',
           'DATA'=>['status'=>404,'message'=>'Запрашиваемое свойство не найдено, либо не может быть обработано методом '.$params[0]['REQUEST'],'value'=>null]
        ]);
    }
}