<?php

namespace Framework\src;

use Framework\src\Database;

abstract class Model
{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }
    public function get($fields = true)
    {
        return $this->db->getData($this->table, $fields);
    }
    

    public function getTable($table)
    {
        return $this->db->getTable($table);
    }
    public function setTable($table)
    {

        if (!$this->getTable($table)) {
            throw new Exception("Нет такой тб");
        }

        $this->table = $table;
    }

    public function getaFew($essenceName, $essenceValue, $сonditions = "=", $operators = null)
    {
        $this->db->getaFew($essenceName, $essenceValue, $сonditions, $operators);
        return $this;
    }
    
    public function delate() {
        return $this->db->delate($this->table);
    }

    public function update($name, $value)
    {
        $this->db->update($name, $value);
        return $this;
    }
    public function setWhere($name, $value)
    {
        $this->db->setWhere($name, $value);
        return $this;
    }
    public function updateLoneliness($elementNew, $elementOld, $what)
    {
        $str = "`{$what}` = '$elementNew' WHERE `$what`= '$elementOld'";
        return  $this->db->update($this->table, $str);
    }
    public function getDefinitionData($argument)
    {
        return $this->db->getDefinitionData($this->table, $argument);
    }
    public function getUpdate()
    {
        return $this->db->getUpdate($this->table);
    }
    public function setCreate($name, $value)
    {
        $this->db->setCreate($name, $value);
        return $this;
    }
    public function create()
    {
        return $this->db->create($this->table);
    }
}
