<?php

	namespace api;

	use core\controllers\ResponseController;

	class card
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
			if (isset($params[0][2])){
				$card = $params[0][2];
			}
			if(is_null($user)||is_null($club)||is_null($card)){
				new ResponseController([
				'format'=>'JSON',
				'DATA'=>[
					'status' => 400,
					'message' => 'Переданы не все данные! Ожидается /токен/клуб/карта ',
					'length' => 0,
				]
				]);
			}
			else{
				//todo Проверка на наличие у пользователя карты этого клуба
				new ResponseController([
				'format'=>'JSON',
				'DATA'=>[
					'status' => 200,
					'message' => 'Ok',
					'length' => 1,
					'total' => 1,
					'Card'=>[
						'Cardid'=>md5('clubID+CARDID+UserContractID'),
						'CardType'=>'Time',
						'CardNumber'=>1234567890,
						'Clubid'=>$club,
						'CardIMG'=>'/content/upload/clubs/1.jpg',
						'UserBalance'=>250,
						'UserBonus'=>0,
						'UserDiscount'=>0,
						'UserMember'=>1,
						'UserMemberExpire'=>'30.12.2021',
						'CardFrozenType'=>1,
						'IsCardFrozen'=>0,
						'DayFreeze'=>24,
						'PucshaseDate'=>'01.01.2021',
						'Contract'=>'/content/upload/clubs/7dbb2b23-338d-11e9-983e-0050568bd50c.pdf',
						]
					]
				]);
			}

		}
	}