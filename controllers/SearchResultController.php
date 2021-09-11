<?php
/**
 *  Контроллер обрабатывающий поисковые запросы
 *
 */

namespace controllers;
use core\controllers\ResponseController;
use core\controllers\SearchController;
class SearchResultController
{
    public function Navbar($params = null){ // Метод обработки поисковых запросов из навигационной панели
        $len=0;
        if(isset($params[0]['val'])) {
            $len = strlen($params[0]['val']);
        }
            $clear = [];
            if ($len > 2) { // Если длина запроса > 2х символов
                $find = SearchController::Find(['query'=>$params[0]['val']]);
                $findResults = [];
                    foreach ($find as $el){
                        foreach ($el as $item){
                            array_push($findResults,$item);
                        }
                    }
                if ($find === $clear) {
                    new ResponseController(['format' => 'JSON', 'DATA' => ['status' => 'nothing to show', 'data' => null]]);
                } else {
                    new ResponseController(['format' => 'JSON', 'DATA' => ['status' => 'success', 'data' => $findResults]]);
                }
            }
        else {
            new ResponseController(['format'=>'JSON','DATA'=>['status'=>'too short','data'=>null]]);
        }
    }

    public function show ($params = null){

    }
}