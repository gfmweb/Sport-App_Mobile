<?php
/**
 *  Принимает массив 'query'=>'Поисковой запрос','table'=>'файл с отдельными таблицами и настройками для обработки поиска если его нет то используется файл по умолчанию'
 *  Поиск происходит по принципу %LIKE%
 *  Возврашает массив Таблица=>массивы результатов по таблице
 *  В случае отсутствия результатов в таблице Не возвращает пустые Результаты по таблицам
 */

namespace core\controllers;


use core\db\CRUD;

class SearchController
{
    public static function Find($config){
            $query ='';
            $table ='config/search.php';
            foreach ($config as $key=>$value){
                if(mb_strtolower($key)=='query'){$query=$value;}
                if(mb_strtolower($key)=='table'){$table='config/search_'.$value.',php';}
            }
            $config = require $table; // Подключаем конфигурацию таблиц и полей в которых будем искать
            $Tables = array_keys($config); // Определяем таблицы в которых будет происходить поиск


            $DB = new CRUD($Tables[0]);
            $SearchResult=[];
            $Response=[];
            $ColumnStr='';
            $WHERESTR ='';
            foreach ($Tables as $table){
                foreach ($config[$table] as $col){
                    if($col[strlen($col)-1]=='*'){
                        $col = mb_substr($col,0,-1);
                    }
                    $ColumnStr.=$table.'.'.$col.' as '.$table.'_'.$col.', '; // Подготовка колонок для выборки
                }
                $ColumnStr = mb_substr($ColumnStr, 0, -2);
                foreach ($config[$table] as $col) {
                    if ($col[strlen($col) - 1] == '*') {
                        continue;
                    } else {
                        $WHERESTR .= '(' . $table . '.' . $col . ' LIKE \'%' . $query . '%\') OR '; // Подготовка колонок для выборки
                    }
                }
                $WHERESTR = mb_substr($WHERESTR, 0, -3);
                $str = 'SELECT '.$ColumnStr.' FROM '.$table.' WHERE '.$WHERESTR;
                $result = $DB->FreeInfo($str,[])->Resulting;
                $ColumnStr='';
                $WHERESTR ='';
                $SearchResult[$table]=$result;
            }
            foreach ($SearchResult as $key=>$value){
                if(isset($value[0])){
                    $Response[$key] = $value;
                }
            }
        return $Response;
    }
}