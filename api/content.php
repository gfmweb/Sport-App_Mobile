<?php

namespace api;
// api/content/TOKEN/getNewsInfo/ClubID/NewsID
use core\controllers\ResponseController;

class content
{
	public function index($params = null){
		$full = count($params[0]);
		if($full<3){
			new ResponseController([
			'format' => 'JSON',
			'data' => [
				'status' => 400,
				'message' => 'Bad request!!!  api/content/TOKEN/getNewsInfo/ClubID/NewsID',
				]
			]);
		}

		$token = $params[0][0];
		$operation = $params[0][1];
		$clubID = $params[0][2];
		$news_id = $params[0][3];
		if($operation == 'getNewsInfo') {
			$Images = ['1.jpg','2.jpg','3.jpg'];
			$Clubs = [['name'=>'Аквитания','id'=>'27812b67-2ccc-11e9-a48d-0050568bd50c'],['name'=>'Нефть','id'=>'037e7313-3676-11e9-983e-0050568bd50c'],['name'=>'Пушкин','id'=>'7dbb2b23-338d-11e9-983e-0050568bd50c']];
			foreach ($Clubs as $club){
				if($club['id']==$clubID){
					$title = 'Новость от клуба '.$club['name'];
				}
			}
			new ResponseController([
				'format' => 'JSON',
				'data' => [
					'status' => 200,
					'message' => 'OK',
					'length' => 1,
					'total' => 1,
					'Img' => '/content/upload/clubs/'.$Images[rand(0,2)],
					'Title' => $title,
					'Text' => 'Вы запросили новость ID: '.$news_id.PHP_EOL.'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dapibus ultrices in iaculis nunc sed augue lacus viverra vitae. Cras tincidunt lobortis feugiat vivamus at. Nullam non nisi est sit amet facilisis magna etiam. Sagittis purus sit amet volutpat. Et malesuada fames ac turpis. Amet consectetur adipiscing elit pellentesque habitant morbi tristique senectus. Sodales ut eu sem integer vitae justo eget. Habitant morbi tristique senectus et. Imperdiet massa tincidunt nunc pulvinar sapien et ligula. Vulputate eu scelerisque felis imperdiet proin. Egestas erat imperdiet sed euismod nisi. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Elementum sagittis vitae et leo duis ut diam quam. At imperdiet dui accumsan sit amet nulla facilisi morbi. Viverra vitae congue eu consequat ac felis. Nunc sed blandit libero volutpat sed cras. Vestibulum rhoncus est pellentesque elit. Ut consequat semper viverra nam libero.'
				]
			]);
		}
	}

}