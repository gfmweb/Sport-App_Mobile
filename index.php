<?php
/**
 * Точка входа в приложение
 *
 */

use core\controllers\RouteController; // Задействуем контроллер роутинга
//require 'core/controllers/ResponseController.php'; // Задействуем контроллер Ответов
//require 'core/controllers/RouteController.php'; // Задействуем контроллер Роутинга
use core\controllers\ResponseController;

session_start(); // Начало работы с Сессией
$InitParams =  require 'config/maincfg.php'; // Чтение основных установочных параметров
// Подключение глобальных функци
require 'core/core_functions/build_const.php'; // Функция определения констант
// Подключение глобальных функци
// ОПРЕДЕЛЕНИЕ КОНСТАНТ
$ParamsKEYS = array_keys($InitParams); // Определение ключей конфига
for($i=0,$imax=count($ParamsKEYS); $i < $imax; $i++){ // По всем разделам конфига
    foreach ($InitParams[$ParamsKEYS[$i]] as $key=>$val){ // Каждое значение раздела с ключом
        build_const( $ParamsKEYS[$i].'_'.$key,$val); // Определение константы
    }
}
// ОПРЕДЕЛЕНИЕ КОНСТАНТ

// Отображение ошибок и предупреждений в зависимости от режима работы APP
if(APP_Mode == 'DEV'){
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}
// Отображение ошибок и предупреждений в зависимости от режима работы APP


// Автозагрузчик классов
spl_autoload_register(function($className)
    {
        $pieces = explode("\\",$className);

        $requirestring = $pieces[0]."/";
        if($requirestring!=='api') { // Если мы работаем с обычными контроллерами
            for ($i = 1, $imax = count($pieces) - 1; $i < $imax; $i++) {
                $requirestring .= $pieces[$i] . "/";
            }
            $requirestring .= $pieces[count($pieces) - 1] . '.php';
            if (file_exists($requirestring)) { // проверка существования контроллера
                require_once($requirestring);
            } else { // Заглушка 404 в случае отсутствия обслуживающего контроллера передаем тайтл описание и возможные действия
                header("HTTP/1.0 404 Not Found");
                header('Access-Control-Allow-Origin: *');
                header("Content-type: application/json; charset=utf-8");
                $response = array('status' => 'failss', 'errors' => 'Не найден контроллер');
                die(json_encode($response, JSON_UNESCAPED_UNICODE));
            }
        }
        else{
            die('Bingo');
        }
    }
    );

// Имплементация

$route = new RouteController($_REQUEST); // Подготовка к инициализации приложения --- парсинг запроса
// Исполнение приложения
$implement_controller = new $route->controller; // Вызов контроллера
// Проверка на принадлежностть класса вызываемого контроллера к классу унаследованного от Magic
$check_magic=get_parent_class($implement_controller); // Запрос родителя
if($check_magic==="core\Magic"){ // Если контроллер является наследником Магического класса
    $implement_controller->index($route->method,$route->requests); // Передаем ему параметром запрашиваемй метод и запрос на его метод Index
}
else{
    $method=$route->method; // Запись метода контроллера
    if(method_exists($implement_controller,$method)){ // Проверка существования метода этого контроллера
        $implement_controller->$method($route->requests); // Вызов метода контроллера и передача методу всех параметров запроса
    }
    else{ // Заглушка страницы не сушествует т.к. был вызван несуществующий метод контроллера передаем тайтл описание и возможные действия
        header("HTTP/1.0 404 Not Found");
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");
        $response = array('status'=>'fail','errors'=>'Не найден такой метод у этого контроллера');
        die(json_encode($response,JSON_UNESCAPED_UNICODE));

    }
}


