<?php
/**
 * Класс для работы с БД
 * ВСЕ Методы CRUD
 * При создании возвращает общее число строк в таблице
 * Работает через подготовленные запросы
 */

namespace core\db;
use core\db\Db;

final class CRUD
{

    public $db;
    private $table;
    public  $TotalRows;
    public  $CurentRows;
    public  $Resulting;

    public function __construct($table,$add=null) // Принимает имя таблицы с которой будет работать модель
    {
        $this->db = Db::init(); // Инициализиркет подключение к БД
        if($this->db == 'Error'){
            return false;
        }
        try {
            $this->table = $table; // Записываем в свойство имя таблицы
            $statement = $this->db->query("SELECT id FROM {$this->table} "); // Готовим запрос И узнаем сколько всего строк в таблице
            $this->TotalRows = $statement->rowCount(); // Считаем строки
        }
        catch (\Exception $e){
            return 'Таблица не существует';
        }
    }

    public function AddMany($str, $needle){
        $statement=$this->db->prepare($str);
        foreach ($needle as $el){
            $statement->execute($el);
        }
        return $this;
    }

    public function FreeInfo($query, $NeedleArray){
        $statement=$this->db->prepare($query);
        $statement->execute($NeedleArray);
        $this->Resulting=$statement->fetchAll();
        return $this;
    }


}