<?php
/**
 *
 * Контроллер роутинга Принимает запрос и подготавливает структуру вызова контроллера и его метода
 *
 */

namespace core\controllers;




class RouteController
{
    /**
     * controller - Имя запрашиваемого контроллера
     * method - Имя запрашиваемого метода
     * requests - параметры запроса (Нумерованный массив с полями PARAM и VAL)
     */
    public $controller;
    public $method;
    public $requests;

    public function __construct($req) // Парсинг строки запроса с выделением контроллеров - действий контроллера  входящих параметров не зависимо от метода их передачи
    {
        // Действие 1 выделение контроллера и его метода работа с ключом url
        if(isset($req['url'])){ // Действия при указании контроллера и возможно его метода
            $cont_act = explode ("/",$req['url']); // Разбиение массиваа
            if($cont_act[0]=='api'){
                   $this->controller = 'api\\'.$cont_act[1];
                   $this->method     = 'index';
                   for ($i=2, $imax=count($cont_act); $i < $imax; $i++){
                       $arr[]=$cont_act[$i];
                   }
                   unset($req['url']); // Очистка массива от ключа контроллер / метод
            }
            else {
                $this->controller = 'controllers\\' . $cont_act[0] . 'Controller'; // получили контроллер
                if (isset($cont_act[1])) { // Действия при наличии указанного метода
                    $this->method = $cont_act[1];
                } else { // Действие при отсутствии указанного метода
                    $this->method = 'index';
                }
                unset($req['url']); // Очистка массива от ключа контроллер / метод
            }
        }
        else{ // Действие по умолчанию без указания контроллера и метода
            $this->controller='controllers\\IndexController';
            $this->method='index';
        }
        // Действие 2 извлечение массива ключей и их значений при входящем запросе
        $keys=array_keys($req);//Сбор ключей массива

        foreach ($keys as $iValue) { // Создание нумерованного массива запросов
            $temp['param']= $iValue;  // Запись имени параметра
            $temp['val']=$req[$iValue]; // Запись значения параметра
            $temp['val']=trim($temp['val']); // Удаление пробелов
            $temp['val']=htmlspecialchars($temp['val']); // Экранирование метатегов

            if($temp['val']!=='') // Если есть ключ и значение тогда записываем в массив
            {
                $this->requests[] = $temp; // объединение в нумерованный массив
            }
            unset($temp); // Очистка временного массиваа
        }
        if(isset($_FILES)){ // Если с формы пришли файлы
            foreach ($_FILES as $key=>$val) // перебираем массив пришедших файлов
            {
                $temp['FILES']=$val; // Задаем ключ - Имя формы
                $this->requests[] = $temp; // Дописываем в Реквест
            }
        }
        foreach (getallheaders() as $name => $value) {
            if($name=='Authorization') {
                $temp['Authorization']=str_replace('Bearer ','',$value);
                $this->requests[] = $temp;
            }
        }
        $arr['REQUEST']=$_SERVER['REQUEST_METHOD'];
        $this->requests[]=$arr;
    }
}