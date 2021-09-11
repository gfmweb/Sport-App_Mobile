<?php

	namespace api;

	use models\UserDB;

	class delete
	{
		public function index($params = null){
			$phone = $params[0][0];
			UserDB::removeUser($phone);
		}
	}