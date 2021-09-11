<?php

/**
 *  Singletone класс подключения к БД
 *  PDO
 */

namespace core\db;

use PDO;

class Db
{

    private $_connection;
    private static $_instance;
    private static $_con;

    public static function init()
    {
        if (!self::$_instance) { // Ели у нас нет ни одного подключения к БД тогда создаем его
             self::$_instance = new self();  // Вызываем приватный метод конструктора
             self::$_con = self::$_instance->_connection; // Передаем в приватное свойство идеинтификатор подключения к БД
        }
        return self::$_con; // Возвращаем Идеинтификатор
    }


    private function __construct() // приватный метод конструктора
    {
       // require_once 'config/config.php'; // Запрашиваем config с данными для подключения к БД
        $dsn = "mysql:host=".DB_Host.";dbname=".DB_Base.";charset=".DB_CharSet;
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Принцип обработки ошибок
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Ассоциативный массив при сборе результатов
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Не имулировать подготовку
        ];
        try {
            $this->_connection = new \PDO($dsn, DB_User, DB_Password, $opt); // Создаем подключение
        }
        catch (\Exception $e){

            $this->_connection = 'Error';
        }
    }


    public function __clone() // Приватный ПУСТОЙ метод клон
    {
    }

    public function __wakeup() // Тоже приватный метод __wakeup
    {
    }



}