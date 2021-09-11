<?php
/**
 * Контроллер ответа вызывается для отправки / рендера ответа сервера
 *
 * Format - Формат ответа (WEB с рендером template & view || JSON) по умолчанию берется значение из maincfg
 * APP_Name
 * APP_Language
 * APP_Curency
 * Mode - переключает значение подключения VUE компонента
 * Title - Для страницы в рендере
 * CSS - Дополнительный пользовательский CSS для страницы
 * JS - пользовательский JS для работы
 * Template - шаблон
 * View - вид который будет подключен в шаблоне
 * VUE - Вариант подключения дистрибутива VUE
 * DATA - Передаца контентной части
 * Navbar - переменная определяюшая какой навбар нужно использовать
 * NavbarSearch - определение будет ли использован поиск в навбаре
 */

namespace core\controllers;


use core\builders\NavbarBuilder;

class ResponseController
{
    public  $Format          = DEFAULT_Format;
    public  $APP_Name        = APP_Name;
    public  $APP_Language    = APP_Language;
    public  $APP_Curency     = APP_Curency;
    public  $Mode            = APP_Mode;
    public  $Title           = APP_Name;
    public  $CSS             = null;
    public  $JS              = null;
    public  $Template        = 'template/template.php';
    public  $View            = 'view/default.php';
    public  $VUE             = '<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>';
    public  $DATA            =  null;
    public  $Navbar          = 'public';
    public  $NavbarSearch    =  false;
    public  $ActivePage      =  null;

    public function __construct($config = null){
        if(!is_null($config)) {
            foreach ($config as $key => $value) {
                if (mb_strtolower($key) == 'format') {$this->Format = $value;}
                if ((mb_strtolower($key) == 'app_name') || ($key == 'name')) {$this->APP_Name = $value;}
                if ((mb_strtolower($key) == 'app_language') || ($key == 'language')) {$this->APP_Language = $value;}
                if ((mb_strtolower($key) == 'app_curency') || ($key == 'curency') || ($key == 'Curency')) {$this->APP_Curency = $value;}
                if (mb_strtolower($key) == 'title')  {$this->Title = $value;}
                if (mb_strtolower($key) == 'css')  {$this->CSS = '<link rel="stylesheet" href="assets/users/css/' . $value . '.css">';}
                if (mb_strtolower($key) == 'js')  {$this->JS = '<script src="assets/users/js/' . $value . '.js"></script>';}
                if (mb_strtolower($key) == 'template')  {$this->Template = 'template/'.$value.'.php';}
                if (mb_strtolower($key) == 'view') {$this->View = 'view/'.$value.'.php';}
                if (mb_strtolower($key) == 'data')  {$this->DATA =  $value;}
                if (mb_strtolower($key) == 'navbar')  {$this->Navbar =  $value;}
                if (mb_strtolower($key) == 'navbarsearch')  {$this->NavbarSearch =  $value;}
                if (mb_strtolower($key) == 'page')  {$this->ActivePage =  $value;}
            }
        }
        if($this->Mode!=='DEV'){
            $this->VUE='<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>';
        }
        if($this->Format=='WEB'){ // Построение WEB части ответа
            $nav = new NavbarBuilder($this->Navbar,$this->NavbarSearch,$this->APP_Name,$this->ActivePage);
            $this->Navbar = $nav->render();
            include $this->Template;
        }
        elseif($this->Format == 'JSON'){ // Ответ в JSON
            header('Access-Control-Allow-Origin: *');
            header("Content-type: application/json; charset=utf-8");
            die(json_encode($this->DATA,JSON_UNESCAPED_UNICODE));
        }
    }
}