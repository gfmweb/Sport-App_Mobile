<?php

namespace api;

use core\controllers\ResponseController;

class clubs
{
	public function index($params = null){
		$user = null;
		$club = null;
		$card = null;
		if (isset($params[0][0])) {
			$user = $params[0][0];
		}
		if (isset($params[0][1])){
			$club = $params[0][1];
		}

		if(is_null($user)||is_null($club)){
			new ResponseController([
				'format'=>'JSON',
				'DATA'=>[
					'status' => 400,
					'message' => 'Переданы не все данные! Ожидается /токен/клуб',
					'length' => 0,
				]
			]);
		}
		else{

			new ResponseController([
				'format'=>'JSON',
				'DATA'=>[
					'status' => 200,
					'message' => 'Ok',
					'length' => 1,
					'total' => 1,
					'ClubInfo'=>[
						'ClubImageS'=>['/content/upload/clubs/1.jpg','/content/upload/clubs/2.jpg','/content/upload/clubs/3.jpg'],
						'ClubTitle'=>'Пушкин',
						'ClubDescription'=>'Некоторый очень своеобразный дескрипшн клуба Мыслей нет поэтому пишем всякую галиматью. Самое главное чтобы это было видно в APP ну а остальное вообще не важно! В общем дальше просто Lorem ipson dolor sit amet',
						'ClubText'=>'Ангелы проживают
										в своих облаках роскошных.
										Дотуда не докричаться.
										Оттуда не дозвониться.
										А радость они посылают
										людям в собаках и кошках.
										В собаках быстрей доходит.
										В кошках дольше хранится.
										
										Если вы поссорились и ваша девушка вас игнорирует,
Попробуйте тихонько сесть рядом и, глядя в пол, сказать:
— Слушай, я давно хотел тебя спросить.
Я мечтал откровенно поговорить с тобой об одной вещи.
Поднимите глаза вверх — в потолок, подержите паузу и, решившись, закончите.
— Хотя, нет.
Еще рано.
Уходите!

 У лося (детской игрушки) оторвались рога.
После дюжины неудачных попыток заставить мужа их приклеить, жена сидит — приделывает их сама.
Муж проходит мимо — и без всякой задней мысли ей:
— Милая, чем это ты тут занимаешься?
Она, с железной ноткой в голосе:
— Да вот, для начала на лосях потренируюсь.
',
						'ClubAddress'=>'г. Уфа ул Пушкина 45/2',
						'ClubCoordinates'=>'54.72528928854555, 55.93222086421884',
                        'ClubLatitude'=>'54.72528928854555',
                        'ClubLongitude'=>'55.93222086421884',
						'ClubSite'=>'http://personasport.ru/',
						'ClubInstagramLink'=>'https://www.instagram.com/pushkinfitness/'
					]
				]
			]);
		}

	}
}