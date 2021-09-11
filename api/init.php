<?php


namespace api;


use core\controllers\ResponseController;
use models\UserDB;

class init
{
    public function index ($params = null)
    {


       if(isset($params[0][0])){
           $User = UserDB::GetUserBYToken($params[0][0]);
            if(!$User) {
                new ResponseController([
                    'format' => 'JSON',
                    'data' => [
                        'status' => 404,
                        'message' => 'Пользователь не найден - Брысь на регистрацию!',
                        'length' => 0,
                        'total' => 0,
                    ]]);
            }
            else{ // Пользователь найден проверяем стандартные требования
                $User = require 'common.php';

                if(is_null($User['Name'])){
                    $User['Name']='Иван';
                }
                if(is_null($User['Patronymic'])){
                    $User['Patronymic']='';
                }
                if(is_null($User['LastName'])){
                    $User['LastName']='';
                }
                if(is_null($User['Birthday'])){
                    $User['Birthday']='';
                }
                @$User['Notification'] = json_decode($User['Notification'],true);
                @$User['UserCards'] = json_decode($User['UserCards'],true);
                @$User['Cart'] = json_decode($User['Cart'],true);
                if(is_null($User['Notification'])){
                    $User['Notification'] =[];
                }
                if(is_null($User['UserCards'])){
                    $User['UserCards'] =[];
                }
				$clubs =1;
	            $trainy =3;
                new ResponseController([
                    'format' => 'JSON',
                    'data' => [
                        'status' => 200,
                        'message' => 'OK',
                        'length' => 5,
                        'total' => 5,
                        'UserInfo' => [
                            'UserName' => 'Иван',
                            'UserPatronymic' => $User['Patronymic'],
                            'UserLastname' => $User['LastName'],
                            'UserAvatar' => 'content/upload/avatars/User001.jpeg',
                            /*'UserQRCode'=>'/QR?data=p-sport-612894444a0451.85503243',*/
                            'UserNotifications' => [
	                            'HasNew'=>1

                            ],
                            'UserClubs'=>[
                                'length' => $clubs,//,count($User['UserCards']),
                                'Body'=>//$User['UserCards'],
                                [
                                    [
                                        'Title'=>'Пушкин',
                                        'ClubID'=>'7dbb2b23-338d-11e9-983e-0050568bd50c',
                                        'CardIMG'=>'/content/upload/clubs/7dbb2b23-338d-11e9-983e-0050568bd50c.jpg',
	                                    "cardFrozenType"=> 1,
                                        "dayFreeze"=> 24,
										'CardID'=>'601b0180-2ccd-11e9-a48d-0050568bd50c',
                                        'UserMember' => 1,
										'CardType'=>'Time',
										'IsCardFrozen'=>0,
                                        'UserMemberExpire' => '30.09.2021',
                                        'UserBalance' => 2000 ,//$User['Balance'],
                                        'UserBonus' => 0,
                                        'UserDiscount' => 0
                                    ],


                                ],
                                'ActiveClub'=>$User['Active_CLUB']['id'],
                            ],


                            'UserSex' => 'Male',
                            'UserBirthday' =>  $User['Birthday'],


                            
                        ],
                        'UserContent' => [

                            'HeaderSlider' => [
                                'Title' => 'Доступно бесплатно',
                                'Explode' => 1,
                                'ExplodeText' => 'Все',
                                'length'=>5,
                                'Body' => [
                                    ['Img' => '/content/upload/food/1.jpeg',
                                        'Text' => 'План питания на неделю', 'Action' => 'action1',
                                        'Target' => 'p-sport-612894444a0451.85503243'
                                    ],
                                    ['Img' => '/content/upload/food/2.jpg',
                                        'Text' => 'Тренировки', 'Action' => 'action2',
                                        'Target' => 'p-sport-612894444a0451.85503243'
                                    ],
                                    ['Img' => '/content/upload/food/3.jpg',
                                        'Text' => 'Консультации тренера', 'Action' => 'action3',
                                        'Target' => 'p-sport-612894444a0451.85503243'
                                    ],
                                    ['Img' => '/content/upload/food/4.jpg',
                                        'Text' => 'Бассейн', 'Action' => 'action4',
                                        'Target' => 'p-sport-612894444a0451.85503243'
                                    ],
                                    ['Img' => '/content/upload/food/5.jpg',
                                        'Text' => 'Боже! У меня фантазия кончилась', 'Action' => 'action5',
                                        'Target' => 'p-sport-612894444a0451.85503243'
                                    ],
                                ]
                            ],
                            'MainContent' => [
                                'Title' => 'Новости',
                                'Explode' => 0,
                                'ExplodeText' => '',
                                'length'=>5,
                                'Body' => [
                                    [   'id'=>2,
                                        'Img' => '/content/upload/food/n1.jpg',
                                        'Text' => 'Тестовая новость 20.06.2021 Всем',
                                        'Target' => 'p-sport-612894444a0451.85503243',
                                        'Action'=>'ShowStandartContentBlock'
                                    ],
                                    [   'id'=>3,
                                        'Img' => '/content/upload/food/n2.jpg',
                                        'Text' => 'Чем то делимся 27.07.2021',
                                        'Target' => 'p-sport-612894444a0451.85503243',
                                        'Action'=>'ShowStandartContentBlock'
                                    ],
                                    [   'id'=>4,
                                        'Img' => '/content/upload/food/n3.jpg',
                                        'Text' => 'Чем то делимся 27.07.2021 Всем',
                                        'Target' => 'p-sport-612894444a0451.85503243',
                                        'Action'=>'ShowStandartContentBlock'
                                    ],
                                    [   'id'=>5,
                                        'Img' => '/content/upload/food/n4.jpg',
                                        'Text' => 'Достижения 2020 Всем',
                                        'Target' => 'p-sport-612894444a0451.85503243',
                                        'Action'=>'ShowStandartContentBlock'
                                    ],
                                    [   'id'=>6,
                                        'Img' => '/content/upload/food/n5.jpg',
                                        'Text' => 'Персонализировано по целям для p-sport-612894444a0451.85503243',
                                        'Target' => 'p-sport-612894444a0451.85503243',
                                        'Action'=>'ShowStandartContentBlock'
                                    ],
                                ]
                            ],
                        ],
                        'UserStatistic' => [
                            'UserStatisticText' => 'Собираем статистику',//'Идете хорошо! Продолжайте в том же духе! 👍',
                            'UserStatisticCurrent' => 0,
                            'UserStatisticBefore' => 0,
                            'UserStatisticBest' => 0
                        ],
                        'UserTrainingsCalendar' => [
                            'length' => $trainy,
                            'Body' => [
                                ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Танцы', 'Type' => 'Групп', 'Remain' => 4, 'Next' => date('d.m', strtotime('+1 day')), 'Action' => 'TrainingsDance','Target' => 'p-sport-612894444a0451.85503243' ],
                                ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Борьба', 'Type' => 'Индивид', 'Remain' => 2, 'Next' => 'Не указано', 'Action' => 'TrainingsFighting', 'Target' => 'p-sport-612894444a0451.85503243'],
                                ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Плавание', 'Type' => 'Групп', 'Remain' => 5, 'Next' => date('d.m', strtotime('+4 day')), 'Action' => 'TrainingsSwimming', 'Target' => 'p-sport-612894444a0451.85503243'],
                                ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Йога', 'Type' => 'Групп', 'Remain' => 6, 'Next' => date('d.m', strtotime('+6 day')), 'Action' => 'TrainingsYoga', 'Target' => 'p-sport-612894444a0451.85503243'],
                                ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Легкая атлетика', 'Type' => 'Групп', 'Remain' => 2, 'Next' => date('d.m', strtotime('+16 day')), 'Action' => 'TrainingsAthletics', 'Target' => 'p-sport-612894444a0451.85503243'],
                                ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Тяжелая атлетика', 'Type' => 'Групп', 'Remain' => 1, 'Next' => date('d.m', strtotime('+18 day')), 'Action' => 'TrainingsWeightlifting', 'Target' => 'p-sport-612894444a0451.85503243'],
                                ['Img' => '/content/upload/avatars/ios.jpg','Title' => 'Плавание', 'Type' => 'Групп', 'Remain' => 5, 'Next' => date('d.m', strtotime('-6 day')), 'Action' => 'TrainingsSwimming', 'Target' => 'p-sport-612894444a0451.85503243'],
                            ]
                        ]
                    ],
                    'errors' => null

                ]);


            }
       }
       else{
           new ResponseController([
               'format' => 'JSON',
               'data' => [
                   'status' => 403,
                   'message' => 'Кто-то вообще забыл передать мне токен! ',
                   'length' => 0,
                   'total' => 0,
               ]]);
       }

    }
}